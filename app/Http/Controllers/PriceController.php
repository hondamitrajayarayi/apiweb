<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PriceController extends Controller
{
    //
    public function index(){

    	$query = DB::connection('dealer')->select("select  pr.product_name, aa.product_id, amount_price From (select b.product_id, amount_price, date_from From mst_price_list_header a left join mst_price_list_detail b on a.pl_id = b.pl_id join mst_price_group c on  a.price_group_id = c.price_group_id left join mst_finance_company d on c.fin_comp_id = d.fin_comp_id where a.branch_id = 007 and fin_comp_name = 'TUNAI') aa join ( select product_id, max(date_from) date_from From mst_price_list_header a left join mst_price_list_detail b on a.pl_id = b.pl_id where a.branch_id = 007 group by product_id) bb on aa.product_id = bb.product_id and aa.date_from = bb.date_from and amount_price <> 0 join mst_product pr on aa.product_id = pr.product_id where pr.status= 1 order by pr.product_name asc");

        $prices = collect( $query );

    	$response =[
    		'msg' => 'Success',
    		'method' => 'GET',
    		'status' => '200 OK',
    		'prices' => $prices
    	];

    	return response()->json($response, 200);
    }

    public function branch(){
        $query = DB::connection('dealer')->select("SELECT BRANCH_NAME FROM VI_PRICE_WEB GROUP BY BRANCH_NAME");
        $branch = collect( $query );

        $response =[
            'msg' => 'Success',
            'method' => 'GET',
            'status' => '200 OK',
            'branch' => $branch
        ];

        return response()->json($response, 200);
    }

    public function price_branch($branch){

        $data = DB::connection('dealer')->table('VI_PRICE_WEB')
                    ->select('*')
                    ->where('BRANCH_NAME', '=', $branch)
                    ->get();

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            //$res['message'] = "Success!";
            $res['msg'] = 'Success';
            $res['method'] = 'GET';
            $res['status'] = '200 OK';
            $res['prices'] = $data;
            return response($res);
            return response()->json($res, 200);
        }
        else{
            $res['message'] = "404 !";
            return response()->json($res, 404);
        }
    }

    public function marketplace(){
        $data = DB::connection('bengkel')->select("SELECT * FROM MITRA.VI_STOCK_MARKETPLACE");

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            //$res['message'] = "Success!";
            $res['msg'] = 'Success';
            $res['method'] = 'GET';
            $res['status'] = '200 OK';
            $res['prices'] = $data;
            return response($res);
            return response()->json($res, 200);
        }
        else{
            $res['message'] = "404 !";
            return response()->json($res, 404);
        }
    }
}
