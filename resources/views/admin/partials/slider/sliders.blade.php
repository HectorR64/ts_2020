@extends('layouts.app')

@section('title')
    <title>Carrusel</title>
@endsection
@section('slider')
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
                    <i class="material-icons">view_carousel</i>
                  </div>
                  <h4 class="card-title">Carrusel</h4>
                </div>
                <div class="card-body">
                  <input type="hidden" value="{{route('slider.read')}}" id="sliderUrl">
                  <input type="hidden" value="{{asset('/')}}" id="imgPath">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>
                          <th>Titulo</th>
                          <th>Subtitulo</th>
                          <th>Imagen</th>
                          <th>Estatus</th>
                          <th class="text-right" colspan="2">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                          <td class="text-center">{{$slider->id}}</td>
                          <td>{{$slider->title}}</td>
                          <td>{{$slider->sub_title}}</td>
                          <td> <img src="../../upload/sliders/{{$slider->image}}"width="200px" height="120px" class="rounded"/></td>
                         <td HEIGHT="80" WIDTH="300">
                         <div class="form-check">
                         <label class="form-check-label">
                         <input type="checkbox" data-id="{{$slider->id}}"  id="slider_status" class="form-check-input" {{ $slider->status ? 'checked' : '' }}/>
                         <span class="form-check-sign">
                         <span class="check"></span>
                          </span>
                         </label>
                          </div>
                         </td>
                        <td class="td-actions text-right">
                            <button type="button"style="text-align:left" class="btn btn-info btn-round btn-edit"   data-id="{{$slider->id}}" rel="tooltip" data-original-title="Editar" aria-describedby="tooltip417588"><i class="material-icons">edit</i></button>

                            <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$slider->id}}" rel="tooltip" data-original-title="Eliminar" aria-describedby="tooltip417588"><i class="material-icons">close</i></button>
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
        <div class="fixed-action-btn"  rel="tooltip" data-original-title="Agregar" aria-describedby="tooltip417588">
            <a class="btn-floating btn-large info" id="addSlider" data-toggle="modal" data-target="#sliderModal" >
              <i class="large material-icons">add</i>
            </a>
        </div>


    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="sliderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Nueva imagen</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('slider.store')}}" method="POST" id="storeSlider" enctype="multipart/form-data">
      @csrf
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Titulo</label>
              <input type="text" class="form-control" name="title" id="title" required>
          </div>
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Subtitulo</label>
              <input type="text" class="form-control" name="sub_title" id="sub_title" required>
          </div>
          <div class="form-group bmd-form-group">
              <label>Imagen</label><br>
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

<!-- Edit Modal -->
<div class="modal fade" id="sliderEditModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Actualizar</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="updateSlider" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Titulo</label>
              <input type="text" class="form-control" name="update_title" id="update_title" required>
          </div>
          <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Subtitulo</label>
              <input type="text" class="form-control" name="update_sub_title" id="update_sub_title" required>
          </div>
          <div class="form-group bmd-form-group">
              <label>Imagen</label><br>
              <input type="file" name="update_image" id="update_image">
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
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

  <script>
    $(document).ready(function () {

        function reset() {
          $("#storeSlider").find('input').each(function () {
              $(this).val(null)
          })
          window.location.reload();
      }
      function updateReset() {
          $("#updateSlider").find('input').each(function () {
              $(this).val(null)
          })
          window.location.reload();

      }
       // Add Slider
       $(document).on("submit", "#storeSlider", function(e){
          e.preventDefault();
          var url     = $(this).attr('action');
          var method  = $(this).attr('method');

          $.ajax({
            url: url,
            method: method,
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,

            success: function(data){
              reset();
              $("#sliderModal").modal("hide");
              swal({
                 title: "Dato guardado",
                  text: "Correctamente",
                   icon: "success",
                     buttons: false,
                     dangerMode: true,
                 });

              getData();
            },
            complete: function(){
                $(".submit-form-loader").css('display', 'none');
            }
          });
      });
    // Edit Slider
    $(document).on("click", ".btn-edit", function () {
        $("#sliderEditModal").modal("show");
        var id = $(this).data("id");
        var url = "{{url('admin/slider')}}";
        $.ajax({
            url: url+'/'+id+'/edit',
            method: "GET",
            success: function (data) {
              if ($.isEmptyObject(data) != null) {
                $("#update_title").val(data.title);
                $("#update_sub_title").val(data.sub_title);
                $("#hidden_id").val(data.id);
              }
            }
        });
      });
       // Update Slider
       $(document).on("submit", "#updateSlider", function (e) {
          e.preventDefault();
          var id = $("#hidden_id").val();
          var url = "{{route('slider.update',"+id+")}}";
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
                updateReset();
                $("#sliderEditModal").modal("hide");
                swal({
                 title: "Dato actualizado",
                  text: "Correctamente",
                   icon: "success",
                     buttons: false,
                     dangerMode: true,
                 });
                show_message.html(data.message);
                message.addClass(data.class_name);
                getData();
                window.location.reload();

              },
              complete: function () {
                window.location.reload();
              }
          });
      });

      $(document).on("click", "#slider_status", function(){
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data("id");
        var url = "{{url('admin/slider/status')}}";

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
      $(document).on("click", ".btn-delete", function(){
        var id = $(this).data("id");
        var csrf_token = $('meta[name="csrf_token"]').attr('content');
        var url = "{{url('admin/slider')}}";
        swal({
            title: "¿Estas seguro?",
            text: "Eliminaras el registro actual",
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

                swal(data.message, {
                    icon: data.alert_type,
                });
                getData();

              }

            });
            window.location.reload();
          }else{
            swal("Registro conservado!");
          }
        });
      });
    })
  </script>


@endpush
