<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product_key;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminPanel(){
        return view("Admin.adminPanel");
    }

    public function add_product_key(Request $request){
        $data = $request->validate([
            "product_key"=>"required|string|max:16|unique:product_keys,product_key",
            "expire_date"=>"required"
        ]);
        Product_key::create($data);
        return redirect(url("admin"));
    }

    public function show_product_keys(){
        $product_key = Product_key::all();
        return view("Admin.showAllProductKey")->with("product_key",$product_key);   //return all product keys
    }

    public function show_all_product_key(){
        $product_key = Product_key::all();
        return view("Admin.showAllProductKey")->with("product_key",$product_key);

    }

    public function check_expiration($product_key){
        $product = Product_key::where('product_key',$product_key)->get();
        $expire_date = $product[0]['expire_date'];
        $currentDate = Carbon::now();
        $expireDateCarbon = Carbon::parse($expire_date);
        if ($expireDateCarbon->isPast()) {
            $is_expire = 'false';
            $daysRemaining= '0';
        } else {
            $is_expire = 'true';
            $date1 = Carbon::parse($expire_date);
            $date2 = Carbon::parse($currentDate);
            $daysRemaining = $date1->diffInDays($date2 );
        }
        // return $daysRemaining;
        $jsonData=array(
            'is_expire' => $is_expire,
            'daysRemaining' =>$daysRemaining
        );
        $jsonData= json_encode($jsonData);
        return $jsonData;
        return view("Admin.ShowSpecificProduct")->with("jsonData",$jsonData);
    }
    

    public function test($jsonData){
        echo $jsonData;
    }


}
