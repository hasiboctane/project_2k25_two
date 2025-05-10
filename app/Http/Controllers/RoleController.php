<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
        public static function middleware()
    {
        return[
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:create roles', only: ['create','store']),
            new Middleware('permission:edit roles', only: ['edit','update']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('created_at','desc')->paginate(5);
        $permissions= Permission::orderBy('created_at','asc')->get();
        return view('admin.role&permission.roles.list',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.role&permission.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','unique:roles,name']
        ]);
        // dd($request->all());

        $role = Role::create([
            'name'=>$request->name
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('success','Role created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('created_at','asc')->get();
        $hasPermissions = $role->permissions->pluck('name');

        return view('admin.role&permission.roles.edit',compact('role','permissions','hasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name'=>['required','unique:roles,name,'.$id]
        ]);
        $role->update([
            'name' => $request->name,
        ]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Role::findOrFail($id);
        $permission->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'successfully deleted!'
        ]);
    }
}
