<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SystemAdminCreateRequest;
use App\Http\Requests\SystemAdminUpdateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class SystemAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('admin-list');
        $admins = User::with('role:id,role_name')->select('id', 'name', 'image', 'role_id', 'email', 'is_active', 'phone', 'address', 'created_at', 'is_deleteable')->latest('id')->get();
        return view('backend.pages.system_admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('admin-create');
        $roles = Role::select('id', 'role_name')->whereNot('id', 3)->latest('id')->get();
        return view('backend.pages.system_admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SystemAdminCreateRequest $request)
    {
        Gate::authorize('admin-create');
        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('Admin created successfully');
        return redirect()->route('admin.index');
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
    public function edit(string $id)
    {
        Gate::authorize('admin-edit');
        $admin = User::findorFail($id);
        $roles = Role::select('id', 'role_name')->whereNot('id', 3)->get();
        return view('backend.pages.system_admin.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SystemAdminUpdateRequest $request, string $id)
    {
        Gate::authorize('admin-edit');
        $admin = User::findorFail($id);
        $admin->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        Toastr::success('Admin update successfully');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('admin-delete');
        $user = User::find($id);
        $user->delete();
        Toastr::success('Admin delete successfully');
        return redirect()->route('admin.index');
    }


    public function changeStatus(string $id)
    {
        $user = User::find($id);
        if ($user->is_active == 1) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
