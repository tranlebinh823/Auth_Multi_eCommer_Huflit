<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['permissions'] = DB::table('permissions')->get();
        return view('admin.permissions.index', $data);
    }

    public function create(): View
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->input('name')]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission created successfully');
    }

    public function show($id): View
    {
        $permission = Permission::find($id);

        return view('admin.permissions.show', compact('permission'));
    }

    public function edit($id): View
    {
        $data['item'] = DB::table('permissions')
            ->where('id', $id)
            ->first();
        return view('admin.permissions.edit', $data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->except('_token');

        $data['updated_at'] = now();
        DB::table('permissions')->where('id', $id)->update($data);
        return redirect()->route('admin.permissions.index')->with('success', 'Chỉnh sửa thành công');
    }

    public function destroy($id): RedirectResponse
    {
        DB::table("permissions")->where('id', $id)->delete();
        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}
