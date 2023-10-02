@extends('layouts.app')
@section('module', 'Product')
@section('action', 'List')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    @can('product-create')
                    <a class="btn btn-info" href="{{ route('admin.products.create') }}">Create New</a>
                    @endcan
                </h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>STT | ID</th>
                                    <th>Product Name <br> / Brand</th>
                                    <th>Category
                                        <br>/ Sub Category
                                        <br>/ Child Category</th>
                                    <th>Thumb_image</th>
                                    <th>Quantity</th>
                                    <th>Price <br>/ Offer price</th>
                                    <th>Offer start date <br>/ Offer end date</th>
                                    <th>Is is_approved</th>

                                    <th style="text-align:center" width="280px">Action</th>
                                </tr>
                            </thead>


                            @foreach ($item as $i)
                            <tbody>
                                <tr style="text-align:center">
                                    <td>{{ $loop->iteration}} | {{ $i->id }}</td>
                                    <td>{{ $i->product_name }}
                                        <br>
                                        {{ $i->brand_name }}</td>
                                    <td>{{ $i->category_name }}
                                        <br>
                                        {{ $i->subcategory_name }}
                                        <br>
                                        {{ $i->childcategory_name }}
                                    </td>
                                    <td><img src="{{ asset('upload/' . $i ->thumb_image) }}" alt="avatar" height="120" width="120"></td>
                                    <td>{{ $i->qty }}</td>
                                    <td>{{ $i->price }} <br> {{ $i->offer_price }}</td>
                                    <td>{{ $i->offer_start_date }} <br>{{ $i->offer_end_date }}</td>
                                    <td>{{ $i->is_approved }}</td>



                                    <td style="text-align:center">
                                        @can('product-show')
                                        <a class="btn btn-info" href="{{ route('admin.products.show', $i->id) }}">Show</a>
                                        @endcan
                                        <br>
                                        @can('product-edit')
                                        <a class="btn btn-primary" href="{{ route('admin.products.edit', $i->id) }}">Edit</a>
                                        @endcan
                                        <br>
                                        @can('product-delete')
                                        <form action="{{ route('admin.products.destroy', $i->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
