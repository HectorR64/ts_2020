@extends('layouts.app')
@section('title')
    <title>Inicio</title>
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
<script src="{{ asset('js/main.js') }}" defer></script>
<div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div style="position: relative;display: flex;padding: 0.5rem;">
                        <h4 id='date-part' style="margin-right:0.5rem"></h4>
                        <h4 id='time-part'></h4>

                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="row">
            <div class="col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">store</i>
                      </div>
                      <p class="card-category">Visitas totales</p>
                      <h3 class="card-title"></h3>
                    </div>
                    <div class="card-footer">

                    </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">restaurant_menu</i>
                      </div>
                      <p class="card-category">Productos totales</p>
                      <h3 class="card-title">{{ $products->count() }}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">

                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                      <div class="card-icon">
                        <i class="material-icons">shopping_cart</i>
                      </div>
                      <p class="card-category">Ventas de hoy</p>
                      <h3 class="card-title">{{ $sales->count() }}</h3>
                    </div>
                    <div class="card-footer">
                    </div>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
              <div class="card">
                <div class="card-body text-center">
                    <div id="calendar"></div>
              </div>
            </div>
          </div>
</div>
@endsection
