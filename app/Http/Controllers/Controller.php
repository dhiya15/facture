<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Rmunate\Utilities\SpellNumber;
use Shuchkin\SimpleXLSX;
use PDF;
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

    public function printInvoice(Request $request) {
        $client = Member::find($request->client);
        $info = Info::find($request->info);
        $items = $request->items;
        $lang = $request->lang;
        $number = $request->number;
        $withPrice = $request->withPrice;

        $total = 0;
        for($i=0; $i<count($items); $i++) {
            $total = $total + ($items[$i]["price"] * $items[$i]["qte"]);
        }

        $pdf = PDF::loadView('report.report2', [
            "client" => $client,
            "info" => $info,
            "items" => $items,
            "lang" => $lang,
            "number" => $number,
            "with_price" => $withPrice,
            "total" => $total,
        ], [], [
            'mode'                       => '',
            'format'                     => 'A4',
            'default_font_size'          => '12',
            'default_font'               => 'cairo',
            'margin_left'                => 10,
            'margin_right'               => 10,
            'margin_top'                 => 10,
            'margin_bottom'              => 10,
            'margin_header'              => 0,
            'margin_footer'              => 0,
            'orientation'                => 'P',
            'title'                      => 'Rapport',
            'author'                     => '',
            'watermark'                  => '',
            'show_watermark'             => false,
            'show_watermark_image'       => false,
            'watermark_font'             => 'sans-serif',
            'display_mode'               => 'fullpage',
            'watermark_text_alpha'       => 0.1,
            'watermark_image_path'       => '',
            'watermark_image_alpha'      => 0.2,
            'watermark_image_size'       => 'D',
            'watermark_image_position'   => 'P',
            'unAGlyphs' => true,
            'custom_font_dir'  => base_path('resources/fonts/'), // don't forget the trailing slash!
            'custom_font_data' => [
                'cairo' => [ // must be lowercase and snake_case
                    'R'  => 'Cairo.ttf',    // regular font
                    'B'  => 'Cairo_Bold.ttf',       // optional: bold font
                ],
                'montserrat' => [ // must be lowercase and snake_case
                    'R'  => 'Montserrat.ttf',    // regular font
                    'B'  => 'Montserrat_Bold.ttf',       // optional: bold font
                    'I'  => 'Montserrat_Italic.ttf',     // optional: italic font
                    'BI' => 'Montserrat_Bold_Italic.ttf' // optional: bold-italic font
                ],
                'candara' => [ // must be lowercase and snake_case
                    'R'  => 'Candara.ttf',    // regular font
                    'B'  => 'Candara_Bold.ttf',       // optional: bold font
                    'I'  => 'Candara_Italic.ttf',     // optional: italic font
                    'BI' => 'Candara_Bold_Italic.ttf' // optional: bold-italic font
                ],
                'ubuntu' => [ // must be lowercase and snake_case
                    'R'  => 'Ubuntu.ttf',    // regular font
                    'B'  => 'Ubuntu_Bold.ttf',       // optional: bold font
                    'I'  => 'Ubuntu_Italic.ttf',     // optional: italic font
                    'BI' => 'Ubuntu_Bold_Italic.ttf' // optional: bold-italic font
                ],
                // ...add as many as you want.
            ],
            'auto_language_detection'    => true,
            'temp_dir'                   => storage_path('app'),
            'pdfa'                       => true,
            'pdfaauto'                   => true,
            'use_active_forms'           => false,
            'autoArabic' => true,
            'autoLangToFont' => true
        ]);

        return $pdf->output('report2.pdf');
    }
}
