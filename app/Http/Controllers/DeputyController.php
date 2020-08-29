<?php

namespace App\Http\Controllers;

use App\Deputy;
use Helper;
use Illuminate\Http\Request;

use function GuzzleHttp\json_decode;

class DeputyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deputies = new Deputy();
        return $deputies->get();
    }



    /**
     * Store all deputies who are serving their mandate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = 'http://dadosabertos.almg.gov.br/ws/deputados/em_exercicio?formato=json';

        $fileContentes = file_get_contents($url);
        // dd($fileContentes);

        $array = json_decode($fileContentes, true);
        // dd($array);
        $deputies = $array['list'];
        // dd($deputies);

        // /**
        //  * Loot to creat attributes "created_at" and "updated_at"
        //  */
        foreach ($deputies as $key => $deputy) {
            $deputiesNews[$key]['id'] = $deputy['id'];
            $deputiesNews[$key]['name'] = $deputy['nome'];
            $deputiesNews[$key]['party']  = $deputy['partido'];
            $deputiesNews[$key]['tagLocation']  = $deputy['tagLocalizacao'];
            $deputiesNews[$key]['created_at'] = date('Y-m-d H:i:s');
            $deputiesNews[$key]['updated_at']  = date('Y-m-d H:i:s');
        }
        // dd($deputiesNews);
        $deputy = new Deputy();
        return $deputy->create($deputiesNews);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deputy $deputy
     * @return \Illuminate\Http\Response
     */
    public function show(Deputy $deputy)
    {
        //
    }

    public function update(Request $request, Deputy $deputy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deputies  $deputies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deputy $deputy)
    {
        //
    }
}
