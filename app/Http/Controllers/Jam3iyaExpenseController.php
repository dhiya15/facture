<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddExpensesRequest;
use App\Http\Requests\FindExpensesRequest;
use App\Http\Requests\UpdateExpensesRequest;
use App\Models\Jam3iyaExpense;
use Illuminate\Http\Request;

class Jam3iyaExpenseController extends Controller
{
    public function create(AddExpensesRequest $request) {
        try {
            $data = $request->all();
            $data["type_id"] = $data["type"];
            Jam3iyaExpense::create($data);
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
            $data = Jam3iyaExpense::with("type")->get();
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

    public function update(UpdateExpensesRequest $request)
    {
        try {
            $expense = Jam3iyaExpense::find($request->id);

            if(!empty($request->input('type')) && !is_null($request->input('type'))){
                $expense->type_id = $request->input('type');
            }
            if(!empty($request->input('amount')) && !is_null($request->input('amount'))){
                $expense->amount = $request->input('amount');
            }
            if(!empty($request->input('description')) && !is_null($request->input('description'))){
                $expense->description = $request->input('description');
            }

            $expense->update();

            return response()->json([
                "success" => true,
                "data" => $expense
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function delete(FindExpensesRequest $request)
    {
        try {
            $expense= Jam3iyaExpense::find($request->id);
            if($expense->delete()){
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
