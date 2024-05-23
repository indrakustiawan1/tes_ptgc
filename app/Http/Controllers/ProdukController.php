<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        return view('admin.produk.index');
    }

    public function produk_list(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($value) {
                    return $value->name;
                })
                ->addColumn('description', function ($value) {
                    return $value->description;
                })
                ->addColumn('price', function ($value) {
                    return $value->price;
                })
                ->addColumn('stock', function ($value) {
                    return $value->stock;
                })
                ->addColumn('category', function ($value) {
                    return $value->category_id;
                })
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-warning" data-id="' . $value->id . '" id="btn-edit"><i class="ti-check-box"></i></button>
                    <button type="button" class="btn btn-sm btn-danger" data-id="' . $value->id . '" id="btn-delete"><i class="ti-trash"></i></button>
                </div>';
                    return $actionBtn;
                })
                ->rawColumns(['name', 'description', 'price', 'stock', 'category', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'price'  => 'required',
            'stock'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => FALSE,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category,
        ];

        if ($request->id) {

            Produk::find($request->id)->update($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'update'
            ], 200);
        } else {

            Produk::create($data);

            return response()->json([
                'status' => TRUE,
                'message' => 'create'
            ], 200);
        }
    }

    public function edit(Produk $produk)
    {
        return response()->json([
            'data' => $produk,
            'status' => true
        ], 200);
    }

    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return response()->json([
            'status' => TRUE,
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
