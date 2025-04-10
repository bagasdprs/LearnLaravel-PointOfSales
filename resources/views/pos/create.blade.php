@extends('layouts.main')
@section('title', 'Point Of Sale')
@section('content')
    <section class="section">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Categories</h5>
                            <div align="right" class="mt-2">
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                            </div>
                            @csrf
                            <div class="mb-3">
                                <label for="" class="col-form-label">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" disabled selected>Select One</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="col-form-label">Product Name</label>
                                <select name="" id="product_id" class="form-control">
                                    <option disabled selected>Select One</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary add-row" type="button">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Basket</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Grand Total</th>
                                        <td colspan="3" class="">
                                            <span class="grandtotal"></span>
                                            <input type="hidden" class="form-control" name="grandtotal" readonly>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Confirm Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </section>
@endsection
