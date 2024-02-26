<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInfoRequest;
use App\Http\Requests\FindInfoRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function create(AddInfoRequest $request) {
        try {
            $data = $request->all();
            if($request->hasFile("image")) {
                $data["image"] = 'storage/' . $request->file('image')->store('images', 'public');
            }
            Info::create($data);
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
            $data = Info::all();
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

    public function update(UpdateInfoRequest $request)
    {
        try {
            $member = Info::find($request->id);

            if($request->hasFile("image")) {
                $member->image = 'storage/' . $request->file('image')->store('images', 'public');
            }
            if(!empty($request->input('key')) && !is_null($request->input('key'))){
                $member->key = $request->input('key');
            }
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
            if(!empty($request->input('address_fr')) && !is_null($request->input('address_fr'))){
                $member->address_fr = $request->input('address_fr');
            }
            if(!empty($request->input('address_ar')) && !is_null($request->input('address_ar'))){
                $member->address_ar = $request->input('address_ar');
            }
            if(!empty($request->input('register_number')) && !is_null($request->input('register_number'))){
                $member->register_number = $request->input('register_number');
            }
            if(!empty($request->input('id_number')) && !is_null($request->input('id_number'))){
                $member->id_number = $request->input('id_number');
            }
            if(!empty($request->input('statistics_number')) && !is_null($request->input('statistics_number'))){
                $member->statistics_number = $request->input('statistics_number');
            }
            if(!empty($request->input('account_number')) && !is_null($request->input('account_number'))){
                $member->account_number = $request->input('account_number');
            }
            if(!empty($request->input('header_ar')) && !is_null($request->input('header_ar'))){
                $member->header_ar = $request->input('header_ar');
            }
            if(!empty($request->input('header_fr')) && !is_null($request->input('header_fr'))){
                $member->header_fr = $request->input('header_fr');
            }
            if(!empty($request->input('agency_ar')) && !is_null($request->input('agency_ar'))){
                $member->agency_ar = $request->input('agency_ar');
            }
            if(!empty($request->input('agency_fr')) && !is_null($request->input('agency_fr'))){
                $member->agency_fr = $request->input('agency_fr');
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

    public function delete(FindInfoRequest $request)
    {
        try {
            $member= Info::find($request->id);
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
