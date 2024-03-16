<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create(Request $request) {
        try {
            $data = $request->all();
            Invoice::create($data);
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
            $data = Invoice::with('member', 'info')->get();
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
            $invoice = Invoice::query()->firstWhere("id", "=", $request->id);
            $invoice->update($request->all());
            return response()->json([
                "success" => true,
                "message" => "success",
                "data" => $invoice,
            ]);
        } catch(\Exception $exception) {
            return response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
                "data" => null,
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $invoice= Invoice::find($request->id);
            if($invoice->delete()){
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
