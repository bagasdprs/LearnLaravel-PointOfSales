@extends('layouts.main')
@section('title', 'Data Roles')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title ?? '' }}</h5>
                        <div class="mt-4 mb-3">
                            <div align="right" class="mb-3">
                                <a class="btn btn-primary" href="{{ route('role.create') }}">Add User</a>
                            </div>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($row as $rowuse)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $rowuse->role_name }}</td>

                                            <td>
                                                <a href="{{ route('role.edit', $rowuse->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('role.destroy', $rowuse->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

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
