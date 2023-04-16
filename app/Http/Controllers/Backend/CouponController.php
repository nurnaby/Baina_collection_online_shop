<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function AllCoupon(){
        $data['coupons']=Coupon::get();
        return view('admin.coupon.all_coupon',$data);
    }
    public function AddCoupon(){
        
        return view('admin.coupon.add_coupon');
    }//End method
    public function StoreCoupon(Request $request){
        
        Coupon::insert([
            'coupon_name'     => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'validate'          => $request->validate,
            'created_at'          => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Coupon add  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification); 
    } //End method

public function EditCoupon($id){
    $data['coupons']=Coupon::find($id);
    
    return view('admin.coupon.edit_coupon',$data);
}//End method
public function UpdateCoupon(Request $request){
    $coupon_id = $request->id;
    Coupon::find($coupon_id)->update([
        'coupon_name'     =>strtoupper($request->coupon_name),
        'coupon_discount' => $request->coupon_discount,
        'validate'        => $request->validate,
        'created_at'      => Carbon::now(),
    ]);
    $notification = array(
        'message' => 'Coupon add  Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.coupon')->with($notification); 
}//End method



}