<?php

namespace App\Http\Controllers;

use App\Deputy;
use App\Helpers\Helper;
use App\Indemnity;
use Illuminate\Http\Request;

use function GuzzleHttp\json_decode;

// use Illuminate\Http\Response;

class IndemnityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $year = $request->query('year') ;
        $month = $request->query('month') ;

        $indemnities = new Indemnity();
        return $indemnities->get($year, $month);
        // $this->store($year, $month);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 120);
        
        $year = $request->year;
        $month = $request->month;

        // Indemnity::truncate();
        $indemnitiesVerify = Indemnity::where('dateReference', 'LIKE', "{$year}-{$month}%")->get();

        // return sizeof($indemnitiesVerify);
        if(sizeof($indemnitiesVerify) > 0 ){
            return ['msg' => 'Already registered'];
        }
       
        $deputies = Deputy::all();
        foreach ($deputies as $deputy) {
            $url = 'http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/' . $deputy->id . '/' . $year. '/' . $month . '?formato=json';
            // dd($url);

            $fileContents  =  file_get_contents($url);
            // dd($fileContents);

            $array = json_decode($fileContents, true);
            // dd($array);

            $indemnities = $array['list'];
            // dd($indemnities);

            // echo '<pre>';
            $indemnitiesNews = [];
            foreach ($indemnities as $key => $indemnity) {
                $indemnitiesNews[$key]['deputy_id'] = $indemnity['idDeputado'];
                $indemnitiesNews[$key]['dateReference'] = $indemnity['dataReferencia']["$"];
                $indemnitiesNews[$key]['value'] = $indemnity['valor'];
                $indemnitiesNews[$key]['description'] = $indemnity['descTipoDespesa'];
                $indemnitiesNews[$key]['created_at']  = date('Y-m-d H:i:s');
                $indemnitiesNews[$key]['updated_at']  = date('Y-m-d H:i:s');
     
            }

            // dd($indemnitiesNews);
            Indemnity::insert($indemnitiesNews);
            // sleep(1);
        }

        return ['message ' => 'Registered successfully'] ;
        // dd($indemnities);
        // dd($indemnities);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indemnity  $indemnity
     * @return \Illuminate\Http\Response
     */
    public function show(Indemnity $indemnity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indemnity  $indemnity
     * @return \Illuminate\Http\Response
     */
    public function edit(Indemnity $indemnity)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indemnity  $indemnity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indemnity $indemnity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indemnity  $indemnity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indemnity $indemnity)
    {
        //
    }
}
