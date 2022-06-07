<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            $url = 'https://date.nager.at/api/v3/AvailableCountries';
            $client = new Client(['verify' => false ]);
            $response = $client->request('GET',$url);
            
            $statusCode = $response->getStatusCode();
            if($statusCode != 200){
                return error_res('something might wrong. Please try later.');
            }

            $data = json_decode($response->getBody(),true);
 
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $url = 'https://date.nager.at/api/v3/CountryInfo/'.$id;
        $client = new Client(['verify' => false ]);
        $response = $client->request('GET',$url);
        
        $statusCode = $response->getStatusCode();
        if($statusCode != 200){
            return array('message'=>error_res('something might wrong. Please try later.'),'data'=>[]);
        }

        $data = json_decode($response->getBody(),true);

        
        $url = 'https://date.nager.at/api/v3/PublicHolidays/'.date('Y').'/'.$id;
        $client = new Client(['verify' => false ]);
        $response = $client->request('GET',$url);
        
        $statusCode = $response->getStatusCode();
        if($statusCode != 200){
            return array('message'=>error_res('something might wrong. Please try later.'),'data'=>[]);
        }

        $holidayList = json_decode($response->getBody(),true);
        $data['countryWeekend'] = count($holidayList);
        $i = 0;
        $data['HolidayList'] = array();
        foreach($holidayList as $key => $val)
        {
            if($i <= 3)
            {
                if(date('Y-m-d',strtotime($val['date'])) >= date('Y-m-d'))
                {
                    $val['date'] = date('M d, Y',strtotime($val['date']));
                    $data['HolidayList'][] = $val;
                    $i++;
                }
            }
        }
        return view('countryDetail', compact('data'));
    }
}
