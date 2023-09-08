<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Shuchkin\SimpleXLSX;
use function PHPUnit\Framework\isNull;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadMembers(Request $request) {
        try{
            $xlsx = SimpleXLSX::parse($request->file('file')->path());
            $index = 0;
            $messages = "";
            if ( $xlsx->success() ) {
                foreach( $xlsx->rows() as $row ) {
                    if($index > 0){
                        if(!empty($row[2]) && !empty($row[1]) && !empty($row[0])){
                            Member::create(
                                [
                                    "full_name" => $row[2],
                                    "email" => $row[3],
                                    "image" => null,
                                    "birth_date" => $row[1],
                                    "phone" => $row[0],
                                ]
                            );
                        }else{
                            $messages = $messages . "لم يتم اضافة السطر رقم: $index" . "<br>";
                        }
                    }
                    $index++;
                }
                return response()->json([
                    "success" => true,
                    "message" => "نجحت العملية" . "<br>". $messages
                ]);
            } else {
                return response()->json([
                    "success" => true,
                    "message" => "فشلت العملية"
                ], 400);
            }
        }catch (\Exception $e) {
            return response()->json([
                "success" => true,
                "message" => "لقد فشلت العملية، يرجى منكم التأكد من سلامة البيانات"
            ], 400);
        }
    }
}
