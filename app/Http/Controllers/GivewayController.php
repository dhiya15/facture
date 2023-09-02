<?php

namespace App\Http\Controllers;

use App\Models\Giveway;
use Illuminate\Http\Request;

class GivewayController extends Controller
{
    public function create(Request $request) {
        try {
            $data = $request->all();
            Giveway::create($data);
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
            $data = Giveway::all();
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

    public function update(Request $request)
    {
        try {
            $giveway = Giveway::find($request->id);

            if(!empty($request->input('title')) && !is_null($request->input('title'))){
                $giveway->title = $request->input('title');
            }
            if(!empty($request->input('amount')) && !is_null($request->input('amount'))){
                $giveway->amount = $request->input('amount');
            }
            if(!empty($request->input('description')) && !is_null($request->input('description'))){
                $giveway->description = $request->input('description');
            }

            $giveway->update();

            return response()->json([
                "success" => true,
                "data" => $giveway
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function delete(Request $request)
    {
        try {
            $giveway = Giveway::find($request->id);
            if($giveway->delete()){
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
