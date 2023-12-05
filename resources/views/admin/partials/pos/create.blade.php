@extends('layouts.apps')
@section('title')
    <title>Venta</title>
@endsection
@section('vent')
    active
@endsection
@section('content')

<style type="text/css">
    .oxy-quantity{display:-ms-inline-flexbox;display:inline-flex;-ms-flex-align:center;align-items:center;height:36px;vertical-align:middle}.oxy-quantity .mdl-textfield{width:48px;padding:0}.oxy-quantity input[type=number]{text-align:center;max-width:100%;-moz-appearance:textfield}.oxy-quantity input[type=number]::-webkit-inner-spin-button,.oxy-quantity input[type=number]::-webkit-outer-spin-button{-webkit-appearance:none}.oxy-rating{position:relative;overflow:hidden;font-size:13px;line-height:20px;height:20px;width:calc(5em + 15px);letter-spacing:3px;font-weight:400;text-decoration:none}.oxy-rating--medium{font-size:16px}.oxy-rating--big{font-size:18px}.oxy-rating:focus{outline:0}.oxy-rating span,.oxy-rating span:before,.oxy-rating:before{font-family:'Material Icons';top:0;left:0;position:absolute;font-weight:400;text-decoration:none}.oxy-rating:before{content:"\E83A \E83A \E83A \E83A \E83A"}.oxy-rating span{overflow:hidden;padding-top:1em}.oxy-rating span:before{content:"\E838 \E838 \E838 \E838 \E838"}
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card" >
               <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">add_shopping_cart</i>
                  </div>
                  <div class="card-title">
                    <h3>Productos</h3>
                  </div>
                  <br>
                  <br>
        <div style="float:right">
                 <div class="box-inline pad-rgt pull-left">
                    <div class="filtro">
                        <input type="text" class="form-control" onkeyup="myFunction();" name="produceitem" id="myInput" placeholder="Buscar...">
                    </div>
                </div>
        </div>
    </div>
        </div>
            <div class="card-body" style="  overflow:scroll; height:1000px;" >
                 <div class="row" id="allItems">

                 @foreach($products as $product)
                <div class="col-sm-6 col-lg-3" id="singleItem">

                    <div class="card card-pricing ">
                    <input type="hidden" id="itemid" value="{{$product->id}}">
                     <input type="hidden" id="itemimg" value="{{ asset($product->thumbnail_img)}}">
                     <input type="hidden" id="itemName" value="{{$product->product_name}}">
                    <div class="card-body text-center" >
                        <h5 style="font-weight:bold;">{{$product->product_name}}</h5>
                        <div class="card-icon icon-rose ">
                            <img src="{{ $product -> image_path }}"height="120" width="130" alt="">
                          </div>
                          <h4 class="card-title">{{$product->sale_price}}$</h4>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a  data-placement="top" id="product-{{ $product->id }}" +
                            data-name="{{ $product->product_name }}" + data-id="{{ $product->id }}" +
                            data-sale_price="{{ $product->sale_price }}" + data-stock="{{ $product->stock }}" class="btn btn-success btn-round add-product">
                         <i class="material-icons">add_shopping_cart</i>Añadir
                        </a>
                     </div>
                    </div>
                  </div>

                @endforeach

              </div>
            </div>
        </div>

     <div class="col-md-4">
        <form action="{{ route('pos.store') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}
        <div class="card" >
            <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">shopping_cart</i>
                  </div>
                  <div class="card-title">
                    <h3>Carrito</h3>

                  </div>
                   <div class="col-md-6 ml-auto" >
                       <div class="select" style="min-width: 200px; padding: 2px;">
                        <select class="form-control demo-select2" name="client_id" id="client_id" >
                         @foreach($clients as $client)
                      <option value="{{$client->id}}">{{__($client->client_name)}}</option>
                    @endforeach

                        </select>
                    </div>
                    </div>
                </div>

                <div class="card-body" id="cart"  style="  overflow:scroll; height:330px;">
                     <table class="table table-shopping">
                                    <thead>
                                        <tr>

                                            <th  class="text-center">{{__('Producto')}}</th>
                                            <th class="text-center">{{__('Cantidad')}}</th>
                                            <th class="text-left">{{__('Total')}}</th>
                                            <th style="width: 25px;">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list">
                              </tbody>
                         </table>
                        <hr>
                    </table>
                </div>
        </div>

        <div class="card">
            <br>

              <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        Subtotal:
                    </div>
                </div>
                <div class="col-md-3 ml-auto">
                    <input type="number" name="total" class="form-control  col-sm-6 total-sale_price" min="0"
                    readonly value="0">
                </div>
             </div>
             <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        Descuento:
                    </div>
                </div>
                <div class="col-md-3 ml-auto">
                    <input type="number" id="discount" name="discount"
                    class="form-control col-sm-6 discount" min="0" value="0">
                </div>
             </div>
             <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        IVA:
                    </div>
                </div>
                <div class="col-md-3 ml-auto">
                    <input type="number" id="subtotal" name="iva_sale"
                    class="form-control col-sm-6 total-amount" readonly min="0" value="0">
                </div>
             </div>

             <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        Total:
                    </div>
                </div>
                <div class="col-md-3 ml-auto">
                    <input type="number" id="total-amount" name="total_amount"
                    class="form-control col-sm-6 total-amount" readonly min="0" value="0">
                </div>
              </div>
              <br>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button  type="button" class="btn btn-danger btn-round" onclick="location.reload()"><i class="material-icons">delete</i>Cancelar</button>
                </div>
                <div class="col-md-4 ml-auto">
                   <button  type="submit" class="btn btn-success btn-round"><i class="material-icons">save_alt</i>Guardar</button>
                </div>
               </div>
             </form>
                </div>
              </div>
            </div>
          </div>

          <script src="{{asset('/')}}assets/admin/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <script type="text/javascript">

    function myFunction() {
    var input, filter, allItems, singleItem, a, i;
    input = $('#myInput').val();
    filter = input.toUpperCase();
    singleItem = $('#singleItem');
    $('#allItems').children('#singleItem').each(function(){
        var name = $(this).find('#itemName').val();
        if(name.toUpperCase().indexOf(filter)>-1){
            $(this).css('display', '');
        }else{
            $(this).css('display', 'none');
        }
    });
   };
   function closeMessage(){
    $('#messageDiv').css('display', 'none');
    location.reload();
}
$.ajax({
                    type: "GET",
                    url: "/addproduct",
                    data: 'code=' + sCode,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.product);
                        //console.log(data.products[0].codebar);
                        var name = data.product[0].product_name;
                        var id = data.product[0].id;
                        var price = data.product[0].sale_price;
                        var stock = data.product[0].stock;

                        numRows = $('.order-list .items').length + 1;
                        //var qty = $('#qty').val();
                        for (var i = 1; i < numRows; i++) {
                            var code = $("tr:nth-child(" + i + ") td:nth-child(1)")
                                .html();
                            var next = $("tr:nth-child(" + i +
                                ") td:nth-child(3) input").val();
                            if (code == name) {
                                var add = parseInt(next) + 1;
                                if (add <= stock) {
                                    $("tr:nth-child(" + i +
                                        ") td:nth-child(3) input").val(add);
                                    var all = add * price;
                                }
                                $("tr:nth-child(" + i +
                                    ") td:nth-child(4)").html(all);
                                calculateTotal();
                                calculateTotalAmount();
                                return true;
                            }
                        }
                        var html =
                            `<tr id="${id}" class="form-group items">
                            <td id="name" class="namex">${name}</td>
                            <input type="hidden" name="product[]" value="${id}">
                            <td style="display: flex;">
                                <input id="qty" style="width: 60% !important;" type="number" name="quantity[]"
                                    data-price="${price}" data-stock="${stock}"
                                    class="form-control input-sm product-quantity" min="1" max="${stock}" value="1">
                            </td>
                            <td class="product-price">${price}</td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-product-btn"
                                    data-id="${id}"><span class="fa fa-trash"></span></button></td>
                        </tr>`;

                        $('.order-list').append(html);
                        calculateTotal();
                        calculateTotalAmount();
                        return true;
                    }
                });


    </script>
 <script type="text/javascript">
  $('.card').perfectScrollbar();
   $('#cart').perfectScrollbar();
 </script>

@endsection
