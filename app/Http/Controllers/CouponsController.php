<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Status;
use Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCoupon(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $request->validate([
            'coupon_code' => 'required',
            'amount' => 'required'
        ]);

        $coupon_code = request('coupon_code');

        $amount = request('amount');

        if($amount < 1000){

            return response() ->json(['errors' => ['coupon' => 'このクーポンは商品のお買い上げ金額が合計1,000円以上でご利用いただけます。']], 400);

        }else{

            if($coupon_code == 'welcomeback'){

                $first_order = Order::where('orders.user_id', '=', $user_id)->oldest()->first();
    
                if(!empty($first_order)){
    
                    $order_date = new Carbon($first_order->created_at);
    
                    if($user_id <= 28){
                        $deadline = $order_date->addMonths(4);
                    }else{
                        $deadline = $order_date->addMonths(2);
                    }
    
                    if($deadline >= Carbon::now()->toDateString()){
    
                        $coupon = Coupon::where('name', $coupon_code)
                            ->first();
                        
                        // DD($coupon);
    
                    }else{
    
                        return response() ->json(['errors' => ['coupon' => 'このクーポンは有効期限切れか、現在、提供されていません。']], 400);
                    }
    
                }else{
                    return response() ->json(['errors' => ['coupon' => 'このクーポンは有効期限切れか、現在、提供されていません。']], 400);
                }
    
            }else{
    
                $coupon = Coupon::where('name', $coupon_code)
                            ->whereDate('deadline', '>=', Carbon::now()->toDateString())
                            ->first();
    
                // DD($coupon);
            }
    
            // DD($coupon);
    
            if(empty($coupon)){
                return response() ->json(['errors' => ['coupon' => 'このクーポンは有効期限切れか、現在、提供されていません。']], 400);
                // return response() ->json(['errors' => 'このクーポンは現在提供されていません。'], 400);
            }else{
    
                $redeemed = $coupon-> users() -> where('user_id', $user_id) ->first();
    
                // DD($redeemed);
    
                if(!$redeemed){
        
                    return response() -> json(['coupon'=>$coupon]);
                    
                }else{
        
                    return response() ->json(['errors' => ['coupon' => 'このクーポンは使用済みです。']], 400);
                }
            }
        }
    }

    public function storeCouponData(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'coupon' => 'required',
        ]);

        $coupon_array = request('coupon');

        if($coupon_array['applied'] !== false){
            $coupon_id = $coupon_array['id'];

            $coupon = Coupon::find($coupon_id);
            // DD($coupon);

            $coupon->users()->attach($user->id);
        }

        // if($coupon_array['applied'] !== false){

        //     $coupon_id = $coupon_array['id'];
        //     $coupon = $user->coupons()->where('coupon_id', $coupon_id);

        //     $coupon->redeemed = 1;
        // }
    }

    public function createCoupon(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'minimum' => 'required',
            'target' => 'required'
        ]);

        $coupon = new Coupon();

        $coupon->name = request('name');
        $coupon->type = request('type');
        $coupon->value = request('value');
        $coupon->percent_off = request('percentOff');
        $coupon->minimum = request('minimum');
        $coupon->deadline = request('deadline');
        $coupon->target = request('target');
        $coupon->status_id = request('status_id');

        $coupon->save();

        $coupons = Coupon::get();

        return response() -> json(['coupons'=>$coupons]);

    }

    //会員が、2回目購入用のcouponにeligibleかどうかを確認する
    // public function checkIfCoupon()
    // {
    //     $user = Auth::user();

    //     if(!$user){
    //         return response() -> json(['check'=> false, 'deadline'=>'']);
    //     }else{

    //         $coupon_code = 'welcomehome';

    //         $coupon = Coupon::where('name', $coupon_code)->first();

    //         // $one_order = Order::where('orders.user_id', '=', $user->id)->count();

    //         $first_order = Order::where('orders.user_id', '=', $user->id)->oldest()->first();

    //         if(!empty($first_order)){

    //             $order_date = new Carbon($first_order->created_at);

    //             if($user->id <= 28){
    //                 $deadline = $order_date->addMonths(5);
    //             }else{
    //                 $deadline = $order_date->addMonths(2);
    //             }

    //             $redeemed = $coupon-> users() -> where('user_id', $user->id) ->first();

    //             if(!$redeemed){
                    
    //                 $now = new Carbon();

    //                 if($now->gt($deadline)){

    //                     return response() -> json(['check'=> false, 'deadline'=>$deadline]);

    //                 }else{

    //                     $carbon_deadline = new Carbon($deadline);
    //                     $ja_deadline = $carbon_deadline->format('Y年n月j日');

    //                     return response() -> json(['check'=> true, 'deadline'=>$ja_deadline]);

    //                 }
    //             }else{

    //                 return response() -> json(['check'=> false, 'deadline'=>$deadline]);
    //             }
    //         }else{
    //             return response() -> json(['check'=> false, 'deadline'=>'']);
    //         }

    //     }
        
    // }

    public function checkIfCoupon()
    {
        $user = Auth::user();

        $user_id = $user->id;
        $subtotal = Order::where('orders.user_id', $user_id)->sum('item_total');
        $discounts = Order::where('orders.user_id', $user_id)->sum('discount');
        $user_total = $subtotal - $discounts;

        // DD($user_total);

        $now = new Carbon();

        if(!$user){
            return response() -> json(['check'=> false, 'deadline'=>'', 'couponName'=>'', 'couponInfo'=>'']);
        }else{

            $coupon_code = 'welcomeback';

            $coupon = Coupon::where('name', $coupon_code)->first();

            // $one_order = Order::where('orders.user_id', '=', $user->id)->count();

            $first_order = Order::where('orders.user_id', '=', $user->id)->oldest()->first();

            //オーダーが過去に一度あったら
            if(!empty($first_order)){

                $order_date = new Carbon($first_order->created_at);

                if($user->id <= 28){
                    $deadline = $order_date->addMonths(5);
                }else{
                    $deadline = $order_date->addMonths(2);
                }

                $redeemed = $coupon-> users() -> where('user_id', $user->id) ->first();

                //まだwelcomebackクーポンを使っていなかったら
                if(!$redeemed){

                    //期限が切れていたら
                    if($now->gt($deadline)){

                        //他のクーポンがないか確認。ongoingで、期限が過ぎておらず、ターゲットが全員で、最低累計金額に達しているか。
                        $otherCoupon = Coupon::where('status_id', 1)
                                            ->whereDate('deadline', '>=', Carbon::now()->toDateString())
                                            ->where('target', 1)
                                            ->where('minimum', '<=', $user_total)
                                            ->first(); 

                        //もし他のクーポンがあったら
                        if(!empty($otherCoupon)){

                            $redeemed_other =$otherCoupon->users()->first();

                            //もし他のクーポンを使っていたら
                            if(!empty($redeemed_other)){
                                return response() -> json(['check'=> false, 'deadline'=>'', 'couponName'=>'', 'couponInfo' => '']);
                            //もし他のクーポンを使っていなかったら
                            }else{
                                $otherDeadline = new Carbon($otherCoupon->deadline);
                                $ja_otherDeadline = $otherDeadline->format('Y年n月j日');

                                return response() -> json(['check'=> true, 'deadline'=>$ja_otherDeadline, 'couponName' => $otherCoupon->name, 'couponInfo' => $otherCoupon->coupon_info]);   
                            }

                        //他のクーポンがなかったら
                        }else{
                            return response() -> json(['check'=> false, 'deadline'=>'', 'couponName'=>'', 'couponInfo' => '']);
                        }
                    
                    //welcomebackクーポンの期限が切れていなかったら
                    }else{

                        $carbon_deadline = new Carbon($deadline);
                        $ja_deadline = $carbon_deadline->format('Y年n月j日');
                        $coupon_info = $coupon->coupon_info;

                        return response() -> json(['check'=> true, 'deadline'=>$ja_deadline, 'couponName' => $coupon_code, 'couponInfo'=>$coupon_info]);

                    }

                //もしwelcomebackクーポンを使っていたら
                }else{

                    $otherCoupon = Coupon::where('status_id', 1)
                                        ->whereDate('deadline', '>=', Carbon::now()->toDateString())
                                        ->where('target', 1)
                                        ->where('minimum', '<=', $user_total)
                                        ->first();    

                    // DD($otherCoupon);

                    //他のクーポンがあったら           
                    if(!empty($otherCoupon)){

                        $redeemed_other =$otherCoupon->users()->first();

                        //もし他のクーポンを使っていたら
                        if(!empty($redeemed_other)){
                            return response() -> json(['check'=> false, 'deadline'=>'', 'couponName'=>'', 'couponInfo'=>'']);
                        //もし他のクーポンを使っていなかったら
                        }else{
                            $otherDeadline = new Carbon($otherCoupon->deadline);
                            $ja_otherDeadline = $otherDeadline->format('Y年n月j日');
                            $otherCoupon_info = $otherCoupon->coupon_info;
                           
                            return response() -> json(['check'=> true, 'deadline'=>$ja_otherDeadline, 'couponName' => $otherCoupon->name, 'couponInfo' => $otherCoupon_info]);
   
                        }
                    //他のクーポンがなかったら
                    }else{
                        return response() -> json(['check'=> false, 'deadline'=>'', 'couponName'=>'', 'couponInfo'=>'']);
                    }
                    
                }

            //オーダーが過去に一度もなかったら
            }else{
                return response() -> json(['check'=> false, 'deadline'=>'', 'couponName' => '', 'couponInfo' => '']);
            }

        }
        
    }

    //Adminのクーポンリスト表示用
    public function fetchCoupons()
    {
       
        $coupons = Coupon::join('statuses', 'statuses.id', '=', 'coupons.status_id')
                    ->select(
                        'coupons.id',
                        'name',
                        'type',
                        'value',
                        'percent_off',
                        'minimum',
                        'deadline',
                        'target',
                        'status'
                    )
                    ->get();

        return response() -> json(['coupons'=>$coupons]);
        
    }

     //Adminの各クーポン詳細
     public function fetchCoupon($id)
     {
         $coupon = Coupon::join('statuses', 'statuses.id', '=', 'coupons.status_id')
                        ->where('coupons.id', $id)
                        ->select(
                            'coupons.id',
                            'name',
                            'type',
                            'value',
                            'percent_off',
                            'minimum',
                            'deadline',
                            'target',
                            'status'
                        )
                        ->first();
    
         return response() -> json(['coupon'=>$coupon]);
         
     }

     public function editName (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $coupon_id = request('id');
        $name = request('name');

        $coupon = Coupon::find($coupon_id);

        $coupon->name = $name;
        $coupon->update();

        $updated_name = $coupon->name;

        return response() -> json(['name'=>$updated_name]);

     }

     public function editType (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'type' => 'required',
        ]);

        $coupon_id = request('id');
        $type = request('type');

        $coupon = Coupon::find($coupon_id);

        $coupon->type = $type;
        $coupon->update();

        $updated_type = $coupon->type;

        return response() -> json(['type'=>$updated_type]);

     }

     public function editValue (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'value' => 'required',
        ]);

        $coupon_id = request('id');
        $value = request('value');

        $coupon = Coupon::find($coupon_id);

        $coupon->value = $value;
        $coupon->update();

        $updated_value = $coupon->value;

        return response() -> json(['value'=>$updated_value]);

     }

     public function editPercentOff (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'percentOff' => 'required',
        ]);

        $coupon_id = request('id');
        $percent_off = request('percentOff');

        $coupon = Coupon::find($coupon_id);

        $coupon->percent_off = $percent_off;
        $coupon->update();

        $updated_percentOff = $coupon->percent_off;

        return response() -> json(['percentOff'=>$updated_percentOff]);

     }

     public function editMinimum (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'minimum' => 'required',
        ]);

        $coupon_id = request('id');
        $minimum = request('minimum');

        $coupon = Coupon::find($coupon_id);

        $coupon->minimum = $minimum;
        $coupon->update();

        $updated_minimum = $coupon->minimum;

        return response() -> json(['minimum'=>$updated_minimum]);

     }

     public function editDeadline (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'deadline' => 'required',
        ]);

        $coupon_id = request('id');
        $deadline = request('deadline');

        $coupon = Coupon::find($coupon_id);

        $coupon->deadline = $deadline;
        $coupon->update();

        $updated_deadline = $coupon->deadline;

        return response() -> json(['deadline'=>$updated_deadline]);

     }

     public function editTarget (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'target' => 'required',
        ]);

        $coupon_id = request('id');
        $target = request('target');

        $coupon = Coupon::find($coupon_id);

        $coupon->target = $target;
        $coupon->update();

        $updated_target = $coupon->target;
        $target_name = $coupon->target_name;

        // DD($target_name);

        return response() -> json(['target'=>$updated_target, 'target_name'=>$target_name]);

     }

     public function editStatus (Request $request)
     {
        $request->validate([
            'id' => 'required',
            'status_id' => 'required',
        ]);

        $coupon_id = request('id');
        $status_id = request('status_id');

        $coupon = Coupon::find($coupon_id);

        $coupon->status_id = $status_id;
        $coupon->update();

        $updated_status = Status::find($status_id)->status;
       
        return response() -> json(['status'=>$updated_status]);

     }

     public function fetchStatuses()
    {
        // $statuses = Status::whereNotNull('status')->get();

        $statuses = Status::whereIn('id', [1, 16, 17])
        ->get();

        // DD($statuses);

        return response() -> json(['statuses' => $statuses]);   

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
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
