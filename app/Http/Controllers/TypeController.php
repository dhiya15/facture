<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTypeRequest;
use App\Http\Requests\FindTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function create(AddTypeRequest $request) {
        try {
            $data = $request->all();
            Type::create($data);
            return response()->json([
                "success" => true,
                "message" => "Opération réussie"
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
            $data = Type::all();
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

    public function update(UpdateTypeRequest $request)
    {

        try {

            $type = Type::find($request->id);

            if(!empty($request->input('name')) && !is_null($request->input('name'))){
                $type->name = $request->input('name');
            }
            if(!empty($request->input('description')) && !is_null($request->input('description'))){
                $type->description = $request->input('description');
            }

            $type->update();

            return response()->json([
                "success" => true,
                "data" => $type
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function delete(FindTypeRequest $request)
    {
        try {
            $type= Type::find($request->id);
            if($type->delete()){
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
