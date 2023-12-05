@extends ('layouts.apps')
@section('title')
    <title>Calendario</title>
@endsection
@section('call')
    active
@endsection

@section('content')


<link rel="stylesheet" href="{{ asset('fullcalendar/core/main.css') }}" >

<script src="{{ asset('fullcalendar/core/locales/es.js') }}" defer></script>
<script src="{{ asset('fullcalendar/core/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/interaction/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/daygrid/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/list/main.js') }}" defer></script>
<script src="{{ asset('fullcalendar/timegrid/main.js') }}" defer></script>
<script src="{{asset('assets/admin/js/sweetalert.min.js')}}"></script>
<script>
    var url_='{{ url("admin/eventos") }}';
    var url_show='{{ url("admin/eventos/show") }}';
</script>
<script>
    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

    $(document).ready(function() {

      setFormValidation('#banner');

    });
  </script>
<script src="{{ asset('js/main.js') }}" defer></script>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto">
                  <div class="card card-calendar">
                    <div class="card-body ">
                      <div id="calendar"></div>
                    </div>
                  </div>
                </div>
              </div>
	    </div>
    </div>


	{{-- Modal --}}
	<div class="modal" tabindex="-1" role="dialog" id="myModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Datos del evento</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <input type="text" name="txtID" id="txtID" readonly hidden="true">
	        <input type="text" name="txtFecha" id="txtFecha" hidden="true">
            <form>
            <div class="form-row">
				<div class="form-group col-md-12">
					<label for="title">Nombre del evento</label>
					<input class="form-control" type="text"name="txtTitulo" id="txtTitulo" required>
				</div>

				<div class="form-group col-md-6">
					<label for="txtFecha_inicio">Fecha de Inicio</label>
					<input class="form-control" type="date" name="txtFecha_inicio" id="txtFecha_inicio" required>
				</div>

				<div class="form-group col-md-6">
					<label for="txtHora_inicio">Hora de inicio</label>
            		<input class="form-control" type="time" min="01:00 a.m." max="23:59 p.m." step="600"  name="txtHora_inicio" id="txtHora_inicio" required>
				</div>

				<div class="form-group col-md-6">
					<label for="txtFecha_final">Fecha de Termino</label>
            		<input class="form-control" type="date" name="txtFecha_final" id="txtFecha_final" required>
				</div>

				<div class="form-group col-md-6">
					<label for="txtHora_final">Hora de termino</label>
            		<input class="form-control" type="time" min="01:00 a.m." max="23:59 p.m." step="600" name="txtHora_final" id="txtHora_final" required>
				</div>

				<div class="form-group col-md-12">
					<label for="color">Color</label>
            		<input class="form-control" type="color" name="txtColor" id="txtColor">
				</div>

				<div class="form-group col-md-12">
					<label for="description">Descripcion</label>
            		<textarea name="txtDescripcion" class="form-control" id="txtDescripcion"  cols="30" rows="10"></textarea>
				</div>

			</div>
            </form>
	      </div>
	      <div class="modal-footer">
	      	<button id="btnAgregar" class="btn btn-success">Agregar</button>
	      	<button id="btnModificar" class="btn btn-success">Modificar</button>
	      	<button id="btnEliminar" class="btn btn-danger">Borrar</button>
	      	<button id="btnCancelar" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection
