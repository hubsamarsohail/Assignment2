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
        Purchase Invoice
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
              <h3 class="box-title">Edit Invoice</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('edit-invoice-purchase',['invoice_id' => $invoice->invoice_id])}}">
                @csrf
                <input type="hidden" name="items" id="items">
                <input type="hidden" name="invoice_id" value="{{$invoice->invoice_id}}">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_id" class="col-sm-3 control-label">Supplier *</label>
                      <div class="col-sm-9">
                          <select class="form-control" name="customer_id" id="customer_id">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{$invoice->supplier_id == $supplier->id ? 'selected' : ''}} data-sup-data="{{json_encode($supplier->account_number)}}">{{$supplier->customer_name_english}}</option>
                            @endforeach
                          </select>
                        {{-- <input type="text" name="supplier_id" class="form-control" id="supplier_id" placeholder="supplier Name English" value="{{old('supplier_id') ? old('supplier_id') : ''}}"> --}}
                        @error('customer_id')
                          <div class="text-danger">
                            Select Supplier
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="customer_account" class="col-sm-3 control-label">Supplier Account</label>
                      <div class="col-sm-9">
                        <input type="text" name="customer_account" class="form-control" id="customer_account" placeholder="Customer Account Details" value="{{ $invoice->supplier_account ? $invoice->supplier_account : old('supplier_account')}}" disabled>
                        @error('supplier_account')
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
                             <input type="text" name="invoice_num" class="form-control" id="invoice_num" placeholder="Invoice Number" value="{{$invoice->id ? $invoice->id : old('invoice_num')}}" disabled>
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
                              <input type="date" name="invoice_date" class="form-control" id="invoice_date" placeholder="dd/mm/yyyy" value="{{$invoice->invoice_date ? $invoice->invoice_date->format('yy-m-d') : old('invoice_date')}}">
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
                              <input type="text" name="truck_num" class="form-control" id="truck_num" placeholder="7765XY" value="{{ $invoice->truck_num ? $invoice->truck_num : old('truck_num')}}">

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
                                        <option value="{{$stock->id}}" {{$invoice->warehouse_id == $stock->id ? 'selected' : ''}}>{{$stock->name}}</option>
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
                              <input type="number" name="vat_num" class="form-control" placeholder="VAT NUMBER" value="{{ $invoice->vat_num ? $invoice->vat_num : old('vat_num')}}" disabled>

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
                              <textarea name="notes" id="" cols="30" rows="2" class="form-control" placeholder="Notes">{{ $invoice->notes ? $invoice->notes : old('notes')}}</textarea>
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
                            {{-- <button type="button" id="add-invoice-item">
                                    <i class="fa fa-plus"></i>
                            </button> --}}
                            S/N
                        </th>
                        <th>Product</th>
                        <th>Compartments</th>
                        <th>Quantity Observed</th>
                        <th>Co-efficent</th>
                        <th>Quantity at 15deg</th>
                        <th>Price Per Tin</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody id="t-body">
                          @foreach ($invoice->items as $item)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                              <select class="form-control" name="product_name[]">
                                @foreach ($products as $product)
                                <option value="{{$product->name}}" {{$item['product_name'] == $product->name ? 'selected' : ''}} >{{$product->name}}</option>
                                @endforeach
                              </select>
                            <td><input type="text" value="{{$item['compartment']}}" name="compartment[]"/></td>
                            <td><input type="number" step="0.0001" value="{{$item['quantity_observed']}}" name="quantity_observed[]"/></td>
                            <td><input type="number" step="0.0001" value="{{$item['coefficient']}}" name="coefficient[]"/></td>
                            <td><input type="number" step="0.0001" value="{{$item['quantity_15deg']}}" name="quantity_15deg[]"/></td>
                            <td><input type="number" step="0.0001" value="{{$item['price']}}" name="price[]" /></td>
                            <td><select class="form-control" name="currency[]">
                                  <option value="">Currency</option>
                                  <option value="USD" {{$item['currency'] == 'USD' ? 'selected' : ''}} >USD</option>
                                  <option value="LBP" {{$item['currency'] == 'LBP' ? 'selected' : ''}} >LBP</option>
                              </select>
                            </td>
                            <td>{{$item['amount']}}</td>
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
                <button type="submit" class="btn btn-info pull-right" >Edit Invoice</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

             </div>

    </section>
    </section>

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

        $('#save-invoice-btn').on('click',(e) => {
          e.preventDefault();
          const form = document.getElementById('invoice-form').elements;
          const fields = ['product_name','compartment','quantity_observed','coefficient','quantity_15deg','price','currency','amount'];
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
                 fetch('/api/fetchVendorAccount',{
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
                      $('#vat_num').val(data.vat_num);
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

        function  handlePrefillInvoiceItems({status,data}) {
            if(status == 'success'){
                const table = $('#invoice-items');
                $('.invoice_id').val(data.invoice_id);
                const {items} = data;
                items.forEach((item,index) => drawItemTable(item,index,table));
                if(data.status == 'paid'){
                  $('#gen_receipt').css({display: 'none'});
                }
                let modal = $('#purchase-items');
                modal.modal();
            }

        }

         $('#purchase-items').on('hidden.bs.modal', function (e) {
           $('#gen_receipt').css({display: 'inline-block'});
          $('#invoice-items').html('');
      });

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
                url: '/api/get-invoice-details',
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
