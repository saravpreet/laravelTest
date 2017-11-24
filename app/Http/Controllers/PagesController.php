<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller {

    //
    public function index() {

        $raw      = array_filter(explode("\n",file_get_contents('store')));
        
        $products=[];
        
        foreach($raw as $row){
            $product = json_decode($row,true);
            $ts=key($product);
            $dt=new \DateTime();
            $dt->setTimestamp($ts);
            $product[$ts]['dt']=$dt->format('m-d-Y g:ia');
            $product[$ts]['total']=$product[$ts]['quanStock']*$product[$ts]['price'];
            
            $products[$ts]=$product[$ts];
            
            
            
        }
        
        ksort($products);
//        print_r($products);exit;
        
        $data = [
            'title'    => 'TEST',
            'jsonPData' => $products
        ];

        return view('home')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $dt                            = new \DateTime();
        $products[$dt->getTimestamp()] = $_POST['products'];

        $json = json_encode($products) . "\n";
        file_put_contents('store', $json, FILE_APPEND);
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
