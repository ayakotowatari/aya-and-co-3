<!DOCTYPE html>
<html lang="jp">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/jcr3wqt.css"> -->

<!-- Styles -->

</head>
<style type="text/css">
/* @font-face {
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src: url('{{ storage_path('fonts/ipag.ttf') }}') format('truetype');
}
@font-face {
    font-family: ipag;
    font-style: bold;
    font-weight: bold;
    src: url('{{ storage_path('fonts/ipag.ttf') }}') format('truetype');
} */

body {
    padding: 24px;
    font-family: 'Noto Sans JP', sans-serif!important;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    color: rgba(0, 0, 0, 0.87)!important;
    /* text-size-adjust: 100%; */
}
.text-center{
    text-align: center
}
.header{
    text-align: center;
    margin-bottom: 20px;
}
.logo{
    max-width: 120px;
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
.mb30{
    margin-bottom: 30px;
}

.underline{
    text-decoration: underline;
    padding: 6px;
}

/* table, th, td{
    border: 1px solid black;
    width: 100%;
    border-collapse: collapse;
} */

table.main-table{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
}

.main-table th{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
}
.main-table td{
    border: 1px solid black;
    border-collapse: collapse;
    padding: 6px;
}

td.align-right{
    text-align: right;
}

@media screen and (max-width:768px){
    /* body{
        font-size: 32px;
    } */
   
}

</style>
<body>

    <div class="header">    
        <!-- <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.svg" alt="logo" class="logo"> -->
        <img src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.png" alt="logo" class="logo">
    </div>
    
    <h2>Your aya & co. purchase receipt</h2>

    
    <p class="mb30">{{ $user->created_at->format("d/m/Y") }} </p>

    <p class="mb20">Dear {{ $user->name}}</p>

    <p class="underline">Total: ¥{{ $user->total}}</p>

    <!-- <hr class="line"> -->

    <div class="section">
        <table class="main-table">
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>No.</th>
                <th>Unit</th>
                <th>Unit price(¥)</th>
                <th>Line total(¥)</th>
            </tr>

            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->size }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>item(s)</td>
                    <td>{{ $order->unit_price }}</td>
                    <td>{{ $order->item_price }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="sub-table">
            <tr>
                <td>Subtotal</td>
                <td>¥{{ $user -> item_total }}</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>¥{{ $user -> postage }}</td>
            </tr>
            @if(isset($user -> discount))
            <tr>
                <td>Coupon discount</td>
                <td>-¥{{ $user -> discount }}</td>
            </tr>
            @endif
            <tr>
                <td>Total</td>
                <td>¥{{ $user -> total}}</td>
            </tr>
        </table>
    </div>

    <hr>

    <div class="mb20">
        <p>
            Thank you so much for shopping with us. We hope you enjoyed the products you purchased.<br>
            We look forward to welcoming you to our store again soon!
        </p>
    </div>

    <hr>
    
    <div class="section">
        <p>We have received the above payment.</p>

        <p>{{ $user->created_at->format("d/m/Y") }} </p>

        <p>
            Ayako Ueda<br>
            aya & co.<br>
            1-6-1-505 Arima, Miyamae-ku, Kawasaki, Kanagawa, 216-0003, Japan
        </p>
    </div>

    <hr>

    <div class="mb20">
        <p class="subheading">Contact</p>
            <p>
                Email: ayaandco.info@gmail.com<br>
                Official LINE account in English: https://lin.ee/4xyKS07
            </p>
    </div>

    <div>
        <p class="mb20">
            Order ID: {{ $user -> order_id}}
        </p>
    </div>
    
</body>
</html>