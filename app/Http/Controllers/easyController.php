<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Model\Estimate;
use Illuminate\Database\QueryException;


class easyController extends Controller
{

    public function index ()
    {
       $dataQuery = Estimate::all();

        return view ('estimate')->with('dataQuery', $dataQuery);


    }
    public function getToken()
    {
        $client = new Client(['headers' => ['Content-Type'=>'application/json', 'accept'=>'application/json']]);
        $result = $client->post('https://api.easymundi.com/oauth/token',
                                ['form_params' =>[
                                'grant_type' => 'password',
                                'client_id'   => 1,
                                'client_secret' =>'1VZlziQ8J2obtEg1NByxxnC4DJqq6BeXs2Lxgkry',
                                'username' => 'admin@easymundi.com',
                                'password'=> '123456',
                                'scope' => '*'
                                ]
        ]);



        return $token= json_decode($result->getBody(), true);
    }

    public function getEstimate($token)
    {
        $autorization = $token['token_type']." ". $token['access_token'];
        $client = new Client(['headers' => ['Content-Type'=>'application/json',
                                            'accept'=>'application/json',
                                            'Authorization'=>$autorization]]);
        $result = $client->get('https://api.easymundi.com/api/shipping/estimate?value=39.267249064&weight=450&province=SP&currency=USD&zipcode=05143');

                return $estimates = json_decode($result->getBody()->getContents(),true);
    }


    public function store()
    {
        $token = $this->getToken();
        $estimates = $this->getEstimate($token);

        $query = new Estimate;
        $query->type = $estimates[0]['type'];
        $query->operationCost = $estimates[0]['operationCost'];
        $query->tax =  $estimates[0]['tax'];
        $query->customsCost =  $estimates[0]['customsCost'];
        $query->lastMileCost = $estimates[0]['lastMileCost'];
        $query->exchangeRate = $estimates[0]['exchangeRate'];
        $query->total = $estimates[0]['total'];
        $query->save();

        if($query){return redirect('/index');}
    }


}
