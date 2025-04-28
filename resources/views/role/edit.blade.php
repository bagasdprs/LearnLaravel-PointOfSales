@extends('layouts.main')
@section('title', 'Edit Users')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Users</h5>
                        <form action="{{ route('role.update', $edit->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="" class="col-form-label">Name Role</label>
                                <input type="text" class="form-control" name="role_name" value="{{ $edit->role_name }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Edit</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                                <a href="{{ url()->previous() }}" class="text-primary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
