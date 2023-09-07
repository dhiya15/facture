<?php

namespace App\Http\Controllers;

use App\Models\Revenues;
use Illuminate\Http\Request;

class RevenuesController extends Controller
{
    public function create(Request $request) {
        try {
            $data = $request->all();
            Revenues::create($data);
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
            $data = Revenues::all();
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
            $revenues = Revenues::find($request->id);

            if(!empty($request->input('title')) && !is_null($request->input('title'))){
                $revenues->title = $request->input('title');
            }
            if(!empty($request->input('amount')) && !is_null($request->input('amount'))){
                $revenues->amount = $request->input('amount');
            }
            if(!empty($request->input('description')) && !is_null($request->input('description'))){
                $revenues->description = $request->input('description');
            }

            $revenues->update();

            return response()->json([
                "success" => true,
                "data" => $revenues
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
            $revenues = Revenues::find($request->id);
            if($revenues->delete()){
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
