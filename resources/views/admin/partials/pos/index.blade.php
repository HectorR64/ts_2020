@extends('layouts.app')

@section('title')
    <title>Venta</title>
@endsection
@section('vent')
    active
@endsection

@push('css')
  <link type="text/css" href="{{asset('/')}}assets/admin/css/datatable.bootstrap.min.css">
  <style>
    .submit-form-loader{
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999999;
      background: #171515b8;
      transition: 1s;
      display: none;
    }
    .submit-form-loader .loader{
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
    }
    .img-container {
    overflow: hidden;
    display: block;
}

  </style>
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
                  <input type="hidden" value="" id="saleUrl">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Codigo</th>
                          <th>Subtotal</th>
                          <th>Iva</th>
                          <th>Total</th>
                          <th>Cliente</th>
                          <th>Estatus</th>
                          <th class="text-right" colspan="2">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                          <td class="text-center">{{$sale->id}}</td>
                          <td>{{ $sale->number_sale }}</td>
                          <td>{{ $sale->total }}</td>
                          <td>{{ $sale->iva_sale }}</td>
                          <td>{{ $sale->total_amount }}</td>
                          <td>{{ $sale->client->client_name }}</td>
                          <td>
                          @if ($sale->status == 'paid')
                          <span class="badge badge-pill badge-success" >
                            <i class="bg-success"></i> Pagado
                          </span>
                         @else
                          <span class="badge badge-pill badge-danger" >
                            <i class="bg-danger"></i> No pagado
                         </span>
                          @endif
                          </td>
                          <td class="td-actions text-right">
                            <a type="button" style="text-align:left" class="btn btn-info btn-round btn-edit" href="{{ route('pos.show', $sale->id) }}" rel="tooltip" data-original-title="Ver" aria-describedby="tooltip417588"><i class="material-icons">remove_red_eye</i></a>
                            <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$sale->id}}" rel="tooltip" data-original-title="Eliminar" aria-describedby="tooltip417588"><i class="material-icons">close</i></button>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="fixed-action-btn" rel="tooltip" data-original-title="Agregar" aria-describedby="tooltip417588">
            <a class="btn-floating btn-large info" href="{{route('pos.create')}}">
              <i class="large material-icons">add</i>
            </a>
          </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="saleEditModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update sale</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="updatesale" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Title</label>
              <input type="text" class="form-control" name="update_title" id="update_title">
          </div>
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Sub Title</label>
              <input type="text" class="form-control" name="update_sub_title" id="update_sub_title">
          </div>
          <div class="form-group bmd-form-group">
              <label>Image</label><br>
              <input type="file" name="update_image" id="update_image">
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          <input type="hidden" name="hidden_id" id="hidden_id">
        </div>
      </form>
    </div>
  </div>
</div>

<div class="submit-form-loader">
  <div class="loader">
    <img src="{{asset('/')}}assets/admin/img/loader.gif" alt="">
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

  {{-- <script src="{{asset('/')}}assets/admin/js/pages/sale.js"></script> --}}
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  <script>
    $(document).ready(function (){




         // Delete Category
         $(document).on("click", ".btn-delete", function(){
          var delete_tr = $(this).parent().parent().addClass('parent_delete');
          var csrf_token = $('meta[name="csrf_token"]').attr('content');
            swal({
                title: "¿Estas seguro?",
                text: "Eliminaras el registro actual",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  var id = $(this).data("id");
                  var url = "{{url('admin/pos')}}";
                  $.ajax({
                    url: url+'/'+id+'/delete',
                    method: "POST",
                    data: {
                      '_method' : 'DELETE', '_token' : csrf_token
                    },
                    success: function (data) {
                      if ($.isEmptyObject(data.error)) {
                        delete_tr.hide();
                        swal(data.message, {
                            icon: data.alert_type,
                        });
                      }else{

                      }
                    }
                  });
                }else{
                  swal("Dato conservado exitosamente!");
                }
            });
        });
    });
  </script>




@endpush
