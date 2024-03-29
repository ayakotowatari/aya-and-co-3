<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\Status;
use App\Models\Postage;
use App\Models\State;
use App\Models\Courier;
use App\Models\Giftcard;
use Illuminate\Http\Request;
use Auth;
use PDF;
use DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
                    // ->join('guests', 'guests.id', '=', 'orders.guest_id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    ->select(
                        'orders.id',
                        'orders.created_at',
                        'users.id as user_id',
                        'users.name as user_name',
                        'users.email as user_email',
                        'users.phone as user_phone',
                        'users.zipcode as zipcode',
                        'users.prefecture as prefecture',
                        'users.city as city',
                        'users.address_1 as address_1',
                        'users.building as building',
                        // 'guests.id as guest_id',
                        // 'guests.name as guest_name',
                        // 'guests.email as guest_email',
                        // 'guests.phone as guest_phone',
                        'statuses.status',
                    )
                    ->orderBy('id', 'desc')
                    ->get();
        // DD($orders);
        return response() -> json(['orders' => $orders]);  

    }

    public function sales()
    {
        
        $total = DB::table('order_product')->sum('quantity');
        return response() -> json(['total' => $total]);  

    }

    public function guestOrders()
    {
        $orders = Order::join('guests', 'guests.id', '=', 'orders.guest_id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    ->select(
                        'orders.id',
                        'orders.created_at',
                        'guests.id as guest_id',
                        'guests.name as guest_name',
                        'guests.email as guest_email',
                        'guests.phone as guest_phone',
                        'statuses.status',
                    )
                    ->orderBy('id', 'desc')
                    ->get();
        // DD($orders);
        return response() -> json(['orders' => $orders]);  

    }

    public function updateUserId(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'guest_id' => 'required',
        ]);

        $guest_id = request('guest_id');

        $order = Order::where('guest_id', $guest_id)->first();

        $order->user_id = $user->id;
        $order->guest_id = null;

        $order->update();
        
    }

    //adminのために各注文詳細を取得
    public function eachOrder(Request $request, $id)
    {
        $order_id = $id;
        
        // DD($order_id);
        
        $order = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    // ->join('shipments', 'shipments.order_id', '=', 'orders.id')
                    ->where('orders.id', $order_id)
                    ->select(
                        'orders.id',
                        'orders.created_at',
                        'users.id as user_id',
                        'users.name as user_name',
                        'users.email as user_email',
                        'users.phone as user_phone',
                        'users.zipcode as user_zipcode',
                        'users.prefecture as user_prefecture',
                        'users.city as user_city',
                        'users.address_1 as user_address_1',
                        'users.building as user_building',
                        'users.life as user_life',
                        'orders.delivery_name',
                        'orders.delivery_zipcode',
                        'orders.delivery_prefecture',
                        'orders.delivery_city',
                        'orders.delivery_address_1',
                        'orders.delivery_building',
                        'orders.delivery_phone',
                        'orders.delivery_courier',
                        'orders.delivery_time',
                        'orders.delivery_carduse',
                        'orders.delivery_cardmessage',
                        'orders.delivery_cardname',
                        'orders.postage',
                        'orders.box_quantity',
                        'orders.discount',
                        'orders.total',
                        'orders.message',
                        'statuses.status',
                        'orders.note'
                        // 'shipments.scheduled_date',
                        // 'shipments.actual_date'
                    )
                    ->first();

        // DD($order);

        $products = Product::join('order_product', 'order_product.product_id', '=', 'products.id')
                        ->join('orders', 'orders.id', '=', 'order_product.order_id')
                        ->where('orders.id', $order_id)
                        ->select(
                            'products.name', 
                            'products.size', 
                            'products.price',
                            'products.image',
                            'order_product.quantity',
                            'orders.postage',
                            'orders.total'
                        )
                        ->get();
       
        // DD($orders);

        $giftcards = Giftcard::where('order_id', $order_id)->get();

        if(!empty($giftcards)){
            return response() -> json(['order' => $order, 'products' => $products, 'giftcards' =>$giftcards]);  
        }else{
            return response() -> json(['order' => $order, 'products' => $products, 'giftcards' => '']);  
        }

    }

    public function eachGuestOrder(Request $request, $id)
    {
        $order_id = $id;
        
        // DD($order_id);
        
        $order = Order::join('guests', 'guests.id', '=', 'orders.guest_id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    // ->join('shipments', 'shipments.order_id', '=', 'orders.id')
                    ->where('orders.id', $order_id)
                    ->select(
                        'orders.id',
                        'orders.created_at',
                        'guests.id as guest_id',
                        'guests.name as guest_name',
                        'guests.email as guest_email',
                        'guests.phone as guest_phone',
                        'guests.zipcode as guest_zipcode',
                        'guests.prefecture as guest_prefecture',
                        'guests.city as guest_city',
                        'guests.address_1 as guest_address_1',
                        'guests.building as guest_building',
                        'orders.delivery_name',
                        'orders.delivery_zipcode',
                        'orders.delivery_prefecture',
                        'orders.delivery_city',
                        'orders.delivery_address_1',
                        'orders.delivery_building',
                        'orders.delivery_phone',
                        'orders.delivery_courier',
                        'orders.delivery_time',
                        'orders.postage',
                        'orders.box_quantity',
                        'orders.total',
                        'orders.note',
                        'statuses.status',
                        // 'shipments.scheduled_date',
                        // 'shipments.actual_date'
                    )
                    ->first();

        // DD($order);

        $products = Product::join('order_product', 'order_product.product_id', '=', 'products.id')
                        ->join('orders', 'orders.id', '=', 'order_product.order_id')
                        ->where('orders.id', $order_id)
                        ->select(
                            'products.name', 
                            'products.size', 
                            'products.price',
                            'products.image',
                            'order_product.quantity',
                            'orders.postage',
                            'orders.total'
                        )
                        ->get();
       
        // DD($orders);
        return response() -> json(['order' => $order, 'products' => $products]);  

    }

     //adminのために各注文の発送情報を取得
    public function shipmentDetails(Request $request, $id)
    {
        $order = Order::find($id);

        $shipment = $order->shipment()->first();

        if(!$shipment){
            return response() -> json(['scheduled_date' => null, 'actual_date' => null, 'delivered_date' => null]); 
        }else{
            return response() -> json(['scheduled_date' => $shipment->scheduled_date, 'actual_date' => $shipment->actual_date, 'delivered_date' => $shipment->delivered_date]);  
        }
    }


    public function shipmentList()
    {
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->join('shipments', 'shipments.order_id', '=', 'orders.id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    ->where('orders.status_id', '=', 3)
                    ->orWhere('orders.status_id', '=', 5)
                    ->select(
                        'orders.id',
                        'orders.delivery_name', 
                        'orders.delivery_zipcode', 
                        'orders.delivery_prefecture',
                        'orders.delivery_city',
                        'orders.delivery_address_1',
                        'orders.delivery_building',
                        'orders.delivery_phone',
                        'orders.delivery_courier',
                        'orders.delivery_time',
                        'statuses.status',
                        'shipments.scheduled_date',
                        'users.id as user_id',
                        'users.name as user_name',
                        'users.zipcode',
                        'users.prefecture',
                        'users.city',
                        'users.address_1',
                        'users.building',
                        'users.phone',
                    )
                    ->get();
        // DD($orders);
        return response() -> json(['orders' => $orders]);  

    }

    public function guestShipmentList()
    {
        $orders = Order::join('guests', 'guests.id', '=', 'orders.guest_id')
                    ->join('shipments', 'shipments.order_id', '=', 'orders.id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    ->where('orders.status_id', '=', 3)
                    ->orWhere('orders.status_id', '=', 5)
                    ->select(
                        'orders.id',
                        'orders.delivery_name', 
                        'orders.delivery_zipcode', 
                        'orders.delivery_prefecture',
                        'orders.delivery_city',
                        'orders.delivery_address_1',
                        'orders.delivery_building',
                        'orders.delivery_phone',
                        'orders.delivery_courier',
                        'orders.delivery_time',
                        'statuses.status',
                        'shipments.scheduled_date',
                        'guests.id as guest_id',
                        'guests.name as guest_name',
                        'guests.zipcode',
                        'guests.prefecture',
                        'guests.city',
                        'guests.address_1',
                        'guests.building',
                        'guests.phone',
                    )
                    ->get();
        // DD($orders);
        return response() -> json(['orders' => $orders]);  

    }

    public function scheduleShipment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        $shipment = new Shipment();
        $shipment->order_id = request('id');
        $shipment->scheduled_date = request('date');
        $shipment->delivery_time = request('delivery_time');
        $shipment->postage = request('postage');
        $shipment->status_id = 3;

        $shipment->save();

        $date = $shipment->scheduled_date;

        return response() -> json(['date' => $date]); 
    }


    public function updateShipment(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        $id = request('id');

        $shipment = Shipment::where('order_id', $id)->first();
        $shipment->scheduled_date = request('date');
        $shipment->update();

        $date = $shipment->scheduled_date;

        return response() -> json(['date' => $date]); 
    }

    public function actualDate (Request $request)
    {

        $request->validate([
            'id' => 'required',
            'actual_date' => 'required',
        ]);

        $id = request('id');

        $shipment = Shipment::where('order_id', $id)->first();
        $shipment->actual_date = request('actual_date');
        $shipment->update();

        $date = $shipment->actual_date;

        return response() -> json(['actualDate' => $date]); 
        
    }

    public function updateActualDate (Request $request)
    {

        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        $id = request('id');

        $shipment = Shipment::where('order_id', $id)->first();
        $shipment->actual_date = request('date');
        $shipment->update();

        $date = $shipment->actual_date;

        return response() -> json(['actualDate' => $date]); 
        
    }

    public function updateDeliveredDate (Request $request)
    {

        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        $id = request('id');

        $shipment = Shipment::where('order_id', $id)->first();
        $shipment->delivered_date = request('date');
        $shipment->update();

        $date = $shipment->delivered_date;

        return response() -> json(['deliveredDate' => $date]); 
        
    }

    public function deliveredDate (Request $request)
    {

        $request->validate([
            'id' => 'required',
            'delivered_date' => 'required',
        ]);

        $id = request('id');

        $shipment = Shipment::where('order_id', $id)->first();
        $shipment->delivered_date = request('delivered_date');
        $shipment->update();

        $date = $shipment->delivered_date;

        return response() -> json(['deliveredDate' => $date]); 
        
    }

    public function inputUserOrderNote(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'note' => 'required',
        ]);

        $id = request('id');

        $order = Order::find($id);
        $order->note = request('note');
        $order->save();

        $note = $order->note;

        return response() -> json(['note' => $note]);
    }

    public function updateUserOrderNote(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'note' => 'required',
        ]);

        $id = request('id');

        $order = Order::find($id);
        $order->note = request('note');
        $order->update();

        $note = $order->note;

        return response() -> json(['note' => $note]);
    }

    public function inputGuestOrderNote(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'note' => 'required',
        ]);

        $id = request('id');

        $order = Order::find($id);
        $order->note = request('note');
        $order->save();

        $note = $order->note;

        return response() -> json(['note' => $note]);
    }

    public function updateGuestOrderNote(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'note' => 'required',
        ]);

        $id = request('id');

        $order = Order::find($id);
        $order->note = request('note');
        $order->update();

        $note = $order->note;

        return response() -> json(['note' => $note]);
    }

    public function checkOrder(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'id' => 'required',
        ]);

        $order_id = request('id');

        $order = Order::where('id', $order_id)
                    ->where('user_id', $user_id)
                    ->first();

        return $order;

    }

    //会員のために各注文詳細を取得
    public function fetchOrder($id)
    {
        $user_id = Auth::user()->id;

        $order_id = $id;
        
        // DD($order_id);
        
        $order = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    // ->join('statuses', 'statuses.id', '=', 'orders.status_id')
                    // ->join('shipments', 'shipments.order_id', '=', 'orders.id')
                    ->where('orders.id', $order_id)
                    ->where('orders.user_id', $user_id)
                    ->select(
                        'orders.id',
                        'orders.created_at',
                        'users.id as user_id',
                        'users.name as user_name',
                        'users.email as user_email',
                        'users.phone as user_phone',
                        'users.zipcode as user_zipcode',
                        'users.prefecture as user_prefecture',
                        'users.city as user_city',
                        'users.address_1 as user_address_1',
                        'users.building as user_building',
                        'orders.delivery_name',
                        'orders.delivery_zipcode',
                        'orders.delivery_prefecture',
                        'orders.delivery_city',
                        'orders.delivery_address_1',
                        'orders.delivery_building',
                        'orders.delivery_phone',
                        'orders.delivery_courier',
                        'orders.delivery_time',
                        'orders.delivery_carduse',
                        'orders.delivery_cardmessage',
                        'orders.delivery_cardname',
                        'orders.message',
                        'orders.postage',
                        'orders.box_quantity',
                        'orders.item_total',
                        'orders.discount',
                        'orders.total',
                        'statuses.status',
                        // 'statuses.status',
                        // 'shipments.scheduled_date',
                        // 'shipments.actual_date'
                    )
                    ->first();

        // DD($order);

        $products = Product::join('order_product', 'order_product.product_id', '=', 'products.id')
                        ->join('orders', 'orders.id', '=', 'order_product.order_id')
                        ->where('orders.id', $order_id)
                        ->select(
                            'products.name', 
                            'products.size',
                            'products.slug', 
                            'products.price',
                            'products.image',
                            'order_product.quantity',
                            // 'orders.postage',
                            // 'orders.total'
                        )
                        ->get();
       
        // DD($orders);

        $giftcards = Giftcard::where('order_id', $order_id)->get();

        if(!empty($giftcards)){
            return response() -> json(['order' => $order, 'products' => $products, 'giftcards' =>$giftcards]);  
        }else{
            return response() -> json(['order' => $order, 'products' => $products, 'giftcards' => '']);  
        }

    }

      //会員のために各注文の発送情報を取得
    public function fetchShipment(Request $request, $id)
    {
        $order = Order::find($id);

        // DD($order);

        $shipment = $order->shipment()->first();

        if(!$shipment){
            return response() -> json(['scheduled_date' => null, 'actual_date' => null, 'delivered_date' => null]); 
        }else{
            return response() -> json(['scheduled_date' => $shipment->scheduled_date, 'actual_date' => $shipment->actual_date, 'delivered_date' => $shipment->delivered_date]);  
        }
    }

   
     public function zipcode(Request $request, $val, $lang)
    {   
    
        //外部API呼び出し
            $handle = curl_init("https://api.zipaddress.net/?zipcode=" . $val . "&lang=" . $lang);
            curl_setopt($handle, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($handle);
            curl_close($handle);

            $contents = (array)json_decode($result, false);
            if(!$contents){
                return response()->error('取得失敗');
            }elseif ($contents['code'] != 200){
                return response()->error($contents["message"]);
            }

            $res = [];
            $res = $contents['data'];

            // return response()->success($res);
            return response() -> json($res);

    }

    public function summary()
    {
        $user = Auth::user();
        $user_id = $user->id;

        $orders = Order::join('order_product', 'orders.id', '=', 'order_product.order_id')
                    ->join('products', 'order_product.product_id', '=', 'products.id')
                    // ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('orders.user_id', $user_id)
                    ->select(
                        'orders.id as order_id', 
                        'order_product.id', 
                        'products.name', 
                        'products.slug', 
                        'products.size', 
                        'products.image',
                        'order_product.quantity', 
                        'orders.updated_at',
                        // 'categories.image'
                    )
                    ->orderBy('updated_at', 'desc')
                    ->paginate(3);
                    // ->get();

        // DD($orders);
        // DD($orders);

        return response() -> json(['orders' => $orders]);            
    }

    public function statuses()
    {
        // $statuses = Status::whereNotNull('status')->get();

        $statuses = Status::whereIn('id', [1, 3, 5, 7, 9, 11, 13, 15])
        ->get();

        // DD($statuses);

        return response() -> json(['statuses' => $statuses]);   

    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status_id' => 'required',
        ]);

        $order = Order::find(request('id'));
        $order->status_id = request('status_id');
        $order->update();

        // $status = $order->status()->first();

        $status = Status::find($order->status_id);

        // DD($order);

        return response() -> json(['status' => $status->status]);   

    }

    public function postage()
    {
        $couriers = Courier::get();

        // foreach ($couriers as $courier){
        //     // $courierType[] = $courier->name.' '.$courier->type;
        //     $courierType[] = $courier->type.'（'.$courier->name.'）';
        // }
        
        $postages = Postage::get();

        $postageYamatoTakkyubin = Postage::join('states', 'states.id', '=', 'postages.state_id')
                                    ->where('courier_id', 1)
                                    ->get();

        $postageYamatoBig = Postage::join('states', 'states.id', '=', 'postages.state_id')
                            ->where('courier_id', 2)
                            ->get();

        $postageCompact = Postage::join('states', 'states.id', '=', 'postages.state_id')
                            ->where('courier_id', 3)
                            ->get();

        return response() -> json(['postages' => $postages, 'yamatotakkyubin' => $postageYamatoTakkyubin, 'yamatobig' => $postageYamatoBig, 'compact' => $postageCompact, 'courier' => $couriers]);   
    }

    public function states()
    {
        $states = State::get();

        return response() -> json(['states' => $states]); 

    }

    public function createUserReceipt($id)
    {
        // $pdf = PDF::loadHTML('<h1>こんにちは</h1>');

        $order = Order::find($id);

        $lang = $order->user->lang;

        // return $pdf->download('領収書.pdf');
        $user = Order::join('users', 'users.id', '=', 'orders.user_id')
                    ->where('orders.id', $id)
                    ->select(
                        'users.name',
                        'users.zipcode', 
                        'users.prefecture',
                        'users.city',
                        'users.address_1',
                        'users.building',
                        'orders.id as order_id',
                        'orders.postage',
                        'orders.item_total',
                        'orders.discount',
                        'orders.total',
                        'orders.created_at'
                    )
                    ->first();

        $orders = Order::join('order_product', 'order_product.order_id', '=', 'orders.id')
                    ->join('products', 'products.id', '=', 'order_product.product_id')
                    ->where('orders.id', $id)
                    ->select(
                        'products.name',
                        'products.size',
                        'products.price as unit_price',
                        'order_product.quantity',
                        'order_product.price as item_price'
                    )
                    ->get();

        if($lang == 'ja'){
            $pdf = PDF::loadView('pdf/receipt', [

                'user' => $user,
                'orders' => $orders,
    
            ]);
    
            $date = \Carbon\Carbon::now()->format("Ymj");
    
            //DD($pdf);
    
            //return $pdf->stream();
    
            /*   ダウンロードさせる場合はこっちを記載する。
            *    画面遷移は起こらずダウンロードが開始する
            // */      
            
            return $pdf->download('納品書兼領収書_'.$user->name.'様_'.$date.'.pdf');

        }else{
            $pdf = PDF::loadView('pdf/receipt_en', [

                'user' => $user,
                'orders' => $orders,
    
            ]);
    
            $date = \Carbon\Carbon::now()->format("d/m/Y");
    
            //DD($pdf);
    
            //return $pdf->stream();
    
            /*   ダウンロードさせる場合はこっちを記載する。
            *    画面遷移は起こらずダウンロードが開始する
            // */      
            
            return $pdf->download('YourReceipt_'.$user->name.'_'.$date.'.pdf');
        }
       
       

    }

    public function createGuestReceipt($id)
    {
        // $pdf = PDF::loadHTML('<h1>こんにちは</h1>');

        // return $pdf->download('領収書.pdf');


        $user = Order::join('guests', 'guests.id', '=', 'orders.guest_id')
                    ->where('orders.id', $id)
                    ->select(
                        'guests.name',
                        'guests.zipcode', 
                        'guests.prefecture',
                        'guests.city',
                        'guests.address_1',
                        'guests.building',
                        'orders.id as order_id',
                        'orders.postage',
                        'orders.item_total',
                        'orders.total',
                        'orders.created_at'
                    )
                    ->first();

        $orders = Order::join('order_product', 'order_product.order_id', '=', 'orders.id')
                    ->join('products', 'products.id', '=', 'order_product.product_id')
                    ->where('orders.id', $id)
                    ->select(
                        'products.name',
                        'products.size',
                        'products.price as unit_price',
                        'order_product.quantity',
                        'order_product.price as item_price'
                    )
                    ->get();

        $pdf = PDF::loadView('pdf/receipt', [

            'user' => $user,
            'orders' => $orders,

        ]);

        $date = \Carbon\Carbon::now()->format("Ymj");

        //DD($pdf);

        //return $pdf->stream();

        /*   ダウンロードさせる場合はこっちを記載する。
*    画面遷移は起こらずダウンロードが開始する
// */      return $pdf->download('納品書兼領収書_'.$user->name.'様_'.$date.'.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
