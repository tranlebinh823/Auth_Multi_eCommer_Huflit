<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-show', ['only' => ['show']]);
    }

    public function index()
    {
        $data['itemm'] = DB::table('products')
        ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('child_categories', 'products.child_category_id', '=', 'child_categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('vendors.*',  'categories.*', 'sub_categories.*', 'child_categories.*', 'brands.*','products.*')
        ->get();
        return view('admin.products.index', $data);
    }

    public function create()
    {
        $data['category'] = DB::table('categories')->get();
        $data['subcategory'] = DB::table('sub_categories')->get();
        $data['childcategory'] = DB::table('child_categories')->get();
        $data['vendor'] = DB::table('vendors')->get();
        $data['brand'] = DB::table('brands')->get();

        return view('admin.products.create',$data);

        
    }

    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');

        $thumb_image = $request->thumb_image;
        $image = time() . "-" . $thumb_image->getClientOriginalName();
        $path = public_path() . "/upload";
        $thumb_image->move($path, $image);
        $data['thumb_image'] = $image;


        $data['created_at'] = now();
        DB::table('products')->insert($data);
        return redirect()->route('admin.products.index')->with('success', 'Tạo thành công');

    }

    public function show(string $id)
    {
        $data['item'] = DB::table('products')
            ->where('id', $id)
            ->first();
        return view('admin.products.show', $data);
    }

    public function edit(string $id)
    {
        $data['item'] = DB::table('products')
            ->where('id', $id)
            ->first();
        return view('admin.products.edit', $data);
    }

    public function update(UpdateRequest $request, string $id)
    {
        $data = $request->except('_token');
       
        $data['updated_at'] = now();
        DB::table('products')->where('id', $id)->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Chỉnh sửa thành công');
    }

    public function destroy(string $id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa thành công');
    }
}
