<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Invoice</title>
    <style>
        /* @page{
            size: 24.2cm 18.5cm;
            margin: 7.5mm 2.5cm;
        } */

        *{
            margin:0;
            padding:0;
        }

        .items-container{
            width: 100%;
            margin-top: 2cm;
        }
        .date,.serialNumber{
            text-align:right;
            margin-right: 2.5cm;
        }
        .vat{
            margin-top: 7cm;
            text-align: right;
            margin-right: 2.5cm;
        }


        }


        .three-column{
            width: 100%;
        }

        .single-column-details{
            padding-left: 3cm;
            box-sizing: border-box;
            list-style: none;
        }

        .three-column li{
            display: inline-block;
            width: 31%;
            margin-right: 2%;
            padding-left: 3cm;
            box-sizing: border-box;
        }
        .three-column li:last-of-type{
            margin-right: 0;
        }

        .total{
            margin-right: 2.5cm;
            padding-left: 3cm;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

    </style>
</head>
<body>
    {{-- {{dd($purchaseInvoice)}} --}}
        <p class="date">{{$purchaseInvoice->invoice_date}}</p>
        <p class="serialNumber">{{$purchaseInvoice->invoice_num}}</p>
    <ul class="single-column-details">
        <li>{{$purchaseInvoice->supplier->customer_name_english}}</li>
        <li>{{$purchaseInvoice->supplier->address .' / '. $purchaseInvoice->supplier->contact_number }}</li>
        <li>{{$purchaseInvoice->supplier->account_number}}</li>
    </ul>
    <ul class="three-column">
        <li>{{$purchaseInvoice->vat_num ?? '--'}}</li>
        <li>{{$purchaseInvoice->warehouse->name?? '--'}}</li>
        <li>{{$purchaseInvoice->truck_num}}</li>
    </ul>
    <table class="items-container">
        <tbody>
            @foreach ($purchaseInvoice->items as $item)
            <tr>
                <td>{{$item['product_name']}}</td>
                <td>{{$item['compartment']}}</td>
                <td>{{$item['quantity_observed']}}</td>
                <td>{{$item['coefficient']}}</td>
                <td>{{$item['quantity_15deg']}}</td>
                <td>{{$item['price'] ?? 0}}</td>
                <td>{{number_format($item['sub_total'],2)}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <p class="vat">VAT</p>
    <div class="total">
        <p>{{ucwords($formatter->format(floor($purchaseInvoice->total ?? 0))).' '.((float)($purchaseInvoice->total - floor($purchaseInvoice->total)) > 0 ? ('and '.number_format($purchaseInvoice->total - floor($purchaseInvoice->total),2) * 100 . ' cents ') : ' '). $item['currency']}}</p>
        <p>{{number_format($purchaseInvoice->total ?? 0,2)}}</p>
    </div>





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