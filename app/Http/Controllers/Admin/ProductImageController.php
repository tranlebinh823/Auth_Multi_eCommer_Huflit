<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductImage\StoreRequest;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
class ProductImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:productimage-list|productimage-create|productimage-edit|productimage-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:productimage-delete', ['only' => ['destroy']]);
        $this->middleware('permission:productimage-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:productimage-show', ['only' => ['show']]);
    }

    public function index()
    {
       
        $data['item'] = DB::table('product_images')
        ->join('products', 'product_images.product_id', '=', 'products.id')
        ->select( 'product_images.*', 'products.*')
        ->get();
        return view('admin.product_images.index', $data);
    }

    public function create()
    {
        $data['product'] = DB::table('products')->get();
        return view('admin.product_images.create',$data);
    }



    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
   
        // Thêm thời gian tạo mới
        $data['created_at'] = now();
        // Xử lý và lưu ảnh
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $image->move(public_path('upload'), $fileName);
                $images[] = $fileName;
            }
        }
        $data['images'] = json_encode($images);

        // Thêm dữ liệu vào bảng products
        DB::table('product_images')->insert($data);

        return redirect()->route('admin.product_images.index')->with('success', 'Tạo thành công');
    }


    public function show(string $id)
    {
        $data['item'] = DB::table('product_image')
            ->where('id', $id)
            ->first();
        return view('admin.product_image.show', $data);
    }

    public function edit(string $id)
    {
        $data['item'] = DB::table('product_image')
            ->where('id', $id)
            ->first();
        return view('admin.product_image.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');

        if (empty($data['logo'])) {
            $da['logo'] = DB::table('brands')->where('id', $id)->first();
            $data['logo'] = $da['logo']->logo;
        } else {
            $logo = $request->logo;
            $image = time() . "-" . $logo->getClientOriginalName();
            $path = public_path() . "/upload";
            $logo->move($path, $image);
            $data['logo'] = $image;
        }


        $data['updated_at'] = now();
        DB::table('brands')->where('id', $id)->update($data);
        return redirect()->route('admin.brands.index')->with('success', 'Chỉnh sửa thành công');
    }

    public function destroy(string $id)
    {
        DB::table('brands')->where('id', $id)->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Xóa thành công');
    }
}
