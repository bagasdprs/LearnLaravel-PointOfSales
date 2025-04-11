@extends('layouts.main')
@section('title', 'Orders')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title ?? '' }}</h5>
                        <div class="mt-4 mb-3">
                            <div align="right" class="mb-3">
                                <a class="btn btn-primary" href="{{ route('pos.create') }}">Add POS</a>
                            </div>
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
                                                <a href="{{ route('pos.show', $data->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('pos.edit', $data->id) }}" class="btn btn-sm btn-success">
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
@endsection
