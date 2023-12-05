
@extends('layouts.app')


@section('title')
    <title>Categorias</title>
@endsection
@section('cat')
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
                    <i class="material-icons">category</i>
                  </div>
                  <h4 class="card-title">Categorias</h4>
                </div>
                <div class="card-body">
                  <input type="hidden" value="{{route('slider.read')}}" id="sliderUrl">
                  <input type="hidden" value="{{asset('/')}}" id="imgPath">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Icono</th>
                          <th>Titulo</th>
                          <th>Estatus</th>
                          <th class="text-right" colspan="2">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categorys as $category)
                            <tr>
                                <td class="text-center">{{$category->id}}</td>
                                <td> <img src="../../upload/category/{{$category->image}}"style="border-radius: 50%; width: 50px; height: 50px;"/></td>
                                <td>{{$category->name}}</td>
                                <td HEIGHT="80" WIDTH="300">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="checkbox" data-id="{{$category->id}}"  id="category_status" class="form-check-input" {{ $category->status ? 'checked' : '' }}/>
                                    <span class="form-check-sign">
                                    <span class="check"></span>
                                     </span>
                                    </label>
                                     </div>
                                    </td>
                                <td class="td-actions text-right">
                                    <button type="button" class="btn btn-info btn-round btn-edit"   data-id="{{$category->id}}" rel="tooltip" data-original-title="Editar" aria-describedby="tooltip417588"><i class="material-icons">edit</i></button>
                                     <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$category->id}}" rel="tooltip" data-original-title="Eliminar" aria-describedby="tooltip417588"><i class="material-icons">close</i></button>
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
            <a class="btn-floating btn-large info" id="addSlider" data-toggle="modal" data-target="#CategoryModal">
              <i class="large material-icons">add</i>
            </a>
          </div>
    </div>
</div>

<!----------- Nuevo Modal ------------>
<div class="modal fade" id="CategoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Nueva categoria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('category.store')}}" method="POST" id="storeCategory" enctype="multipart/form-data">
      @csrf
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Nombre</label>
              <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="form-group bmd-form-group">
            <label>Icono</label><br>
            <input type="file" name="image" id="image" required>
        </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------------ Editar Modal ----------->
<div class="modal fade" id="categoryEditModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Editar categoria</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="updateCategory" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_name" id="update_name" required>
          </div>
          <div class="form-group bmd-form-group">
            <label>Icono</label><br>
            <input type="file" name="update_image" id="update_image">
        </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
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
        $("#addCategory").click(function(){
          $("#CategoryModal").modal("show");
        });
        // Get Data
        var table = $('#category_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('category.index')}}",
          columns: [
              {data:'id', name:'id'},
              {data:'name', name:'name'},
              { data: 'image', name: 'image' },
              {
                data:'action',
                name:'action',
                orderable: true,
                searchable: true
              },
          ]
        });

        $("#addCategory").click(function(){
          $("#CategoryModal").modal("show");
        });

        // Store Category
        var t = $('#category_table').DataTable();
        var counter = 1;
        $(document).on("submit", "#storeCategory", function(e){
          e.preventDefault();
          var url    = $(this).attr('action');
          var method = $(this).attr('method');
          $.ajax({
            url: url,
            method: method,
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,

            success: function(data){
            $('.form-control').val('');
              $("#CategoryModal").modal("hide");
              swal({
                 title: "Dato guardado",
                  text: "Correctamente",
                   icon: "success",
                     buttons: false,
                     dangerMode: true,
                 });
              window.location.reload();
            },
            complete: function(){
                $(".submit-form-loader").css('display', 'none');
            }
          });
        });

        // Edit Slider
        $(document).on("click", ".btn-edit", function (){

          $("#categoryEditModal").modal("show");
          var id = $(this).data("id");
          var url = "{{url('admin/category')}}";
          $(this).parent().parent().find('td').eq(1).addClass(''+id+'');
          if(id){
            $.ajax({
              url: url+'/'+id+'/edit',
              method: "GET",
              success: function (data) {
                if($.isEmptyObject(data) != null) {
                  $("#update_name").val(data.name);
                  $("#hidden_id").val(data.id);
                }
              }
            });
          }
        });

         // Update Slider
      $(document).on("submit", "#updateCategory", function (e) {
          e.preventDefault();
          var id = $("#hidden_id").val();
          var url = "{{route('category.update',"+id+")}}";
          var message = $("#message");
          var show_message = $("#message span");

          $.ajax({
              url: url,
              method: "POST",
              data: new FormData(this),
              dataType: "JSON",
              contentType: false,
              cache: false,
              processData: false,

              success: function (data) {
                $("#categoryEditModal").modal("hide");
                swal({
                 title: "Dato actualizado",
                  text: "Correctamente",
                   icon: "success",
                     buttons: false,
                     dangerMode: true,
                 });
                show_message.html(data.message);
                message.addClass(data.class_name);

                window.location.reload();

              }
          });
      });
              //Estatus
      $(document).on("click", "#category_status", function(){
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data("id");
        var url = "{{url('admin/category/status')}}";

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
                  var url = "{{url('admin/category')}}";
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

