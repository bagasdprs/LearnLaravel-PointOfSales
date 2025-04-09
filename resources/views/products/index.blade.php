@extends('layouts.main') 
@section('title', 'Data Products')

@section('content')
     <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$title ?? ''}}</h5>
              <div class="mt-4 mb-3">
                <div align="right" class="mb-3">
                  <a class="btn btn-primary" href="{{route('products.create')}}">Add Product</a>
                </div>
                <table class="table table-bordered text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Status</th>
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
                      <td>{{$data->product_name}}</td>
                      <td><img src="{{asset('storage/' . $data->product_photo) }}" alt="" width="70"></td>
                      <td>{{$data->categories->category_name}}</td>
                      <td>{{$data->product_price}}</td>
                      <td>{{$data->is_active}}</td>
                      <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{route('products.edit', $data->id)}}" class="btn btn-sm btn-secondary">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{route('products.destroy', $data->id)}}" method="post">
                          @csrf
                          @method('delete')
                          <button class="btn btn-sm btn-warning">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                        </div>
                       
                        
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
 
