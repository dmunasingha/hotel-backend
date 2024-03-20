<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $title = 'Users';

        $data = User::all();

        return view('users.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $title = 'Users';

        $roles = Role::all();

        $is_edit = false;

        return view('users.create-edit', compact('title', 'is_edit', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $all_errors = null;

            foreach ($validator->errors()->messages() as $errors) {
                foreach ($errors as $error) {
                    $all_errors .= $error . "<br>";
                }
            }

            return response()->json(['success' => false, 'message' => $all_errors]);
        }
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_by' => Auth::user()->id
            ];

            $user = User::create($data);

            $role = Role::find($request->role);

            $user->assignRole($role);

            $email = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];


            return json_encode(['success' => true, 'message' => 'User created', 'url' => route('users.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $title = 'Users';

        $roles = Role::all();

        $is_edit = true;

        $data = User::find($id);

        return view('users.create-edit', compact('title', 'is_edit', 'roles', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $all_errors = null;

            foreach ($validator->errors()->messages() as $errors) {
                foreach ($errors as $error) {
                    $all_errors .= $error . "<br>";
                }
            }

            return response()->json(['success' => false, 'message' => $all_errors]);
        }
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'updated_by' => Auth::user()->id
            ];

            $user = User::find($id);
            $user->update($data);

            $role = Role::find($request->role);

            $user->syncRoles($role);

            return json_encode(['success' => true, 'message' => 'User updated', 'url' => route('users.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!' . $th]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {

            $user = User::find($id);

            // Delete the user
            $user->delete();

            return json_encode(['success' => true, 'message' => 'User deleted', 'url' => route('users.index')]);
        } catch (\Throwable $th) {
            //throw $th;
            return json_encode(['success' => false, 'message' => 'Something went wrong!']);
        }
    }
}
