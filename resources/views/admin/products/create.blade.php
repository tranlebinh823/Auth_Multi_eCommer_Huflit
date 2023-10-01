@extends('layouts.app')
@section('module', 'Product')
@section('action', 'Create')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Create Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control"  name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug</label>
                        <input type="text" class="form-control"  name="slug">
                    </div>
                   
                     <div class="mb-3">
                        <div class="custom-file">
                            <span class="input-group-text">Tải ảnh lên</span>
                            <div class="input-group-append btn btn-info">
                                <input type="file" class="custom-file-input" id="logoInput" name="thumb_image" onchange="previewImage()">
                            </div>
                        </div>
                    </div>
                    <!-- Image Preview -->
                    <div class="mb-3">
                        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; max-height: 200px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="qty">Quantity</label>
                        <input type="number" class="form-control" name="qty">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="short_description">Short Description</label>
                        <textarea class="form-control"  name="short_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="long_description">Long Description</label>
                        <textarea class="form-control"  name="long_description" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="video_link">Video Link (Optional)</label>
                        <input type="text" class="form-control"name="video_link">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="sku">SKU (Optional)</label>
                        <input type="text" class="form-control"  name="sku">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="offer_price">Offer Price (Optional)</label>
                        <input type="number" class="form-control"  name="offer_price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="offer_start_date">Offer Start Date (Optional)</label>
                        <input type="date" class="form-control"  name="offer_start_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="offer_end_date">Offer End Date (Optional)</label>
                        <input type="date" class="form-control"  name="offer_end_date">
                    </div>
                  

                    <div class="mb-3">
                        <label class="form-label" for="offer_end_date">is approved</label>
                        <input type="number" class="form-control"  name="is_approved">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="offer_end_date">seo title</label>
                        <input type="text" class="form-control" name="seo_title">
                    </div>
                    <!-- Các trường liên quan đến sub_categories, child_categories, vendors, categories, brands cần được thêm vào form -->
                    
                    <div class="mb-3">
                        <label for="example-select" class="form-label">SubCategory Name</label>
                        <select class="form-select" id="example-select" id="subcategory_id" name="sub_category_id">
                            <option value=""></option>
                            @foreach ($subcategory as $i)
                            <option value="{{$i->id}}">{{$i->subcategory_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">ChildCategory Name</label>
                        <select class="form-select" id="example-select" id="childcategory_id" name="child_category_id">
                            <option value=""></option>
                            @foreach ($childcategory as $i)
                            <option value="{{$i->id}}">{{$i->childcategory_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">vendors Name</label>
                        <select class="form-select" id="example-select" id="vendor_id" name="vendor_id">
                            <option value=""></option>
                            @foreach ($vendor as $i)
                            <option value="{{$i->id}}">{{$i->shop_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Category Name</label>
                        <select class="form-select" id="example-select" id="category_id" name="category_id">
                            <option value=""></option>
                            @foreach ($category as $i)
                            <option value="{{$i->id}}">{{$i->category_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-select" class="form-label">Brand Name</label>
                        <select class="form-select" id="example-select" id="brand_id" name="brand_id">
                            <option value=""></option>
                            @foreach ($brand as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>

                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Create Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var input = document.getElementById('thumbImageInput');
        var imagePreview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.style.display = 'block';
                imagePreview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
