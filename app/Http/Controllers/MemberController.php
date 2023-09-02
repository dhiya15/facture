<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMemberRequest;
use App\Http\Requests\FindMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use App\Models\MemberParticipation;
use App\Models\Year;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function create(AddMemberRequest $request) {
        try {
            $data = $request->all();
            if($request->hasFile("image")) {
                $data["image"] = 'storage/' . $request->file('image')->store('images', 'public');
            }
            Member::create($data);
            /*$years = Year::all();
            foreach ($years as $year){
                MemberParticipation::create([
                    "year_id" => $year->id,
                    "member_id" => $member->id
                ]);
            }*/
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
            $data = Member::all();
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

    public function update(UpdateMemberRequest $request)
    {
        try {
            $member = Member::find($request->id);

            if($request->hasFile("image")) {
                $member->image = 'storage/' . $request->file('image')->store('images', 'public');
            }

            if(!empty($request->input('full_name')) && !is_null($request->input('full_name'))){
                $member->full_name = $request->input('full_name');
            }
            if(!empty($request->input('email')) && !is_null($request->input('email'))){
                $member->email = $request->input('email');
            }
            if(!empty($request->input('phone')) && !is_null($request->input('phone'))){
                $member->phone = $request->input('phone');
            }
            if(!empty($request->input('profession')) && !is_null($request->input('profession'))){
                $member->profession = $request->input('profession');
            }
            if(!empty($request->input('birth_date')) && !is_null($request->input('birth_date'))){
                $member->birth_date = $request->input('birth_date');
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

    public function delete(FindMemberRequest $request)
    {
        try {
            $member= Member::find($request->id);
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
