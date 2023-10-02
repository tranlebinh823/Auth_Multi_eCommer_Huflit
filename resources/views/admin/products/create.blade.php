@extends('layouts.app')
@section('module', 'Product')
@section('action', 'Create')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        {{-- 1 --}}
                        <div class="col-sm-3">
                            <div class="mb-6">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-6">
                                <label class="form-label" for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" disabled="">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="mb-6">
                                <label class="form-label" for="">Tải ảnh lên</label>
                                <div style="display:flex; border:none">
                                    <div class="input-group-append " style=" overflow-wrap: break-word; padding:2% 4%;  opacity:0.7; ">
                                        <input type="file" style="border:0.2px solid;" class="custom-file-input" id="logoInput" name="thumb_image" onchange="previewImage()">
                                    </div>
                                    <div>
                                        <img id="imagePreview" src="{}" alt="Image Preview" style="float:left; max-width: 250px; max-height: 250px; display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 1 --}}
                    {{-- 2 --}}

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="qty">Quantity</label>
                                <input type="number" class="form-control" name="qty">
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="short_description">Short Description</label>
                                <textarea class="form-control" name="short_description" rows="3"></textarea>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="long_description">Long Description</label>
                                <textarea class="form-control" name="long_description" rows="3"></textarea>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="video_link">Video Link (Optional)</label>
                                <input type="text" class="form-control" name="video_link">
                            </div>
                        </div>
                    </div>
                    {{-- 2 --}}

                    {{-- 3 --}}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="sku">SKU (Optional)</label>
                                <input type="text" class="form-control" name="sku">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="price">Price</label>
                                <input type="number" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="offer_price">Offer Price (Optional)</label>
                                <input type="number" class="form-control" name="offer_price">
                            </div>
                        </div>
                    </div>
                    {{-- 3 --}}

                    {{-- 4 --}}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="offer_start_date">Offer Start Date (Optional)</label>
                                <input type="date" class="form-control" name="offer_start_date">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="offer_end_date">Offer End Date (Optional)</label>
                                <input type="date" class="form-control" name="offer_end_date">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="offer_end_date">is approved</label>
                                <input type="number" class="form-control" name="is_approved">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="offer_end_date">seo title</label>
                                <input type="text" class="form-control" name="seo_title">
                            </div>
                        </div>
                    </div>
                    {{-- 4 --}}
                    <!-- Các trường liên quan đến sub_categories, child_categories, vendors, categories, brands cần được thêm vào form -->

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Category Name</label>
                                <select class="form-select" id="example-select" id="category_id" name="category_id">
                                    <option value=""></option>
                                    @foreach ($category as $i)
                                    <option value="{{$i->id}}">{{$i->category_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">SubCategory Name</label>
                                <select class="form-select" id="example-select" id="subcategory_id" name="sub_category_id">
                                    <option value=""></option>
                                    @foreach ($subcategory as $i)
                                    <option value="{{$i->id}}">{{$i->subcategory_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">ChildCategory Name</label>
                                <select class="form-select" id="example-select" id="childcategory_id" name="child_category_id">
                                    <option value=""></option>
                                    @foreach ($childcategory as $i)
                                    <option value="{{$i->id}}">{{$i->childcategory_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- 5 --}}

                    {{-- 6 --}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">vendors Name</label>
                                <select class="form-select" id="example-select" id="vendor_id" name="vendor_id">
                                    <option value=""></option>
                                    @foreach ($vendor as $i)
                                    <option value="{{$i->id}}">{{$i->shop_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="example-select" class="form-label">Brand Name</label>
                                <select class="form-select" id="example-select" id="brand_id" name="brand_id">
                                    <option value=""></option>
                                    @foreach ($brand as $i)
                                    <option value="{{$i->id}}">{{$i->brand_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- 6 --}}
                    <button class="btn btn-primary" type="submit">Create Product</button>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var input = document.getElementById('logoInput');
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
    // Lắng nghe sự kiện khi nhập "product_name"
    document.getElementById('product_name').addEventListener('input', function() {
        // Lấy giá trị "product_name" và tạo "slug"
        var productName = this.value;
        var slug = productName.toLowerCase().replace(/ /g, '-');

        // Cập nhật giá trị "slug" lên giao diện người dùng
        document.getElementById('slug').value = slug;
    });

</script>
@endsection
