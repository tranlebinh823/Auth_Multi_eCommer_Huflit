@extends('layouts.app')
@section('module', 'Brand')
@section('action', 'List')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    @can('brand-create')
                    <a class="btn btn-info" href="{{ route('admin.product_images.create') }}">Create New</a>
                    @endcan
                </h4>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr style="text-align:center">
                            <th>STT <br>| ID</th>
                            <th>Images</th>
                            <th>Product Name</th>

                            <th style="text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $i)
                        <tr style="text-align:center">
                            <td>{{ $loop->iteration }} <br>{{ $i->id }}</td>
                            <td> @foreach(json_decode($i->images) as $image)
                                <img src="{{ asset('upload/' . $image) }}" alt="avatar" height="120" width="120">
                                @endforeach
                            </td>
                            <td> {{ $i->product_name }}</td>

                            <td style="text-align:center">
                                <form action="{{ route('admin.product_images.destroy', $i->id) }}" method="POST">
                                    @can('brand-show')
                                    <a class="btn btn-info" href="{{ route('admin.product_images.show', $i->id) }}">Show</a>
                                    @endcan
                                    @can('brand-edit')
                                    <a class="btn btn-primary" href="{{ route('admin.product_images.edit', $i->id) }}">Edit</a>
                                    @endcan
                                    @csrf
                                    @method('DELETE')
                                    @can('brand-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan
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
@endsection
