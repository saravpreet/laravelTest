<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller {

    //
    public function index() {

        $isAjax = request()->query('isAjax');

        $raw = array_filter(explode("\n", file_get_contents('store')));

        $products = [];

        foreach ($raw as $row) {
            $jRow = json_decode($row, true);
            $ts   = key($jRow);

            list($sec) = explode('.', $ts);
            $jRow[$ts]['dt']    = date('m-d-Y g:ia', $sec);
            $jRow[$ts]['total'] = $jRow[$ts]['quanStock'] * $jRow[$ts]['price'];

            $products[$ts] = $jRow[$ts];
        }


        //ss: sorting using datetime
        krsort($products);
//        print_r($products);exit;

        $data = [
            'title'     => 'TEST',
            'jsonPData' => $products
        ];

        if ($isAjax == 'ajax') {
            $htmlOut = '';

            foreach ($products as $row) {
                $htmlOut .= "
                            <tr>
                                <td>{$row['pName']}</td>
                                <td>{$row['quanStock']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['dt']}</td>
                                <td>{$row['total']}</td>
                            </tr>
                            ";
            }
            echo $htmlOut;
            exit;
        }

        return view('home')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $dt     = new \DateTime();
        $post   = request()->all();
        $isAjax = ($post['isAjax'] == 'ajax') ? true : false;
        $ts     = microtime(true);

        unset($post['isAjax']);

        if (!empty($post['pName'])) {
            $products[$ts] = $post;

            $json = json_encode($products) . "\n";
            file_put_contents('store', $json, FILE_APPEND);
        }

        if ($isAjax == true) {
            echo 'success';
            exit;
        }
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
