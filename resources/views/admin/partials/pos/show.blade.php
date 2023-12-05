
@extends('layouts.app')

@section('title')
    <title>Venta</title>
@endsection
@section('vent')
    active
@endsection

@push('css')


<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">shopping_cart</i>
                  </div>
                  <h4 class="card-title">Ventas</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="logo">
                            <img src="{{asset('web/img/circ1.png')}}" height="120px" width="120px">
                            </div>

                        </div>


                        <div class="col-md-3 ml-auto">

                            <h3>NO.{{$sale->number_sale}}</h3>
                            <div class="date">Fecha: {{$sale->created_at}}</div>

                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                            <div class="name"> Cliente: {{$sale->client->name}}</div>
                             <div class="address">Telefono: 7227155023</div>
                            <div class="email">Correo: <a href="mailto:{{$sale->client->email}}">{{$sale->client->email}}</a></div>
                            <div class="address">Estatus:  @if ($sale->status == 'paid')
                                <span class="badge badge-pill badge-success" >
                                  <i class="bg-success"></i> Pagado
                                </span>
                               @else
                                <span class="badge badge-pill badge-danger" >
                                  <i class="bg-danger"></i> No pagado
                               </span>
                                @endif</div>
                        </div>
                        <div class="col-md-3 ml-auto">
                            <h4 class="name">Taco Santo</h4>
                            <div>Ignacio Pérez 821,Vértice,50090,Toluca de Lerdo,Mexico </div>
                            <div>(602) 519-0450</div>
                            <div><a href="mailto:contacto@tacosanto.com">contacto@tacosanto.com</a></div>
                        </div>
                      </div>
                      <table class="table table-shopping">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Producto</th>
                            <th class="th-description">Precio unitario</th>
                            <th class="th-description">Cantidad</th>
                            <th class="text-left">Precio final</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach ($sale->products as $key => $sales)
                            <td>{{ $key+1 }}</td>
                            <td>{{ $sales->product_name }}</td>
                            <td>{{ $sales->sale_price }}</td>
                            <td>{{ $sales->pivot->quantity}}</td>
                            <td>{{ $sales->pivot->quantity * $sales->sale_price}}</td>
                          </tr>
                          @endforeach
                          <tr>
                            <td colspan="2"></td>
                            <td class="td-total">
                              Subtotal
                            </td>
                            <td colspan="1" class="td-price">
                              <small>&dollar;</small>{{ $sale->total }}
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                            <td class="td-total">
                              IVA
                            </td>
                            <td colspan="1" class="td-price">
                              <small>&dollar;</small>{{ $sale->iva_sale }}
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="2"></td>
                            <td class="td-total">
                              Total
                            </td>
                            <td colspan="1" class="td-price">
                              <small>&dollar;</small>{{ $sale->total_amount }}
                            </td>
                            <td></td>
                          </tr>
                          <!--
                          <tr>
                            <td colspan="6"></td>
                            <td colspan="2" class="text-right">
                              <button type="button" class="btn btn-info btn-round">Complete Purchase <i class="material-icons">keyboard_arrow_right</i></button>
                            </td>
                          </tr>
                        -->
                        </tbody>
                      </table>
                      <a type="button" class="btn btn-danger btn-round btn-delete" href="{{ route('customer.invoice.download', $sale->id) }}" ><i class="material-icons">save_alt</i>Descargar</a>
              </div>
            </div>
        </div>

    </div>
</div>


@endsection


@push('js')
  {{-- DataTable --}}
  <script type="text/javascript" src="{{asset('/')}}assets/admin/js/datatable/datatable.min.js"></script>
  <script type="text/javascript" src="{{asset('/')}}assets/admin/js/datatable/datatable.bootstrap4.min.js"></script>

  <script src="{{asset('/')}}assets/admin/demo/demo.js"></script>
  <script src="{{asset('/')}}assets/admin/js/sweetalert.min.js"></script>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  {{-- <script src="{{asset('/')}}assets/admin/js/pages/sale.js"></script> --}}





@endpush
