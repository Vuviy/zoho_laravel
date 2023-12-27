<?php

namespace App\Http\Controllers;

use App\Http\Autorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddDealController extends Controller
{
    public $access_token;

    public function authentication(Request $request)
    {
        $validation = $request->validate([
            'code' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);
        $code = $request->input('code');
        $client_id = $request->input('client_id');
        $client_secret = $request->input('client_secret');

        $res = new Autorize($code, $client_id, $client_secret);

        $refresh = $res->refresh();

        return $access = $res->access($refresh);

    }


    public function addDeal(Request $request)
    {

        $validation = $request->validate([
            'deal_name' => 'required',
            'subject' => 'required',
            'stage' => 'required',
            'pipeline' => 'required',
        ]);
        $access_token = $request->input('access_token');
        $deal_name = $request->input('deal_name');
        $stage = $request->input('stage');
        $pipeline = $request->input('pipeline');
        $subject = $request->input('subject');


    $add_deal = Http::withHeaders([
        'Authorization' => 'Zoho-oauthtoken ' . $access_token,
    ])->post('https://www.zohoapis.com/crm/v2/Deals',[
                    'data' => [
                        [
                            "Deal_Name" => $deal_name,
                            "Stage" => $stage,
                            "Pipeline" => $pipeline
                        ]
                    ],
                    'trigger' => [
                        "approval",
                        "workflow",
                        "blueprint"
                    ]
            ]
    );
        $getId = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $access_token,
        ])->get('https://www.zohoapis.com/crm/v2/Deals?fields=Id&sort_by=Created_Time&sort_order=desc');
        $id = json_decode($getId)->data[0]->id;


        $add_tusk = Http::withHeaders([
            'Authorization' => 'Zoho-oauthtoken ' . $access_token,
        ])->post('https://www.zohoapis.com/crm/v2/Tasks',[
                'data' => [
                    [
                        "Subject" => $subject,
                        '$se_module' => "Deals",
                        "What_Id" =>[
                            "id"=> $id
                        ]
                    ]
                ],
                'trigger' => [
                    "approval",
                    "workflow",
                    "blueprint"
                ]
            ]
        );
        return redirect()->route('finish_page');
    }
}
