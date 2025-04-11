<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Struk</title>
    <style>
        body {
            widows: 70mm;
            margin: 0 auto;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }

        header h3 {}

        header p {
            margin: 0;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
            padding: 5px 0;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
            padding: 2px 0;
        }

        .item-row .left {
            width: 70%;
            text-align: left;
            flex: 1;
        }

        .item-row .right {
            width: 30%;
            text-align: right;
            flex: 0 0 auto;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #000;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="wrapper">
        <header>
            {{--  <img src="logo.png" alt="Logo GASHOP">  --}}
            <h3>!!! GASHOP !!!</h3>
            <p>Jl. Jalan aja yaa No.69 RT 300 RW 696 London, Sydney</p>
            <p>No Telp. 08180123456</p>
        </header>
        <div class="divider">
            <div>
                <div>Date : {{ date('d/M/Y', strtotime($order->order_date)) }} </div>
                <div>Transaction Number : {{ $order->order_code }}</div>
            </div>
            <div class="divider"></div>
            @foreach ($orderDetails as $orderDetail)
                <div class="item-row">
                    <div class="left">{{ $orderDetail->product->product_name ?? '' }}</div>
                    <div class="right">{{ number_format($orderDetail->order_subtotal) }}</div>
                </div>
                <div class="item-row">
                    <div class="left">{{ $orderDetail->qty }} x {{ number_format($orderDetail->order_price) }}</div>
                </div>
            @endforeach
            <div class="divider"></div>
            <div class="item-row total">
                <div class="left">Total</div>
                <div class="right">Rp.{{ number_format($order->order_amount) }}</div>
            </div>

        </div>
        <div class="footer">
            <p>Terima kasih telah berbelanja!</p>
            <p>BALIK LAGI LAH!</p>
        </div>
    </div>

</body>

</html>
