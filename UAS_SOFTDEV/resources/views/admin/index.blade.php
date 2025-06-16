@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                    <div class="card-body px-3 py-4-5">
                            <div class="row">
                                    <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                    <i class="iconly-boldWallet"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Penjualan</h6>
                                            <h6 class="font-extrabold mb-0">Rp.
                                                {{ $sales }}
                                            </h6>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                    <div class="card-body px-3 py-4-5">
                            <div class="row">
                                    <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                    <i class="iconly-boldBuy"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Selesai</h6>
                                            <h6 class="font-extrabold mb-0">{{ $order }}</h6>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                    <div class="card-body px-3 py-4-5">
                            <div class="row">
                                    <div class="col-md-4">
                                            <div class="stats-icon green">
                                                    <i class="iconly-boldBag-2"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Produk</h6>
                                            <h6 class="font-extrabold mb-0">{{ $product }}</h6>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <a href="">
            <div class="card">
                    <div class="card-body px-3 py-4-5">
                            <div class="row">
                                    <div class="col-md-4">
                                            <div class="stats-icon red">
                                                    <i class="iconly-boldCategory"></i>
                                            </div>
                                    </div>
                                    <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Kategori</h6>
                                            <h6 class="font-extrabold mb-0">{{ $category }}</h6>
                                    </div>
                            </div>
                    </div>
            </div>
        </a>
    </div>
</div>

<!-- Sales Chart Card -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Grafik Penjualan</h5>
    </div>
    <div class="card-body">
        <div id="sales-chart" style="height: 300px;"></div>
    </div>
</div>

<div class="card">
        <div class="card-body">
                <table class="table table-striped" id="table1">
                        <thead>
                                <tr>
                                        <th>No</th>
                                        <th>Kode Pesanan</th>
                                        <th>Nama</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th width="20%">Aksi</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach($newOrder as $row)
                                <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->order_code }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>Rp. {{ $row->total }}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <span class="badge bg-success">Terbayar</span>
                                            @elseif($row->status == 1)
                                                <span class="badge bg-info">Dikonfirmasi</span>
                                            @elseif($row->status == 2)
                                                <span class="badge bg-primary">Diproses</span>
                                            @elseif($row->status == 3)
                                                <span class="badge bg-danger">Menunggu</span>
                                            @elseif($row->status == 4)
                                                <span class="badge bg-secondary">Pengiriman</span>
                                            @elseif($row->status == 5)
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->created_at->format('d M Y') }}</td>
                                        <td>
                                                <a href="{{ route('orderDetail', $row->order_code) }}"><span class="btn btn-sm btn-outline-primary">Detail</span></a>
                                        </td>
                                </tr>
                                @endforeach
                                <tbody>
                </table>
        </div>
</div>
@endsection

@section('css')
<style>
    .tooltip {
        position: absolute;
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        border-radius: 4px;
        padding: 8px;
        font-size: 12px;
        pointer-events: none;
    }
    .bar {
        fill: #5969ff;
        transition: fill 0.3s;
    }
    .bar:hover {
        fill: #3949cc;
    }
    .axis-title {
        font-size: 12px;
        font-weight: bold;
    }
</style>
@endsection

@section('js')
<script src="https://d3js.org/d3.v7.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Convert the Blade data to JavaScript objects
    const orderData = @json($newOrder);
    
    // Ensure we have an array to work with
    const dataArray = Array.isArray(orderData) ? orderData : Object.values(orderData);
    
    // Get current month and year
    const now = new Date();
    const currentMonth = now.getMonth();
    const currentYear = now.getFullYear();
    
    // Get the last day of the current month
    const lastDay = new Date(currentYear, currentMonth + 1, 0).getDate();
    
    // Format data for the chart and filter for current month only
    const chartData = dataArray
        .filter(order => {
            // Parse the created_at date
            const createdAt = new Date(order.created_at);
            // Keep only records from current month
            return createdAt.getMonth() === currentMonth && 
                   createdAt.getFullYear() === currentYear;
        })
        .map(order => {
            // Handle total whether it's already a number or a string with "Rp."
            let total = order.total;
            if (typeof total === 'string') {
                total = parseInt(total.replace(/[^\d]/g, ''));
            }
            
            // Parse the created_at date
            const createdAt = new Date(order.created_at);
            // Get the day of month
            const day = createdAt.getDate();
            
            return {
                orderCode: order.order_code,
                name: order.name,
                total: total,
                status: order.status,
                date: createdAt,
                day: day
            };
        });
    
    // Create complete array of days from 1 to last day of month
    const dailyData = {};
    for (let day = 1; day <= lastDay; day++) {
        dailyData[day] = {
            day: day,
            total: 0
        };
    }
    
    // Add sales data to corresponding days
    chartData.forEach(item => {
        dailyData[item.day].total += item.total;
    });
    
    // Convert to array and sort by day
    const dailySalesData = Object.values(dailyData).sort((a, b) => a.day - b.day);
    
    // Chart dimensions
    const margin = {top: 30, right: 30, bottom: 70, left: 80},
          width = document.getElementById('sales-chart').offsetWidth - margin.left - margin.right,
          height = 300 - margin.top - margin.bottom;
    
    // Create SVG
    const svg = d3.select("#sales-chart")
        .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
        .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);
    
    // X axis scale
    const x = d3.scaleBand()
        .domain(dailySalesData.map(d => d.day))
        .range([0, width])
        .padding(0.2);
    
    svg.append("g")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x).tickFormat(d => `${d}`))
        .selectAll("text")
            .style("text-anchor", "middle");
    
    // Y axis scale
    const y = d3.scaleLinear()
        .domain([0, d3.max(dailySalesData, d => d.total) * 1.1 || 100])
        .nice()
        .range([height, 0]);
    
    // Format rupiah for y-axis
    const formatRupiah = (num) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
    };
    
    svg.append("g")
        .call(d3.axisLeft(y).tickFormat(d => formatRupiah(d).replace('IDR', 'Rp.')));
    
    // Add bars
    svg.selectAll("bars")
        .data(dailySalesData)
        .enter()
        .append("rect")
            .attr("class", "bar")
            .attr("x", d => x(d.day))
            .attr("y", d => y(d.total))
            .attr("width", x.bandwidth())
            .attr("height", d => height - y(d.total));
    
    // Get month name in Indonesian
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const currentMonthName = monthNames[currentMonth];
    
    // Add labels for x and y axes
    svg.append("text")
        .attr("class", "axis-title")
        .attr("text-anchor", "middle")
        .attr("x", width / 2)
        .attr("y", height + margin.bottom - 10)
        .text(`Tanggal (${currentMonthName} ${currentYear})`);
    
    svg.append("text")
        .attr("class", "axis-title")
        .attr("text-anchor", "middle")
        .attr("transform", "rotate(-90)")
        .attr("y", -margin.left + 20)
        .attr("x", -height / 2)
        .text("Total Penjualan (Rp)");
    
    // Tooltip
    const tooltip = d3.select("body")
        .append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);
    
    // Mouse events for bars
    svg.selectAll(".bar")
        .on("mouseover", function(event, d) {
            d3.select(this).transition().duration(100).attr("fill", "#3949cc");
            
            tooltip.transition()
                .duration(200)
                .style("opacity", 0.9);
            
            tooltip.html(`<strong>Tanggal ${d.day} ${currentMonthName}</strong><br>Total: ${formatRupiah(d.total)}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function() {
            d3.select(this).transition().duration(100).attr("fill", "#5969ff");
            
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });
});
</script>
@endsection