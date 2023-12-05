@extends('layouts.app')

@section('title')
    <title>Producto</title>
@endsection
@section('prods')
    active
@endsection
@section('true')
aria-expanded="true"
@endsection
@section('prod')
    show
@endsection

@push('css')

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
    .form-control:focus {
      color: #333;
      background-color: #fff;
      border-color: #333;
      outline: 0;
      box-shadow: 0 0 0 0 rgba(0,123,255,.25);
    }
    .form-control {
      border: none;
      padding: 0;
    }
    .wait-loading {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #171515b8;
      z-index: 999999;
      display: none;
    }
    .wait-loading .load {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      color: #fff;

    }
    .wait-loading .load h3 {
      font-size: 23px;
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
                    <i class="material-icons">restaurant_menu</i>
                  </div>
                  <h4 class="card-title">Productos</h4>
                </div>
                <div class="card-body">
                  <input type="hidden" value="{{route('slider.read')}}" id="sliderUrl">
                  <input type="hidden" value="{{asset('/')}}" id="imgPath">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Imagen</th>
                          <th>Nombre</th>
                          <th>Descripcion</th>
                          <th>Categoria</th>
                          <th>Precio</th>
                          <th>Disponibilidad</th>
                          <th>Estatus</th>
                          <th class="text-right" colspan="3">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        <tr>
                          <td class="text-center">{{$product->id}}</td>
                          <td><img src="{{ $product -> image_path }}" style="border-radius: 50%; width: 50px; height: 50px;"></td>
                          <td>{{$product->product_name}}</td>
                          <td>{{$product->description}}</td>
                          <td>{{$product->category->name}}</td>
                          <td>{{$product->sale_price}}</td>
                          <td>{{$product->stock}}</td>
                          <td HEIGHT="80" WIDTH="30">
                            <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" data-id="{{$product->id}}"  id="item_status" class="form-check-input" {{ $product->status ? 'checked' : '' }}/>
                            <span class="form-check-sign">
                            <span class="check"></span>
                             </span>
                            </label>
                             </div>
                            </td>
                          <td class="td-actions text-right">
                            <button type="button" class="btn btn-info btn-round btn-edit" data-id="{{$product->id}}" rel="tooltip" data-original-title="Editar disponibilidad" aria-describedby="tooltip417588"><i class="material-icons">add</i></button>
                            <a type="button" class="btn btn-info btn-round "   href="{{route('item.edit',($product->id))}}" rel="tooltip" data-original-title="Editar" aria-describedby="tooltip417588"><i class="material-icons">edit</i></a>
                            <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$product->id}}" rel="tooltip" data-original-title="Eliminar" aria-describedby="tooltip417588"><i class="material-icons">close</i></button>
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
            <a class="btn-floating btn-large info" href="{{route('item.create')}}">
              <i class="large material-icons">add</i>
            </a>
          </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade bd-example-modal-sm" id="CategoryModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar disponibilidad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="" method="POST" id="updateCategory">
            @csrf
            @method('PUT')
              <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 ml-auto mr-auto">
                    <div class="form-group bmd-form-group">
                    <input type="number" class="form-control" name="update_stock" id="update_stock" required>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Editar</button>
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
<div class="wait-loading">
  <div class="load">
    <h3>Please Wait...</h3>
  </div>
</div>
@endsection


@push('js')


  <script src="{{asset('/')}}assets/admin/demo/demo.js"></script>
  <script src="{{asset('/')}}assets/admin/js/sweetalert.min.js"></script>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  <script>
    $(document).ready(function (){
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

        // All Function


        // Delete Item
        $(document).on("click", ".btn-delete", function(){
          var delete_tr = $(this).parent().parent().addClass('parent_delete');
          var csrf_token = $('meta[name="csrf_token"]').attr('content');
          var id = $(this).data("id");
          var url = "{{url('admin/item')}}";

            swal({
                title: "Estas segur de eliminar?",
                text: "Eliminaras este registro permanentemente ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                    url: url+'/'+id+'/destroy',
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
                  swal("Dato conservado!");
                }
            });
        });
      //Estatus
      $(document).on("click", "#item_status", function(){
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data("id");
        var url = "{{url('admin/item/status')}}";

        $.ajax({
          url: url+'/'+id,
          method: "GET",
          success: function(data){
            swal(data.message, {
              icon: data.alert_type,
            });
          }
        });
      });

 // Edit Slider
 $(document).on("click", ".btn-edit", function () {
        $("#CategoryModal").modal("show");
        var id = $(this).data("id");
        var url = "{{url('admin/item')}}";
        $.ajax({
            url: url+'/'+id+'/editar',
            method: "GET",
            success: function (data) {
              if ($.isEmptyObject(data) != null) {
                $("#update_stock").val(data.stock);
                $("#hidden_id").val(data.id);
              }
            }
        });
      });

     //Update Slider
     $(document).on("submit", "#updateCategory", function (e) {
          e.preventDefault();
          $("#update_stock").val();
          var id  = $("#hidden_id").val();
          var url = "{{route('item.updates',"+id+")}}";
          var tbody = $('table tbody tr td.'+id+'');
          $.ajax({
              url: url,
              method: "POST",
              data: $(this).serialize(),
              dataType: "JSON",
              beforeSend: function () {
                $(".submit-form-loader").css('display', 'block');
              },
              success: function (data) {
                if (data.message){
                  swal(data.message, {
                    icon: data.alert_type,
                  });
                  $("#update_stock").val('');
                  $("#hidden_id").val('');
                  $("#CategoryModal").modal("hide");
                  $(tbody).text(data.name);
                  window.location.reload();
                }else if(data.require){
                  alert(data.require);
                }

              },
              complete: function () {
                $(".submit-form-loader").css('display', 'none');
              }
          });
      });

    });
  </script>
@endpush
