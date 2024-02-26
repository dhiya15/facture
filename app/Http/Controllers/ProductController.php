<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\FindProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(AddProductRequest $request) {
        try {
            $data = $request->all();
            Product::create($data);
            return response()->json([
                "success" => true,
                "message" => "نجحت العملية"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function getAll(Request $request) {
        try {
            $data = Product::all();
            return response()->json([
                "success" => true,
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => []
            ], 404);
        }
    }

    public function update(UpdateProductRequest $request)
    {
        try {
            $member = Product::find($request->id);

            if(!empty($request->input('name')) && !is_null($request->input('name'))){
                $member->name = $request->input('name');
            }

            $member->update();

            return response()->json([
                "success" => true,
                "data" => $member
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function delete(FindProductRequest $request)
    {
        try {
            $member= Product::find($request->id);
            if($member->delete()){
                return response()->json([
                    "success" => true,
                ]);
            }else{
                return response()->json([
                    "success" => false,
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
            ], 404);
        }
    }
}
