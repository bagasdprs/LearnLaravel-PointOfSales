@extends('layouts.main')
@section('title', 'Edit Users')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Users</h5>
                        <form action="{{ route('user.update', $edit->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="col-form-label">Role</label>
                                <select name="role_name" class="form-control" id="">
                                    <option value="">Select Role</option>
                                    @foreach ($role as $roles)
                                        <option value="{{ $roles->id }}">{{ $roles->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Input Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Input Email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Input Password"
                                    required>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Edit</button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
