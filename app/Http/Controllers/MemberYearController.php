<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberYear;
use Illuminate\Http\Request;

class MemberYearController extends Controller
{
    public function create(Request $request) {
        try {
            $data = $request->all();
            MemberYear::create($data);
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

    public function getAll($id) {
        try {
            $data = Member::with(["years" => function ($query) use ($id) {
                $query->where('year_id', $id);
            }])->get();

           /* $data = Member::with("years")
                ->get();*/
            return response()->json([
                "success" => true,
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => [],
                "message" => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request)
    {
        try {
            $memberParticipation = MemberYear::find($request->id);

            if(!empty($request->input('motif')) && !is_null($request->input('motif'))){
                $memberParticipation->motif = $request->input('motif');
            }
            if(!empty($request->input('amount')) && !is_null($request->input('amount'))){
                $memberParticipation->amount = $request->input('amount');
            }

            $memberParticipation->update();

            return response()->json([
                "success" => true,
                "data" => $memberParticipation
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
            $memberParticipation= MemberYear::find($request->id);
            if($memberParticipation->delete()){
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
