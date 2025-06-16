<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        $title = 'FAQ Management';
        return view('admin.faq.index', compact('faqs', 'title'));
    }

    public function create()
    {
        $title = 'Create FAQ';

        return view('admin.faq.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create($validatedData);

        return redirect()->route('faqIndex')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit FAQ';
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq', 'title'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validatedData);

        return redirect()->route('faqIndex')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqIndex')->with('success', 'FAQ berhasil dihapus');
    }
}