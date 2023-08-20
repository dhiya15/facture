<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddExpensesRequest;
use App\Http\Requests\FindDarJma3aExpensesRequest;
use App\Http\Requests\FindExpensesRequest;
use App\Http\Requests\UpdateDarJma3aExpensesRequest;
use App\Models\DarJma3aExpense;
use Illuminate\Http\Request;

class DarJma3aExpenseController extends Controller
{
    public function create(AddExpensesRequest $request) {
        try {
            $data = $request->all();
            $data["type_id"] = $data["type"];
            DarJma3aExpense::create($data);
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
            $data = DarJma3aExpense::with("type")->get();
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

    public function update(UpdateDarJma3aExpensesRequest $request)
    {
        try {
            $expense = DarJma3aExpense::find($request->id);

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

    public function delete(FindDarJma3aExpensesRequest $request)
    {
        try {
            $expense= DarJma3aExpense::find($request->id);
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
