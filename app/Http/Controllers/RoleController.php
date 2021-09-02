<?php

namespace App\Http\Controllers;

use App\Mail\AdminPannelUser;
use App\Models\User;
use DebugBar\Storage\FileStorage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;
use function PHPUnit\Framework\fileExists;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::find(Auth::user()->id);
        // $user->assignrole('Super Admin');
        return view('backend.role.index', [
            'roles' => Role::all()
        ]);
    }

    /** public function folderMaker()
    {
        $j = 1;
        for ($i = 1; $i <= 70; $i++) {
            $location = public_path('CIT PHP/') . "class " . $i;
            if ($i > 23) {
                $location = public_path('CIT PHP/') . "class " . $i . " (Laravel " . $j . ")";
                $j++;
                File::makeDirectory($location, 0777, true, true);
            } else {

                File::makeDirectory($location, 0777, true, true);
            }
        }
        return "Done";
    }
     */


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
        if (!DB::table('model_has_roles')->where('role_id', $role->id)->exists()) {
            $role->delete();
            return back()->with('success', 'Deletation Succesfull.');
        }
        return back()->with('error', "Can't delete! This role in use.");
    }

    public function assignUser()
    {
        return view('backend.role.assignUser', [
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function assignUserStore(Request $request)
    {
        // return $request;
        $user = User::find($request->user_name);
        $user->assignRole($request->role_name);
        return back()->with('success', 'User assigned successfully.');
    }

    public function revokeuser(Role $role, User $user)
    {
        $user->removeRole($role);
        return back()->with('success', 'Revoked role Successfully.');
    }

    public function addUser()
    {
        $roles = Role::all();

        return view('backend.role.adduser', compact('roles'));
    }

    public function UserStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $password = Str::random();
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($password),
        ]);

        $user->assignRole($request->role_name);

        event(new Registered($user));

        Mail::to($request->email)->send(new AdminPannelUser($password));

        return back()->with('success', 'User creation Successfull.');
    }
}
