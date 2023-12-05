@extends('layouts.app')

@section('title')
    <title>Perfil</title>
@endsection

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
              <div class="card">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                   <h4 class="card-title">Perfil</h4>
                </div>
                <div class="card-body text-center">
                  <form  id="RegisterValidation" method="post" action="{{route('update.profile', $user)}}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                  <div class="form-group">
                    <label class="bmd-label-floating">Nombre</label>
                      <input type="text" class="form-control" name="name" required="true" aria-required="true" value="{{ $user->name }}">
                      <span class="form-control-feedback">

                      </span>
                  </div>
                  <div class="form-group">
                    <label for="exampleEmail" class="bmd-label-floating">Correo</label>
                      <input type="email" class="form-control" id="exampleEmail" name="email" required="true" value="{{ $user->email }}">
                      <span class="form-control-feedback">

                      </span>
                   </div>

                   <button type="button" class="btn btn-danger">Cancelar</button>
                   <button type="submit" class="btn btn-primary add-item">Guardar</button>
                 </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 ml-auto mr-auto">
              <div class="card">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">password</i>
                    </div>
                    <h4 class="card-title">Cambiar contraseña</h4>
                </div>
                <div class="card-body text-center">
                    <form  id="Password" method="post" action="{{route('updates.profile', $user)}}">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                    <div class="form-group bmd-form-group">
                        <label for="examplePassword" class="bmd-label-floating"> Password *</label>
                        <input type="password" class="form-control" id="examplePassword" required="true" name="password" aria-required="true">
                      </div>
                      <div class="form-group bmd-form-group">
                        <label for="examplePassword1" class="bmd-label-floating"> Confirm Password *</label>
                        <input type="password" class="form-control" id="examplePassword1" required="true" equalto="#examplePassword" name="password_confirmation" aria-required="true">
                      </div>
                       <button type="button" class="btn btn-danger">Cancelar</button>
                          <button class="btn btn-primary add-item">Guardar</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
  <!-- Forms Validations Plugin -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jquery.validate.min.js"></script>

@endsection

