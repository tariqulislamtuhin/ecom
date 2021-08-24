<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.role.index', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('backend.role.create', [
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * return $request->except('_token');
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'permissions' => 'required|array|min:1'
        ], [
            'permissions.required' => 'Give at least one Permission'
        ]);
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permissions);
        return back()->with('success', 'Role Added with Permissions');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Role $role)
    {
        return view('backend.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
            return back()->with('success', 'Edited Permissions Successfully');
        }
        return back()->with('per_error', 'Give at least one Permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Role $role)
    {
        // $role->delete();
        return back()->with('success', 'Deletation Succesfull.');
    }


    public function trash($id)
    {
        //
    }

    public function destroyPermanent($id)
    {
        //
    }
}
