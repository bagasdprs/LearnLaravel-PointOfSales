@extends('layouts.main') 
@section('title', 'Data Categories')

@section('content')
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$title ?? ''}}</h5>
              <div class="mt-4 mb-3">
                <div align="right" class="mb-3">
                  <a class="btn btn-primary" href="{{route('categories.create')}}">Add Categories</a>
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
                    $no=1;
                    @endphp
                    @foreach ($datas as $data )                   
                    <tr>
                      <td>{{$no ++}}</td>
                      <td>{{$data->category_name}}</td>
                      <td>
                        <a href="" class="btn btn-success btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
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
 
