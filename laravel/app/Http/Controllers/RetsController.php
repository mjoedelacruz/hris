<?php

namespace App\Http\Controllers;
error_reporting(0);
use Illuminate\Http\Request;
use PHRETS\Configuration;
use PHRETS\Session;

class RetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = new Configuration;
        $config ->setLoginUrl('https://matrixrets.ntreis.net/rets/Login.ashx')
                ->setUsername('PlacesterInc')
                ->setPassword('x!7UV.B2')
                ->setRetsVersion('1.8');

        $rets = new Session($config);

        // If you're using Monolog already for logging, you can pass that logging instance to PHRETS for some additional
        // insight into what PHRETS is doing.
        //
        // $log = new \Monolog\Logger('PHRETS');
        // $log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
        // $rets->setLogger($log);

        $connect = $rets->Login();

        // $system = $rets->GetSystemMetadata();
        // $system;

        // $resources = $system->getResources();
        // $classes = $resources->first()->getClasses();
        // var_dump($classes);

        // $classes = $rets->GetClassesMetadata('Property');
        // var_dump($classes->first());

        // $objects = $rets->GetObject('Property', 'Photo', '00-1669', '*', 1);
        // var_dump($objects);

        // $fields = $rets->GetTableMetadata('Property', 'Listing');
        // dd($fields);
        // return $fields[0];

        $results = $rets->Search('Property', 'Listing', 'Status=A', ['Limit' =>10, 'Select' => '*']);
        // foreach ($results as $r) {
        //     var_dump($r);
        // }
        // $all_ids = $results->lists('PublicRemarks');
        // dd($all_ids);

        return [
            "data"=> $results->toArray(),
            "total"=>$results->getTotalResultsCount()
        ];


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = new Configuration;
        $config ->setLoginUrl('https://matrixrets.ntreis.net/rets/Login.ashx')
                ->setUsername('PlacesterInc')
                ->setPassword('x!7UV.B2')
                ->setRetsVersion('1.8');

        $rets = new Session($config);
        $connect = $rets->Login();
        $results = $rets->Search('Property', 'Listing', "MLSNumber={$id}", ['Limit' =>10, 'Select' => '*']);
        return [
            "data"=> $results->toArray(),
            "total"=>$results->getTotalResultsCount()
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}