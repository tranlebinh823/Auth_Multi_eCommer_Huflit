@extends('layouts.app')
@section('module', 'Product Images')
@section('action', 'Create')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="header-title">Create Product Images</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product_images.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-6">
                        <div class="custom-file">
                            <span class="input-group-text">Tải ảnh lên</span>
                            <div class="input-group-append btn btn-info">
                                <input type="file" name="images[]" multiple onchange="previewImages()">
                            </div>
                        </div>
                    </div>
                    <!-- Image Preview -->
                    <div class="mb-3">
                        <div id="imagePreviewContainer">
                            <!-- Các ảnh đã chọn sẽ được hiển thị ở đây -->
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="example-select" class="form-label">Brand Name</label>
                        <select class="form-select" id="example-select"name="product_id">
                            <option value="">Select Product Name</option>
                            @foreach ($product as $i)
                            <option value="{{$i->id}}">{{$i->product_name}}</option>

                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Create Product Image</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImages() {
        var input = document.querySelector('input[type="file"]');
        var imagePreviewContainer = document.getElementById('imagePreviewContainer');

        // Xóa bất kỳ ảnh hiện có trong phần tử container
        imagePreviewContainer.innerHTML = '';

        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var image = document.createElement('img');
                    image.className = 'preview-image';
                    image.src = e.target.result;
                    image.style.maxWidth = '100%';
                    image.style.maxHeight = '200px';

                    // Thêm ảnh vào phần tử container
                    imagePreviewContainer.appendChild(image);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }
        imagePreviewContainer.style.display = 'block'; // Hiển thị phần tử container
    }

</script>
@endsection
