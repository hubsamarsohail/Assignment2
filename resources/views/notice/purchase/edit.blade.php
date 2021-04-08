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
  /* display: flex;
  align-content: center;
  justify-content: center;
  justify-content: center;
  align-items: center; */

}

.modal-full .modal-content {
    min-height: 100vh;
}

</style>
@endsection

@section('content')

<section class="content-header">
      <h1>
        Purchase Delivery Notice
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
                     <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Delivery Notice</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('purchase-notice-edit', ['notice_id' => $notice->invoice_id])}}" id="invoice-form" >
                @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_id" class="col-sm-3 control-label">Customer *</label>
                      <div class="col-sm-9">
                          <select class="form-control" name="customer_id" id="customer_id">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{$customer->id}}" {{$notice->customer_id == $customer->id ? 'selected' : ''}} data-sup-data="{{json_encode($customer->account_number)}}">{{$customer->customer_name_english}}</option>
                            @endforeach
                          </select>
                        {{-- <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Customer Name English" value="{{old('customer_id') ? old('customer_id') : ''}}"> --}}
                        @error('customer_id')
                          <div class="text-danger">
                            Select Customer
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_account" class="col-sm-3 control-label">Customer Account</label>
                      <div class="col-sm-9">
                        <input type="text" name="customer_account" class="form-control" id="customer_account" placeholder="Customer Account Details" value="{{$notice->customer_account ? $notice->customer_account : ''}}" disabled>
                        @error('customer_account')
                        <div class="text-danger">
                          {{$message}}
                        </div>
                      @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="invoice_num" class="col-sm-3 control-label">Invoice No:</label>
                            <div class="col-sm-9">
                             <input type="text" name="invoice_num" class="form-control" id="invoice_num" placeholder="Invoice Number" value="{{$notice->invoice_num ? $notice->invoice_num : old('invoice_num')}}">
                              @error('invoice_num')
                                <div class="text-danger">
                                  Enter Invoice Number
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="invoice_date" class="col-sm-3 control-label">Invoice Date</label>
                            <div class="col-sm-9">
                              <input type="date" name="invoice_date" class="form-control" id="invoice_date" placeholder="dd/mm/yyyy" value="{{old('invoice_date') ? old('invoice_date') : ''}}">
                              @error('invoice_date')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="currency" class="col-sm-3 control-label">Truck Num</label>
                            <div class="col-sm-9">
                              <input type="text" name="truck_num" class="form-control" id="truck_num" placeholder="7765XY" value="{{$notice->truck_num ? $notice->truck_num : old('truck_num')}}">

                              @error('currency')
                                <div class="text-danger">
                                  Enter Truck Number
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                          <div class="form-group">
                            <label for="warehouse_id" class="col-sm-3 control-label">Warehouse</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="warehouse_id" id="warehouse_id">
                                    <option value="">Select Stock</option>
                                    @foreach ($stocks as $stock)
                                        <option value="{{$stock->id}}" {{$notice->warehouse_id == $stock->id ? 'selected' : ''}}>{{$stock->name}}</option>
                                    @endforeach
                                </select>
                              {{-- <input type="currency" name="currency" class="form-control" id="currency" placeholder="Currency Address" value="{{old('currency') ? old('currency') : ''}}"> --}}

                              @error('currency')
                                <div class="text-danger">
                                  Select Warehouse
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vat_num" class="col-sm-3 control-label">VAT No</label>
                            <div class="col-sm-9">
                              <input type="number" name="vat_num" class="form-control" id="vat_num" placeholder="VAT NUMBER" value="{{$notice->vat_num ? $notice->vat_num : old('vat_num')}}" disabled>

                              @error('vat_num')
                                <div class="text-danger">
                                  Enter VAT Number
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>

                    <div class="col-md-6">

                         <div class="form-group">
                            <label for="notes" class="col-sm-3 control-label">Notes</label>
                            <div class="col-sm-9">
                              <textarea name="notes" id="" cols="30" rows="2" class="form-control" placeholder="Notes">{{$notice->notes ? $notice->notes: old('notes')}}</textarea>
                              @error('notes')
                                <div class="text-danger">
                                  {{$message}}
                                </div>
                              @enderror
                            </div>
                          </div>
                    </div>
                </div>


                <div id="additional_information">


                    <table class="table table-bordered table-striped" id="table">
                        <thead>
                        <tr>
                        <th>
                            S/N
                        </th>
                        <th>Product</th>
                        <th>Compartments</th>
                        <th>Quantity Observed</th>
                        <th>Co-efficent</th>
                        <th>Quantity at 15deg</th>
                        <th>Currency</th>
                        </tr>
                        </thead>
                        <tbody id="t-body">
                          @foreach($notice->items as $item)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                              <select name="product_name[]" class="form-control">
                                @foreach ($products as $product)
                                <option value="{{$product->name}}" {{$item['product_name'] === $product->name ? 'selected' : ''}}>
                                  {{$product->name}}
                                </option>
                                @endforeach
                              </select>
                            </td>
                            <td><input class="form-control" type="text" name="compartment[]" value="{{$item['compartment']}}" /></td>
                            <td><input class="form-control" type="number" name="quantity_observed[]" value="{{$item['quantity_observed']}}" /></td>
                            <td><input class="form-control" type="number" name="coefficient[]" value="{{$item['coefficient']}}" /></td>
                            <td><input class="form-control" name="quantity_15deg[]" value="{{$item['quantity_15deg']}}" type="number" disabled/></td>
                            {{-- <td><input name="price-{{$loop->index}}" class="price" value="0"/></td> --}}
                            <td>{{$item['currency']}}</td>
                            {{-- <input type="hidden" name="item-${index}" value="true" /> --}}
                          </tr>
                          @endforeach
                        </tbody>
                    </table>

                </div>

                    </div>


                    {{-- <div class="form-group">
                        <label for="auto_generate" class="control-label col-xs-4 col-md-2">Auto Generate</label>
                        <div class="col-xs-10">
                          <input id="auto_generate" class="form-check-input" type="checkbox" name="auto_generate" data-toggle="toggle" data-style="ios">
                        </div>
                      </div> --}}

              <!-- /.box-body -->
              <div class="box-footer">
                {{-- <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-default">Cancel</button> --}}
                <button type="submit" class="btn btn-info pull-right">Save Delivery Notice</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>
    </section>
    </section>


    <div class="modal fade" id="purchase-items">
        <div class="modal-dialog modal-full modal-dialog-scrollable">
          <div class="modal-content">
            <form method="post" action="{{route('generate-sales-invoice')}}">
              @csrf
              <input type="hidden" name="invoice_id" id="invoice_id">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-primary btn">Generate Invoice</button>
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
                // $(`#amount-${index}`).val(0);
                return false;
              }
              let coeff = $(`#coefficient-${index}`).val();
              if(!coeff){
                return false;
              }

              coeff = parseFloat(coeff);
              $(`#quantity_15deg-${index}`).val(Math.round(coeff * parseFloat(evt.target.value)));

            //   let price_p = $(`#price-${index}`).val();
            //   if(!!price_p){
            //     $(`#amount-${index}`).val(((parseFloat(evt.target.value) / 20) * parseFloat(price_p)).toFixed(2));
            //   }

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
            // case 'price' :
            //  let quantity_p = $(`#quantity_15deg-${index}`).val();
            //   if(!quantity_p){
            //     return false;
            //   }
            //   quantity_p = parseFloat(quantity_p);
            //   $(`#amount-${index}`).val(((parseFloat(quantity_p) / 20) * parseFloat(evt.target.value)).toFixed(2));
            //   break;
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
          const fields = ['close','product_name','compartment','quantity_observed','coefficient','quantity_15deg','currency'];
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

        $('#save-invoice-btn').on('click',(e) => {
          e.preventDefault();
          const form = document.getElementById('invoice-form').elements;
          const fields = ['product_name','compartment','quantity_observed','coefficient','quantity_15deg','currency'];
          let fObj = [];
          let hasError = false;
          const numItems = document.getElementById('t-body').childElementCount;
          if(numItems < 1){
            alert ('Add an Invoice Item');
            return false;
          }

          if(numItems == 1){
              let obj = {}
              fields.forEach( (elem) => {
                const value = form[elem+'[]'].value;
                obj[elem] = value;
              });
              const date = new Date();
              obj['invoice_date'] = date.toDateString();
              fObj.push(obj);
          }else{
            for(let i = 0; i< numItems; i++){
              let obj = {}
              fields.forEach( (elem) => {
                const value = form[elem+'[]'][i].value;
                obj[elem] = value;
              });
              const date = new Date();
              obj['invoice_date'] = date.toDateString();
              fObj.push(obj);
            }
          }

          fObj.forEach( (item) => {
            for( let value in item){
              if(item[value] == ''){
                hasError = true;
              }
            }
          });


          if(hasError){
            alert('Fill in all fields in the grid below');
          }else{
            const items = JSON.stringify(fObj);
            document.getElementById('items').value=items;
            $('#invoice-form').submit();
          }
          // for(let i = 0; i< fields.length; i++){
          //   let som = collection.map( elem => elem.value);
          //   console.log(som);
          // }




        });


        $('#customer_id').on('change', (evt) => {
            evt.preventDefault();
            const customer_id = evt.target.value;
            if(!!customer_id){
            $('#save-invoice-btn').attr('disabled','true');
                 fetch('/api/fetchCustomerAccount',{
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type' : 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify({id: customer_id})
                })
                .then( resp => resp.json())
                .then( data => {
                    if(data !== null){
                        $('#customer_account').val(`${data.customer_name_english} - ${data.account_number}`);
                        $('#vat_num').val(data.vat_number);
                        $('#save-invoice-btn').attr('disabled',false);
                    }
                })
                .catch(err => {
                    // console.log(err);
                    $('#save-invoice-btn').attr('disabled',false);
                })
            }


        })



        //fetch the selected invoice item details;

         function  handlePrefillInvoiceItems(data) {
                $('#invoice_id').val(data.invoice_id);
                const table = $('#invoice-items');
                const {items} = data;
                items.forEach((item,index) => drawItemTable(item,index,table));

                let modal = $('#purchase-items');
                modal.modal();


        }


$('#purchase-items').on('hidden.bs.modal', function (e) {
    document.getElementById('invoice-items').innerHTML=``;
});

        function drawItemTable(item,index,table){
            const {product_name,compartment,quantity_observed,coefficient,quantity_15deg,price = 0,currency} = item;
            //fetch the table handle;
            // create a row and fill in the data;
            // then append the row to the table

            let row = document.createElement('tr');
            row.setAttribute('data-index',index);
            row.innerHTML = `<td>${index+1}</td><td>${product_name}</td><td>${compartment}</td><td>${quantity_observed}</td>
            <td>${coefficient}</td><td>${quantity_15deg}</td><td><input name="price-${index}" class="price" id="${'price-'+index}" value="${price}"/></td><td>${currency}</td><input type="hidden" name="item-${index}" value="true" />`;
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
                url: '/api/get-sales-notice-details',
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
