@extends('layouts.app')
@section('module', 'Product')
@section('action', 'List')


@section('content')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    }
</style>
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
                                    <th>Product Name
                                        <br>
                                        / Slug</th>
                                    <th>Category
                                        <br>/ Sub Category
                                        <br>/ Child Category</th>
                                    <th>Thumb_image</th>
                                    <th>Quantity</th>
                                    <th>Price <br>
                                        / Offer price</th>
                                    <th>Vendor (shop)
                                        <br>/ Brand</th>

                                    <th>Video link
                                        <br>
                                        / Sku</th>

                                    <th>Offer start date
                                        <br>
                                        / Offer end date</th>
                                    <th>Is is_approved
                                        <br>/ Seo title< <br>/ Seo description</th>

                                    <th>Short description
                                        <br>
                                        / Long description</th>

                                    <th style="text-align:center" width="280px">Action</th>
                                </tr>
                            </thead>


                            @foreach ($itemm as $product)
                            <tbody>
                                <tr style="text-align:center">
                                    <td>{{ $loop->iteration}} | {{ $product->id }}</td>
                                    <td>{{ $product->name }}
                                        <br>
                                        {{ $product->slug }}</td>
                                    <td>{{ $product->category_name }}
                                        <br>
                                        {{ $product->subcategory_name }}
                                        <br>
                                        {{ $product->childcategory_name }}</td>
                                    <td><img src="{{ asset('upload/' . $product->thumb_image) }}" alt="avatar" height="120" width="120"></td>
                                    <td>{{ $product->qty }}</td>
                                    <td>{{ $product->price }}
                                        <br>
                                        {{ $product->offer_price }}</td>
                                    <td>{{ $product->shop_name }}
                                        <br>
                                        {{ $product->name }}</td>


                                    <td>{{ $product->video_link }}
                                        <br>
                                        {{ $product->sku }}</td>

                                    <td>{{ $product->offer_start_date }}
                                        <br>
                                        {{ $product->offer_end_date }}</td>

                                    <td>{{ $product->is_approved }}
                                        <br>
                                        {{ $product->seo_title }}
                                        <br>
                                        {{ $product->seo_description }}</td>



                                    <td>{{ $product->short_description }}
                                        <br>
                                        {{ $product->long_description }}</td>

                                    <td style="text-align:center">
                                        @can('product-show')
                                        <a class="btn btn-info" href="{{ route('admin.products.show', $product->id) }}">Show</a>
                                        @endcan
                                        <br>
                                        @can('product-edit')
                                        <a class="btn btn-primary" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                        @endcan
                                        <br>
                                        @can('product-delete')
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
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
