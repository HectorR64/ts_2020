@extends('layouts.app')

@section('title')
    <title>Materias Primas</title>
@endsection
@section('brand')
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
                    <i class="material-icons">kitchen</i>
                  </div>
                  <h4 class="card-title">Materias primas</h4>
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
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th class="text-right" colspan="2">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($mprimas as $mprima)
                          <tr>
                            <td class="text-center">{{$mprima->id}}</td>
                            <td>{{$mprima->nom_mprima}}</td>
                            <td><img src="{{ $mprima -> image_path }}" style="border-radius: 50%; width: 50px; height: 50px;"></td>
                            <td>{{$mprima->cost_comp}}</td>
                          <td class="td-actions text-right">
                              <button type="button" class="btn btn-info btn-round btn-edit"   data-id="{{$mprima->id}}" "><i class="material-icons">edit</i></button>

                              <button type="button" class="btn btn-danger btn-round btn-delete" data-id="{{$mprima->id}}""><i class="material-icons">close</i></button>
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

  <!-- Add Modal -->
  <div class="modal " id="CategoryModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Nueva Materia</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="{{route('mprimas.store')}}" method="POST" id="storeCategory">
        @csrf
          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group bmd-form-group">
                <label class="bmd-label-floating">Nombre</label>
                <input type="text" class="form-control" name="nom_mprima" id="nom_mprima">
            </div>
            <div class="form-group bmd-form-group">
              <label class="bmd-label-floating">Precio</label>
              <input type="text" class="form-control" name="nom_mprima" id="nom_mprima">
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
  <div class="modal fade" id="categoryEditModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar Materia</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="" method="POST" id="updateCategory">
        @csrf
        @method('PUT')
          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group bmd-form-group">
              <input type="text" class="form-control" name="update_name" id="update_name">
            </div>
            <div class="form-group bmd-form-group">
                <input type="text" class="form-control" name="update_price" id="update_price">
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
    {{-- DataTable --}}
    <script type="text/javascript" src="{{asset('/')}}assets/admin/datatable/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/admin/datatable/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/admin/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/admin/datatable/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/admin/datatable/js/jqeury.dataTables.min.js"></script>

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

          // Get Data
          var table = $('#category_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('mprimas.index')}}",
            columns: [
                {data:'id', name:'id'},
                {data:'name', name:'nom_mprima'},
                {data:'costo', name:'cost_comp'},
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
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data){
                  swal(data.message, {
                    icon: data.alert_type,
                  });
                  $("#CategoryModal").modal("hide");
                  window.location.reload();
                  $("form #nom_mprima").val("");
                  t.row.add([
                    counter +'.1',
                    counter +'.2',
                    counter +'.4',
                  ]).draw( false );
                  counter++;
                },
                error: function(data){
                  swal(data.message, {
                    icon: data.alert_type,
                  });
                }
            });
          });

          // Edit Slider
          $(document).on("click", ".btn-edit", function (){

            $("#categoryEditModal").modal("show");
            var id = $(this).data("id");
            var url = "{{url('admin/mprimas')}}";
            $(this).parent().parent().find('td').eq(1).addClass(''+id+'');
            if(id){
              $.ajax({
                url: url+'/'+id+'/edit',
                method: "GET",
                success: function (data) {
                  if($.isEmptyObject(data) != null) {
                    $("#update_price").val(data.cost_comp);
                    $("#update_name").val(data.nom_mprima);
                    $("#hidden_id").val(data.id);
                  }
                }
              });
            }
          });

        //Update Slider
        $(document).on("submit", "#updateCategory", function (e) {
            e.preventDefault();
            $("#update_price").val();
            $("#update_name").val();
            var id  = $("#hidden_id").val();
            var url = "{{route('mprimas.update',"+id+")}}";
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
                    $("#update_price").val('');
                    $("#update_name").val('');
                    $("#hidden_id").val('');
                    $("#categoryEditModal").modal("hide");

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
                // Delete Category
          $(document).on("click", ".btn-delete", function(){
            var delete_tr = $(this).parent().parent().addClass('parent_delete');
            var csrf_token = $('meta[name="csrf_token"]').attr('content');
              swal({
                  title: "Are you sure?",
                  text: "Once Delete Category",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data("id");
                    var url = "{{url('admin/mprimas')}}";
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
                    swal("Your imaginary file is safe!");
                  }
              });
          });
      });
    </script>
  @endpush

