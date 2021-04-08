@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('bower_components/datatables-bs/css/datatables.bootstrap.min.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}
<style>
  .single-row{
    cursor: pointer;
  }
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }

  .modal-full{
  width: 100%;
  margin: 0;
}

.modal-full .modal-content {
    min-height: 100vh;
}

</style>
@endsection

@section('content')

<section class="content-header">
      <h1>
        Receipts
        {{-- <small>Homepage of El-Hadi</small> --}}
      </h1>
      {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <section class="content">
        <div class="row">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Payment Receipts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Customer Name</th>
                  <th>Customer Account</th>
                  <th>Invoice No</th>
                  <th>Invoice Date</th>
                  <th>Invoice Amount</th>
                  <th>View Items</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($sales_invoices_receipt as $receipt)
                    <tr class="single-row" data-target="{{$receipt->id}}">
                      <td>{{$loop->iteration}}</td>
                      <td>{{$receipt->customer->customer_name_english}}</td>
                      <td>{{$receipt->invoice->customer_account ?? ''}}</td>
                      <td>{{$receipt->invoice->id}}</td>
                      <td>{{$receipt->invoice->invoice_date? $receipt->invoice->invoice_date->format('d-m-Y') : ''}}</td>
                      <td>{{number_format($receipt->invoice->total,2)}}</td>
                      <td data-target="{{$receipt->id}}"><button data-target="{{$receipt->invoice_id}}" class="view_invoice btn btn-primary" >View</button></td>

                    </tr>
                  @endforeach
                </tbody>
                </table>
                    <tfoot>
                        <div style="margin-top:20px">
                            <div class="pull-right">
                                {{$sales_invoices_receipt->links()}}
                            </div>
                        </div>
                    </tfoot>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.row -->
    </section>
    </section>


    <div class="modal fade" id="purchase-items">
        <div class="modal-dialog modal-full modal-dialog-scrollable">
          <div class="modal-content">
            <form action="{{route('print-receipt')}}" method="POST" >
              @csrf
              <input type="hidden" name="invoice_id" class="invoice_id" value="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Invoice Items</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">

                        <table class="table table-responsive table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>S/N</th>
                              <th>Product</th>
                              <th>Compartments</th>
                              <th>Quantity Observed</th>
                              <th>Co-efficent</th>
                              <th>Quantity at 15deg</th>
                              <th>Price per tin</th>
                              <th>Currency</th>
                              <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody id="invoice-items">
                            </tbody>
                          </table>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                  <button type="submit" name="print" class="btn btn-primary" >Print</button>
                    {{-- <button type="submit" class="btn btn-primary" name="generate_receipt">Generate Receipt</button> --}}
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection


@section('scripts')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{asset('bower_components/datatables/js/jquery.datatables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables-bs/js/datatables.bootstrap.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

<script>
  $(function () {
    let products = [];
       $.ajax({
        url: '/api/fetch-products',
        success: function(data){
            products = JSON.parse(data);
        },
        error: function(err) {
            // console.log('There is an error here');
            console.log(err);
        }
    });


        $('#example1').DataTable({
        'autoWidth': true
        })

        $('#add-invoice-item').on('click', evt => tableRows());

        const computeDependentValues = (evt) =>{
          const id = evt.target.attributes.id.value;
          const asdas = id.split('-');
          const [field, index] = asdas;
          const watcher = ['quantity_observed','coefficient','price']
          if(watcher.indexOf(field) < 0){
            return false;
          }

          switch(field){
            case 'quantity_observed' :

              if(evt.target.value == ""){
                $(`#quantity_15deg-${index}`).val(0);
                $(`#amount-${index}`).val(0);
                return false;
              }
              let coeff = $(`#coefficient-${index}`).val();
              if(!coeff){
                return false;
              }

              coeff = parseFloat(coeff);
              $(`#quantity_15deg-${index}`).val(Math.round(coeff * parseFloat(evt.target.value)));

              let price_p = $(`#price-${index}`).val();
              if(!!price_p){
                $(`#amount-${index}`).val(((parseFloat(evt.target.value) / 20) * parseFloat(price_p)).toFixed(2));
              }

              break;
            case 'coefficient' :
              if(evt.target.value == ""){
                $(`#quantity_15deg-${index}`).val(0);
                return false;
              }
              let quantity = $(`#quantity_observed-${index}`).val();
              if(!quantity){
                return false;
              }
              quantity = parseFloat(quantity);
              $(`#quantity_15deg-${index}`).val(Math.round(quantity * parseFloat(evt.target.value)));
              break;
            case 'price' :
             let quantity_p = $(`#quantity_15deg-${index}`).val();
              if(!quantity_p){
                return false;
              }
              quantity_p = parseFloat(quantity_p);
              $(`#amount-${index}`).val(((parseFloat(quantity_p) / 20) * parseFloat(evt.target.value)).toFixed(2));
              break;
            default :

              break;
          }
        }

        const buildProductDropDown = () =>{
            let select = document.createElement('select');
            $(select).attr({
                'class': 'form-control','name' : 'product_name[]'
            });
            products.forEach( prod => {
                let option = document.createElement('option');
                $(option).val(prod.name);
                option.innerText = prod.name;

                select.appendChild(option);
            });

            return select;
            // td.innerHTML=`<select class="form-control" name="product_name[]">
            //     <option value="">Select Product</option>
            //     <option value="Product One">Product One</option>
            //     <option value="Product Two">Produt Two</option>
            //     <option value="Product Three">Produt Three</option>
            // </select>`;
        }
        const tableRows = () => {
          const fields = ['close','product_name','compartment','quantity_observed','coefficient','quantity_15deg','price','currency','amount'];
            const table = document.getElementById('t-body');
            const numItem = table.childElementCount;
          // get the number of rows already in the table;
            let row = document.createElement('tr');
            $(row).attr('id',`row-${numItem}`);
            $(row).on('click', function(e){
              e.preventDefault();
              if(e.target.nodeName == 'A' || e.target.nodeName == 'I'){
                table.removeChild(e.currentTarget);
              }
              // if(e.target.nodeName='a'){
              // }

            });
            for(let i=0; i< fields.length; i++){
              let td = document.createElement('td');
                if(fields[i] == 'close'){
                  td.innerHTML=`<a href="#" id="close-${numItem}"><i class="fa fa-close"></i></a>`;
                }else if(fields[i] == 'product_name'){
                    const product = buildProductDropDown(td);
                    td.appendChild(product);

                }else if(fields[i] == 'currency'){
                    td.innerHTML=`<select class="form-control" name="currency[]">
                                  <option value="">Currency</option>
                                  <option value="USD">USD</option>
                                  <option value="LBP">LBP</option>
                              </select>`;
                }
                else if(fields[i] == 'quantity_15deg' || fields[i] == 'amount'){
                  td.innerHTML=`<input type="number" value="0" id="${fields[i]}-${numItem}" name="${fields[i]}[]" class="form-control" disabled>`;
                }
                else if(fields[i] == 'compartment'){
                    td.innerHTML=`<input type="text" placeholder="1,2,3,4,5" id="${fields[i]}-${numItem}" name="${fields[i]}[]" class="form-control">`;
                }
                else{

                  td.addEventListener('change',computeDependentValues);
                  td.innerHTML=`<input id="${fields[i]}-${numItem}" type="number" name="${fields[i]}[]" class="form-control">`;
                }
              row.appendChild(td);
            }

            table.appendChild(row);
        }

        // $('#save-invoice-btn').on('click',(e) => {
        //   e.preventDefault();
        //   const form = document.getElementById('invoice-form').elements;
        //   const fields = ['product_name','compartment','quantity_observed','coefficient','quantity_15deg','price','currency','amount'];
        //   let fObj = [];
        //   let hasError = false;
        //   const numItems = document.getElementById('t-body').childElementCount;
        //   if(numItems < 1){
        //     alert ('Add an Invoice Item');
        //     return false;
        //   }

        //   if(numItems == 1){
        //       let obj = {}
        //       fields.forEach( (elem) => {
        //         const value = form[elem+'[]'].value;
        //         obj[elem] = value;
        //       });
        //       const date = new Date();
        //       obj['invoice_date'] = date.toDateString();
        //       fObj.push(obj);
        //   }else{
        //     for(let i = 0; i< numItems; i++){
        //       let obj = {}
        //       fields.forEach( (elem) => {
        //         const value = form[elem+'[]'][i].value;
        //         obj[elem] = value;
        //       });
        //       const date = new Date();
        //       obj['invoice_date'] = date.toDateString();
        //       fObj.push(obj);
        //     }
        //   }

        //   fObj.forEach( (item) => {
        //     for( let value in item){
        //       if(item[value] == ''){
        //         hasError = true;
        //       }
        //     }
        //   });


        //   if(hasError){
        //     alert('Fill in all fields in the grid below');
        //   }else{
        //     const items = JSON.stringify(fObj);
        //     document.getElementById('items').value=items;
        //     $('#invoice-form').submit();
        //   }
        //   // for(let i = 0; i< fields.length; i++){
        //   //   let som = collection.map( elem => elem.value);
        //   //   console.log(som);
        //   // }




        // });


        //fetch the selected invoice item details;

        function  handlePrefillInvoiceItems({status,data}) {
            if(status == 'success'){
                const table = $('#invoice-items');
                $('.invoice_id').val(data.invoice_id);
                const {invoice: { items }} = data;
                items.forEach((item,index) => drawItemTable(item,index,table));
                let modal = $('#purchase-items');
                modal.modal();
            }

        }

        function drawItemTable(item,index,table){
            const {product_name,compartment,quantity_observed,coefficient,quantity_15deg,price,currency,amount} = item;
            //fetch the table handle;
            // create a row and fill in the data;
            // then append the row to the table

            let row = document.createElement('tr');
            row.innerHTML = `<td>${index+1}</td><td>${product_name}</td><td>${compartment}</td><td>${quantity_observed}</td>
            <td>${coefficient}</td><td>${quantity_15deg}</td><td>${price}</td><td>${currency}</td><td>${amount}</td>`;
            $(table).append(row);
        }

        function handleInvoiceFetchError(err){
            console.log('Error');
            console.log(err);
        }

        const fetchInvoiceItems = (evt) => {
            evt.preventDefault();
            const invoice_id = $(evt.target).attr('data-target');
            $.ajax({
                url: '/api/get-receipt-details',
                contentType: 'application/json',
                dataType: 'json',
                method: 'POST',
                success: handlePrefillInvoiceItems,
                failure: handleInvoiceFetchError,
                data: JSON.stringify({invoice_id})
            })
        }

        $('.view_invoice').on('click',fetchInvoiceItems);
    });
</script>


@endsection
