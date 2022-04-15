<!DOCTYPE html>
<html lang="jp">
<head>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/jcr3wqt.css">

<!-- Styles -->

</head>
<style>

body {
    padding: 24px;
    font-family: 'Noto Sans JP', sans-serif!important;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.87)!important;
    background-color: #ffffff!important;
    /* text-size-adjust: 100%; */
}
.header{
    text-align: center;
    margin-bottom: 20px;
}
.logo{
    max-width: 160px;
}
.line {
    max-width: 300px;
    text-align: left;
    margin-left: 0px;
}
.subheading{
    font-weight: 700;

}
.item-table{
    vertical-align: text-top;
}
.section{
    margin-top: 20px;
    margin-bottom: 20px;
}
.pr20{
    padding-right: 20px;
}
.mb10{
    margin-bottom: 10px;
}
.mb20{
    margin-bottom: 20px;
}
td.align-right{
    text-align: right;
}
.mail-link{
    text-decoration: none;
    color: #FE6862;
}

@media screen and (max-width:768px){
    /* body{
        font-size: 32px;
    } */
    .line{
        width: 
    }
   
}

</style>
<body>

    <div class="header">    
        <!-- <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg" alt="logo" class="logo"> -->
        <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.png" alt="logo" class="logo">
    </div>

    <h2 class="mb">Your Order Confirmation</h2>

    <p class="mobild">Thank you so much for shopping with us today. </p>
    <p>Please keep this email as a confirmation of your purchase until your product is delivered.</p>

    <hr class="line">

    <div class="section">
        <p class="subheading">Your Order</p>

        <p>Order ID: {{$order['id']}}</p>

        <table class="mb20 font-32">
            <tr class="item-table">
                <td class="pr20">Products:</td>
                <td>
                    @foreach($order['products'] as $product)
                        @if($product['slug'] === "marmalade-loaf")
                            <div class="font-32">
                                {{ $product['name']}}: {{ $product['pivot']['quantity']}} item(s)
                            </div>
                        @else
                            <div class="font-32">
                                {{ $product['name']}} {{ $product['size']}}: {{ $product['pivot']['quantity']}} item(s)
                            </div>
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
        
        <table class="mb20">
            <tr>
                <td class="pr20">Subtotal:</td>
                <td class="align-right">¥{{$order['item_total']}}</td>
            </tr>
            <tr>
                <td class="pr20">Shipping:</td>
                <td class="align-right">¥{{$order['postage']}}</td>
            </tr>
            @if(isset($order['discount']))
            <tr>
                <td class="pr20">Coupon Discount:</td>
                <td class="align-right">-¥{{$order['discount']}}</td>
            </tr>
            @endif
            <tr>
                <td class="pr20">Total:</td>
                <td class="align-right">¥{{$order['total']}}</td>
            </tr>
        </table>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">Payment Method</p>

        <p>Credit card</p>
    </div>

    <hr class="line">
    
    <div class="section">
        <p class="subheading">Shipping Address</p>

        <p>
            〒{{$order['delivery_zipcode']}}<br>
            {{$order["delivery_prefecture"]}}{{$order["delivery_city"]}}{{$order["delivery_address_1"]}}<br>
            @if(isset($order["delivery_building"]))
                {{$order["delivery_building"]}} <br>
            @endif
            {{$order["delivery_name"]}}
        </p>
        <p>
            Phone: {{$order["delivery_phone"]}}
        </p>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">Billing Address</p>

        <p>
            〒{{$user -> zipcode}}<br>
            {{$user -> prefecture}}{{$user -> city}}{{$user -> address_1}}<br>
            @if(isset($user -> building))
                {{$user -> building}}<br>
            @endif
            {{$user -> name}}
        </p>
        <p>Phone: {{$user -> phone}}</p>
        <p>Email: {{$user -> email}}</p>
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">Notes<p>

        @if(isset($order["message"]))
            <p>{{$order["message"]}}</p>
        @endif
    </div>

    <hr class="line">

    <div class="section">
        <p class="subheading">Contact</p>

        <div class="mb20">
            <p>
                Email:<br>
                <a href="mailto:ayaandco.info@gmail.com" class="mail-link">ayaandco.info@gmail.com</a> 
            </p>
        </div>
        <div class="mb20">
            <p>
                Website:<br>
                <a href="https://www.ayaandco.com" class="mail-link" target="_blank">https://www.ayaandco.com</a> 
            </p>
        </div>
        <div class="mb20">
            <p>Address:<br>
                Ayako Ueda<br>
                aya & co. 1-6-1-505, Arima<br> 
                Miyamae, Kawasaki, Kanagawa, 216-0003
            </p>
        </div>
        <div class="mb20">
            <p> 
                <a href="https://lin.ee/4xyKS07" class="mail-link" target="_blank">LINE official account</a>
            </p>
        </div>
    </div>
    
</body>
</html>