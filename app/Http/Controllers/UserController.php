<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('admin.user.index', compact('role'));
    }

    public function user_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('info', function ($value) {
                    $info = '<a href="product-detail.html" class="d-flex align-items-center">
                                <img width="40" src="admin/assets/media/image/products/user.jpg" class="rounded mr-3" alt="Armchair">
                                <span>' . $value->name . ' ' . $value->name_belakang . '</span>
                            </a>';

                    return $info;
                })
                ->addColumn('email', function ($value) {
                    return $value->email;
                })
                // ->addColumn('roles', function ($value) {
                //     if ($value->roles[0]->name == "admin") {
                //         $roles = '<span class="badge bg-success-bright text-success">' . $value->roles[0]->name . '</span>';
                //     } else {
                //         $roles = '<span class="badge badge-dark">' . $value->roles[0]->name . '</span>';
                //     }

                //     return $roles;
                // })
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-warning" data-id="' . $value->id . '" id="btn-edit"><i class="ti-check-box"></i></button>
                    <button type="button" class="btn btn-sm btn-danger" data-id="' . $value->id . '" id="btn-delete"><i class="ti-trash"></i></button>
                </div>';
                    return $actionBtn;
                })
                ->rawColumns(['info', 'email', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email'  => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = [
            'name' => $request->name,
            'name_belakang' => $request->name_belakang,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        if ($request->id) {

            User::find($request->id)->update($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'update'
            ], 200);
        } else {

            User::create($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'create'
            ], 200);
        }
    }

    public function edit(User $user)
    {
        return response()->json([
            'data' => $user,
            'status' => true
        ], 200);
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return response()->json([
            'status' => TRUE,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
