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
        .date,.serialNumber{
            text-align:right;
            margin-right: 2.7cm;
        }
        .date{
            margin-right: 4cm;
        }

        .serialNumber{
            padding-top: 4.2mm;
            margin-right: 4.8cm;
        }




        .tt{
            margin-top: 5.7cm;
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
            min-height: 2.3cm;
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
    {{-- {{dd($salesInvoice->id)}} --}}
        <p class="date">{{$salesInvoice->invoice_date->format('d-m-Y')}}</p>
        <p class="serialNumber">{{$salesInvoice->id}}</p>
     <ul class="single-column-details">
        <li>{{$salesInvoice->customer->customer_name_english}}</li>
         <li>{{$salesInvoice->customer->address .' / '. $salesInvoice->customer->contact_number }}</li>
        <li>{{$salesInvoice->customer->account_number}}</li>
    </ul>
   <ul class="three-column">
        <li>{{$salesInvoice->vat_num ?? '--'}}</li>
        <li>{{$salesInvoice->warehouse->name ?? '--'}}</li>
        <li>{{$salesInvoice->truck_num}}</li>
    </ul>
     <table class="items-container">
        <tbody>
            @foreach ($salesInvoice->items as $item)
            <tr>
                <td style="width:3.5cm">{{$item['product_name']}}</td>
                <td style="width:3cm">{{$item['compartment']}}</td>
                <td style="width:1.5cm">{{$item['quantity_observed']}}</td>
                <td style="width:1.7cm">{{$item['coefficient']}}</td>
                <td style="width:2.5cm">{{$item['quantity_15deg']}}</td>
                <td style="width:2.5cm">{{$item['price'] ?? 0}}</td>
                <td style="width:4cm; text-align:left;">{{number_format($item['sub_total'],2)}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="tt">
        <p>11%</p>
        <p class="vat">{{number_format($salesInvoice->vat(),2).' '.$item['currency']}}</p>
    </div>
    <div class="total">
        <p>{{ucwords($formatter->format(floor($salesInvoice->total ?? 0))).' '.((float)($salesInvoice->total - floor($salesInvoice->total)) > 0  ? ('and '.(number_format(($salesInvoice->total - floor($salesInvoice->total)) * 100,2)) . ' cents ') : ' '). $item['currency']}}</p>
        <p>{{number_format(( ($salesInvoice->total) ?? 0),2).' '.$item['currency']}}</p>
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