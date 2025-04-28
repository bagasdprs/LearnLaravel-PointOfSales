{{--  @extends('layouts.main')
@section('title', 'Reports')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="flex justify-between item-center mb-4">
                            <h5 class="card-title">{{ $title ?? '' }}</h5>
                            <button onclick="print()">Print</button>
                        </div>
                        <div class="mt-4 mb-3">
                            <form method="GET" action="#" class="row g-3">
                                <div class="col-md-4">
                                    <select name="filter" class="form-select">
                                        <option value="">-- Filter Berdasarkan --</option>
                                        <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>
                                            Harian</option>
                                        <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>2
                                            Mingguan</option>
                                        <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>
                                            Bulanan</option>
                                        <option value="yearly" {{ request('filter') == 'yearly' ? 'selected' : '' }}>Tahunan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Code</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->order_code }}</td>
                                            <td>{{ $data->order_date }}</td>
                                            <td>Rp. {{ $data->order_amount }}</td>
                                            <td>{{ $data->order_status ? 'Paid' : 'Unpaid' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <script>
        function print() {
            const tableContent = document.querySelector('.table-auto').outerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                                    <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                        }
                                        th, td {
                                            border: 1px solid #ddd;
                                            padding: 8px;
                                            text-align: left;
                                        }
                                        th {
                                            background-color: #f4f4f4;
                                        }
                                        </style>
                                    </head>
                                    <body>
                                        ${tableContent}
                                    </body>
                                    </html>
                                `);
            printWindow.document.close();
            printWindow.print();
        }
    </script>
@endsection  --}}

@extends('layouts.main')
@section('title', 'Reports')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="pagetitle mt-4 mb-4">
                <h1 align="center" style="text-transform: uppercase; font-weight: bold">Order Report (Daily, Weekly, Monthly,
                    Custom Filter + Export)</h1>
            </div>

            <!-- Filter -->
            <div class="filter-container mb-4">
                <label for="preset-filter">Preset Filter:</label>
                <select id="preset-filter">
                    <option value="">-- Select --</option>
                    <option value="daily">Daily (Today)</option>
                    <option value="weekly">Weekly (Last 7 Days)</option>
                    <option value="monthly">Monthly (Last 30 Days)</option>
                </select>

                <label for="start-date" style="margin-left:20px;">Start Date:</label>
                <input type="text" id="start-date" autocomplete="off">

                <label for="end-date" style="margin-left:20px;">End Date:</label>
                <input type="text" id="end-date" autocomplete="off">

                <button id="reset-filter"><i class="fas fa-refresh"></i> Reset Filter</button>

            </div>

            <!-- Table -->
            <table id="tabelorder" class="display nowrap table" style="width:100%">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Amount</th>
                        <th>Order Date</th>
                        <th>Order Change</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $order)
                        <tr>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->formatted_amount }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->formatted_change }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
