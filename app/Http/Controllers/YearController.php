<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddYearRequest;
use App\Http\Requests\FindYearRequest;
use App\Http\Requests\UpdateYearRequest;
use App\Models\Member;
use App\Models\MemberParticipation;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function create(AddYearRequest $request) {
        try {
            $data = $request->all();
            $years = Year::all();
            if(count($years) == 0){
                $data["is_current"] = true;
            }
            $data = Year::create($data);
            if($data->is_current == 1) {
                Year::query()->where("id", '!=', $data->id)
                    ->update(["is_current" => 0]);
            }

            /*$members = Member::all();
            foreach ($members as $member){
               MemberParticipation::create([
                   "year_id" => $data->id,
                   "member_id" => $member->id
               ]);
            }*/


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
            $data = Year::all();
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

    public function update(UpdateYearRequest $request)
    {

        try {

            $year = Year::find($request->id);

            if(!empty($request->input('name')) && !is_null($request->input('name'))){
                $year->name = $request->input('name');
            }
            if(!empty($request->input('month_amount')) && !is_null($request->input('month_amount'))){
                $year->month_amount = $request->input('month_amount');
            }
           // if(!empty($request->input('is_active')) && !is_null($request->input('is_active'))){
                $year->is_active = ($request->input('is_active') == true) ? 1 : 0;
            //}
           // if(!empty($request->input('is_current')) && !is_null($request->input('is_current'))){
                $year->is_current = ($request->input('is_current') == true) ? 1 : 0;
                if($year->is_current == 1) {
                    Year::query()->where("id", '!=', $year->id)
                        ->update(["is_current" => 0]);
                }
            //}

            $year->update();

            $years = Year::query()->where("is_current", 1)->get();
            if(count($years) == 0){
                Year::query()->first()->update(["is_current" => 1]);
            }

            return response()->json([
                "success" => true,
                "data" => $year
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function delete(FindYearRequest $request)
    {
        try {
            $year= Year::find($request->id);
            $edit = false;
            if($year->is_current == 1) {
                $edit = true;
            }
            if($year->delete()){
                if($edit == true){
                    $first = Year::query()->first();
                    if($first){
                        $first->update(["is_current" => 1]);
                    }
                }
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
