
@extends('layouts.app')


@section('title')
    <title>Clientes</title>
@endsection
@section('client')
    active
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
                    <i class="material-icons">person_pin</i>
                  </div>
                  <h4 class="card-title">Clientes</h4>
                </div>
                <div class="card-body">
                  <input type="hidden" value="{{route('slider.read')}}" id="sliderUrl">
                  <input type="hidden" value="{{asset('/')}}" id="imgPath">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Telefono</th>
                          <th>Codigo Postal</th>
                          <th>Direccion</th>
                          <th>Estatus</th>
                          <th class="text-right" colspan="2">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td class="text-center">{{$client->id}}</td>

                                <td>{{$client->client_name}}</td>
                                <td>{{$client->email}}</td>
                                <td>{{$client->phone}}</td>
                                <td>{{$client->cp}}</td>
                                <td>{{$client->address}}</td>
                                <td HEIGHT="80" WIDTH="300">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="checkbox" data-id="{{$client->id}}"  id="clients_status" class="form-check-input" {{ $client->status ? 'checked' : '' }}/>
                                    <span class="form-check-sign">
                                    <span class="check"></span>
                                     </span>
                                    </label>
                                     </div>
                                    </td>
                                <td class="td-actions text-right">
                                    <button type="button" class="btn btn-info btn-round btn-edit"   data-id="{{$client->id}}" rel="tooltip" data-original-title="Editar" aria-describedby="tooltip417588"><i class="material-icons">edit</i></button>
                                     <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$client->id}}" rel="tooltip" data-original-title="Eliminar" aria-describedby="tooltip417588"><i class="material-icons">close</i></button>
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
            <a class="btn-floating btn-large info" id="addSlider" data-toggle="modal" data-target="#clientsModal">
              <i class="large material-icons">add</i>
            </a>
          </div>
    </div>
</div>

<!----------- Nuevo Modal ------------>
<div class="modal fade" id="clientsModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Nuevo cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('clients.store')}}" method="POST" id="storeclients" >
      @csrf
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Nombre</label>
              <input type="text" class="form-control" name="client_name" id="client_name" required>
          </div>
          <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Correo</label>
            <input type="text" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Telefono</label>
            <input type="text" class="form-control" name="phone" id="phone" required>
        </div>
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Codigo Postal</label>
            <input type="text" class="form-control" name="cp" id="cp" required>
        </div>
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Dirección</label>
            <input type="text" class="form-control" name="address" id="address" required>
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
<div class="modal fade" id="clientsEditModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Editar Cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="updateclients" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_name" id="update_name" required>
          </div>
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_email" id="update_email" required>
          </div>
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_phone" id="update_phone" required>
          </div>
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_cp" id="update_cp" required>
          </div>
          <div class="form-group bmd-form-group">
            <input type="text" class="form-control" name="update_address" id="update_address" required>
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
        $("#addclients").click(function(){
          $("#clientsModal").modal("show");
        });
        // Get Data
        var table = $('#clients_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('clients.index')}}",
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

        $("#addclients").click(function(){
          $("#clientsModal").modal("show");
        });

        // Store clients

        $(document).on("submit", "#storeclients", function(e){
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
              $("#clientsModal").modal("hide");
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

          $("#clientsEditModal").modal("show");
          var id = $(this).data("id");
          var url = "{{url('admin/clients')}}";
          $(this).parent().parent().find('td').eq(1).addClass(''+id+'');
          if(id){
            $.ajax({
              url: url+'/'+id+'/edit',
              method: "GET",
              success: function (data) {
                if($.isEmptyObject(data) != null) {
                  $("#update_name").val(data.client_name);
                  $("#update_email").val(data.email);
                  $("#update_phone").val(data.phone);
                  $("#update_cp").val(data.cp);
                  $("#update_address").val(data.address);
                  $("#hidden_id").val(data.id);
                }
              }
            });
          }
        });

         // Update Slider
      $(document).on("submit", "#updateclients", function (e) {
          e.preventDefault();
          var id = $("#hidden_id").val();
          var url = "{{route('clients.update',"+id+")}}";
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
                $("#clientsEditModal").modal("hide");
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
      $(document).on("click", "#clients_status", function(){
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data("id");
        var url = "{{url('admin/clients/status')}}";

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
              // Delete clients
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
                  var url = "{{url('admin/clients')}}";
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

