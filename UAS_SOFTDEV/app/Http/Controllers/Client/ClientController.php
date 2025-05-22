<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Midtrans\Config;

class ClientController extends Controller
{
    public function index(){

        if(!Shop::exists()){
            return redirect()->route('register');
        }

        $data = [
            'shop' => Shop::first(),
            'product' => Product::all()->sortByDesc('id')->take(8),
            'category' => Category::all()->sortByDesc('id')->take(4),
            'title' => 'Home'
        ];

        return view('client.index', $data);
    }

    public function products(){
        $data = [
            'shop' => Shop::first(),
            'product' => Product::orderBy('id', 'DESC')->paginate(16),
            'category' => Category::all()->sortByDesc('id'),
            'title' => 'Products'
        ];

        return view('client.products', $data);
    }

    public function searchProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'product' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('clientHome')->withErrors($validator)->withInput();
        }else{
            
            $search = str_replace(' ', '-', strtolower($request->product));

            $data = [
                'title' => 'Result',
                'shop' => Shop::first(),
                'product' => Product::where('title', 'LIKE', '%'.$search.'%')->orderBy('id', 'DESC')->paginate(20),
                'search' => $request->product
            ];

            return view('client.productSearch', $data);

        }
    }

    public function category(){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::orderBy('id', 'DESC')->paginate(12),
            'title' => 'Products'
        ];

        return view('client.category', $data);
    }

    public function categoryProducts($category){
        $data = [
            'shop' => Shop::first(),
            'category' => Category::where('name', $category)->first(),
            'title' => 'Category - '.str_replace('-', ' ', ucwords($category))
        ];

        return view('client.categoryProducts', $data);
    }

    public function productDetail($product){

        $product = Product::where('title', $product)->first();

        if($product->category->product->count() > 1){
            $recomendationProducts = $product->category->product->take(8);
        }else{
            $recomendationProducts = Product::all()->sortByDesc('id')->take(8);
        }

        $data = [
            'shop' => Shop::first(),
            'product' => $product,
            'recomendationProducts' => $recomendationProducts,
            'title' => str_replace('-', ' ', ucwords($product->title))
        ];

        return view('client.productDetail', $data);
    }

    public function checkout(){
        $cartTotal = 0;
        $cartItems = session('cart') ? session('cart') : [];
        
        foreach ($cartItems as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
        }
    
        $data = [
            'shop' => Shop::first(),
            'title' => 'Checkout',
            'cartTotal' => $cartTotal,
            'cartItems' => $cartItems
        ];
    
        return view('client.checkout', $data);
    }

    public function checkoutSave(Request $request){
    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'courier' => 'required',
            'service' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order_code = Str::random(3) . '-' . date('Ymd');

        if (session('cart')) {
            $total = 0;
            $data = [];
            
            foreach ((array) session('cart') as $id => $details) {
                $total += $details['price'] * $details['quantity'];

                $data[] = [
                    'order_code' => $order_code,
                    'title' => $details['title'],
                    'price' => $details['price'],
                    'quantity' => $details['quantity'],
                ];
            }

            $shipping_cost_text = $request->shipping_cost;
            if (is_string($shipping_cost_text) && strpos($shipping_cost_text, 'Rp') === 0) {
                $shipping_cost_text = str_replace('Rp', '', $shipping_cost_text);
                $shipping_cost_text = str_replace('.', '', $shipping_cost_text); 
                $shipping_cost_text = str_replace(',', '', $shipping_cost_text); 
            }
            $shipping_cost_value = intval($shipping_cost_text);

            $phone = preg_replace('/[^0-9]/', '', $request->phone);

            $total += $shipping_cost_value;
            
            $discount_id = null;
            $discount_code = null;
            $discount_amount = 0;
            
            if ($request->discount_code && $request->discount_amount > 0) {
                $discount = \App\Models\Discount::where('code', $request->discount_code)
                    ->where('qty', '>', 0)
                    ->first();
                
                if ($discount) {
                    $discount_id = $discount->id;
                    $discount_code = $discount->code;
                    $discount_amount = intval($request->discount_amount);
                    
                    $total -= $discount_amount;
                    
                    $discount->qty -= 1;
                    $discount->save();
                }
            }

            Order::create([
                'shop_id' => Shop::first()->id,
                'order_code' => $order_code,
                'name' => $request->name,
                'phone' => $phone,
                'address' => $request->address,
                'note' => $request->note,
                'shipping_cost' => $request->shipping_cost,
                'shipping_service' => $request->service,
                'shipping_province' => $request->province,
                'shipping_city' => $request->city,
                'discount_id' => $discount_id,
                'discount_code' => $discount_code,
                'discount_amount' => $discount_amount,
                'total' => $total,
                'status' => 0
            ]);

            OrderDetail::insert($data);

            foreach ((array) session('cart') as $id => $details) {
                $product = Product::find($id); 

                if ($product) {
                    $product->stock -= $details['quantity'];
                    if ($product->stock < 0) {
                        $product->stock = 0;
                    }
                    $product->save();
                }
            }

            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $payload = [
                'transaction_details' => [
                    'order_id' => $order_code,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'phone' => $phone,
                    'address' => $request->address,
                ],
            ];

            $snapToken = Snap::getSnapToken($payload);

            session()->forget('cart');

            return response()->json([
                'token' => $snapToken,
                'order_code' => $order_code
            ]);
        }
        
        return response()->json(['error' => 'Cart is empty'], 400);
        
    } catch (\Exception $e) {
        Log::error('Checkout error: ' . $e->getMessage());
        return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
    }
}

    public function successOrder($order_code){
        $data = [
            'shop' => Shop::first(),
            'order_code' => $order_code,
            'title' => 'Checkout'
        ];

        return view('client.success-order', $data);
    }
    

    public function checkOrder(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function checkOrderStatus(Request $request){

        $order = Order::where('order_code', $request->order_code)->first();


        if($order){
            $data = [
                'shop' => Shop::first(),
                'order' => $order,
                'orderDetail' => OrderDetail::where('order_code', $request->order_code)->get(),
                'title' => 'Check Order'
            ];
            return view('client.check-order', $data);

        }

        $data = [
            'shop' => Shop::first(),
            'title' => 'Check Order'
        ];

        return view('client.check-order', $data);
    }

    public function about(){
        $data = [
            'shop' => Shop::first(),
            'title' => 'About'
        ];

        return view('client.about', $data);
    }

    public function verifyDiscount(Request $request)
    {
        $code = $request->input('code');

        $discount = Discount::where('code', $code)
            ->where('qty', '>', 0)
            ->first();

        if ($discount) {
            return response()->json([
                'valid' => true, 
                'discount_percent' => $discount->discount,
                'discount_id' => $discount->id
            ]);
        }

        return response()->json(['valid' => false]);
    }
}
