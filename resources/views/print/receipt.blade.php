<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Invoice</title>
    <style>
        @page{
            /* size: 24.2cm 18.5cm; */
            margin: 6.7mm 1.5mm;
        }

        *{
            margin:0;
            padding:0;
        }

        .items-container{
            width: 100%;
            margin-top: 2cm;
            margin-left:2mm;
        }
        .date,.serialNumber,.amount{
            text-align:right;
            margin-right: 4.7cm;
        }
        /* .date{
            padding-top: 1cm;
        }
        */
        .serialNumber,.amount{
            padding-top: 4.2mm;
            /* margin-right: 4.8cm; */
        }

        .amount{
            margin-right:3cm;
        }




        .tt{
            margin-top: 6cm;
            padding-top: 2mm;
            padding-left: 2cm;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .tt .vat{
            margin-right: 2.5cm;
        }

        .three-column{
            width: 100%;
            padding-top: 2mm;
        }

        .single-column-details{
            padding-left: 2cm;
            padding-top: 3mm;
            box-sizing: border-box;
            list-style: none;
        }

        .single-column-details li{
            display: block;
            padding-bottom: 2mm;
        }


        .single-column-details li:last-of-type{
            /* color:red; */
            padding-top: 1mm;
            padding-bottom: 0;
        }

        .three-column li{
            display: inline-block;
            width: 30%;
            margin-right: 2mm;
            padding-left: 2mm;
            box-sizing: border-box;
            text-align: left;
        }

        /* .three-column li:last-of-type{
            padding-top: 3mm;
        } */
        .three-column li:first-of-type{
            margin-left: 1cm;
            /* text-align: left; */
        }

        .total{
            margin-right: 2.5cm;
            padding-top: 2mm;
            padding-left: 3cm;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

    </style>
</head>
<body>
        <p class="date">{{$receipt->created_at->format('d-m-Y')}}</p>
        <p class="serialNumber">{{$receipt->id}}</p>
        <p class="amount">{{number_format($receipt->amount,2).' '.$receipt->invoice->items[0]['currency']}}</p>
     <ul class="single-column-details">
        <li style="padding-left: 5mm">{{$receipt->invoice->customer->customer_name_english}}</li>
         <li>{{$receipt->invoice->customer->address .' / '. $receipt->invoice->customer->contact_number }}</li>
        <li>{{ucwords($formatter->format(floor($receipt->amount))).' '.((float)($receipt->amount - floor($receipt->amount )) > 0 ? ('and '.number_format($receipt->amount  - floor($receipt->amount),2) * 100 . ' cents ') : ' ').' '.$receipt->invoice->items[0]['currency']}}</li>
    </ul>

     <table class="items-container">
        <tbody>
            {{-- @foreach ($receipt->invoice->items as $item) --}}
            <tr>
                <td>
                    Exchange rate is valid once payment available in our banks account
                </td>
                {{-- <td style="width:3.5cm">{{$item['product_name']}}</td>
                <td style="width:3cm">{{$item['compartment']}}</td>
                <td style="width:1.5cm">{{$item['quantity_observed']}}</td>
                <td style="width:1.7cm">{{$item['coefficient']}}</td>
                <td style="width:2.5cm">{{$item['quantity_15deg']}}</td>
                <td style="width:2.5cm">{{$item['price'] ?? 0}}</td>
                <td style="width:4cm; text-align:left;">{{number_format($receipt->amount,2)}}</td> --}}
            </tr>
            {{-- @endforeach --}}
        </tbody>

    </table>
    {{-- <div class="tt">
        <p>11%</p>
        <p class="vat">VAT</p>
    </div>
    <div class="total">
        <p>Amount in Words</p>
        <p>{{number_format($receipt->amount ?? 0,2).' '.$item['currency']}}</p>
    </div> --}}




    <script>
        (function(){
            window.print();
        })();
        window.onafterprint= function(){
            window.history.back();
        }
        window.onabort=function(){
            window.history.back();
        }
    </script>
</body>
</html>