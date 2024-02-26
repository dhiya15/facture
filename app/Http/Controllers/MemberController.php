<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMemberRequest;
use App\Http\Requests\FindMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function create(AddMemberRequest $request) {
        try {
            $data = $request->all();
            Member::create($data);
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

            if(!empty($request->input('full_name_ar')) && !is_null($request->input('full_name_ar'))){
                $member->full_name_ar = $request->input('full_name_ar');
            }
            if(!empty($request->input('full_name_fr')) && !is_null($request->input('full_name_fr'))){
                $member->full_name_fr = $request->input('full_name_fr');
            }
            if(!empty($request->input('email')) && !is_null($request->input('email'))){
                $member->email = $request->input('email');
            }
            if(!empty($request->input('phone')) && !is_null($request->input('phone'))){
                $member->phone = $request->input('phone');
            }
            if(!empty($request->input('address_ar')) && !is_null($request->input('address_ar'))){
                $member->address_ar = $request->input('address_ar');
            }
            if(!empty($request->input('address_fr')) && !is_null($request->input('address_fr'))){
                $member->address_fr = $request->input('address_fr');
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
