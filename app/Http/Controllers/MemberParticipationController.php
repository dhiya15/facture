<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMemberPaticipationRequest;
use App\Http\Requests\FindMemberPaticipationRequest;
use App\Http\Requests\UpdateMemberPaticipationRequest;
use App\Models\Member;
use App\Models\MemberParticipation;
use Illuminate\Http\Request;

class MemberParticipationController extends Controller
{
    public function create(AddMemberPaticipationRequest $request) {
        try {
            $data = $request->all();
            MemberParticipation::create($data);
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

    public function getAll($id) {
        try {
            $data = Member::with("participations")->get();
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

    public function update(UpdateMemberPaticipationRequest $request)
    {
        try {
            $memberParticipation = MemberParticipation::find($request->id);

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

    public function delete(FindMemberPaticipationRequest $request)
    {
        try {
            $memberParticipation= MemberParticipation::find($request->id);
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
