







<div class="modal modal-primary" id="ms-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog animated zoomIn animated-3x" role="document">
      <div class="modal-content">
        <div class="modal-header d-block shadow-2dp no-pb">
          <button type="button" class="close d-inline pull-right mt-2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
          <div class="modal-title text-center">
            <span class="ms-logo-sm mr-1"><img src="web/iconos/taco.ico" height="70px" width="70px"> </span>
            <h1 class="logolet">Tacos Luna</span></h1>
          </div>
          <div class="modal-header-tabs">
            <ul class="nav nav-tabs nav-tabs-full nav-tabs-2 nav-tabs-primary" role="tablist">
              <li class="nav-item" role="presentation"><a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link active withoutripple"><i class="zmdi zmdi-account"></i> Ingresar</a></li>
             <!-- <i class="zmdi zmdi-whatsapp"></i> <li class="nav-item" role="presentation"><a href="#ms-register-tab" aria-controls="ms-register-tab" role="tab" data-toggle="tab" class="nav-link withoutripple"><i class="zmdi zmdi-account-add"></i> Registrarse</a></li>-->
            </ul>
          </div>
        </div>
        <div class="modal-body">
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
              <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <fieldset>
                  <div class="form-group label-floating">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                        <label class="control-label" for="ms-form-email-r">Correo</label>
                        <input type="email" id="email" class="form-control" @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                         @error('email')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <i class="zmdi zmdi-close"></i></button>
                            <strong><i class="zmdi zmdi-close-circle"></i> Error!</strong>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                      <label class="control-label" for="ms-form-pass">Contraseña</label>
                      <input type="password" id="password" class="form-control"
                      @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                      <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="zmdi zmdi-close"></i></button>
                        <strong><i class="zmdi zmdi-close-circle"></i> Error!</strong>
                        {{ $message }} </div>
                  @enderror
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <div class="form-group no-mt">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-raised btn-primary pull-right">Ingresar</button>
                    </div>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif
                  </div>
                </fieldset>
              </form>
              <!--<div class="text-center">
                <h3>Ingresar con</h3>
                <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-facebook"><i class="zmdi zmdi-facebook"></i> Facebook</a>
                <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-twitter"><i class="zmdi zmdi-twitter"></i> Twitter</a>
                <a href="javascript:void(0)" class="wave-effect-light btn btn-raised btn-google"><i class="zmdi zmdi-google"></i> Google</a>
              </div>-->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="ms-register-tab">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <fieldset>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                      <label class="control-label" for="ms-form-user-r">Nombre</label>
                      <input type="text" id="ms-form-user-r" class="form-control"  @error('name')
                      is-invalid @enderror" name="name" value="{{ old('name') }}"required autocomplete="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                      <label class="control-label" for="ms-form-email-r">Correo</label>
                      <input type="email" id="ms-form-email-r" class="form-control" @error('email')
                      is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                      <label class="control-label" for="ms-form-pass-r">Contraseña</label>
                      <input type="password" id="ms-form-pass-r" class="form-control" @error('password') is-invalid @enderror" name="password"
                      required autocomplete="new-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                    </div>
                  </div>
                  <div class="form-group label-floating">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                      <label class="control-label" for="ms-form-pass-rn">Confirmar contraseña</label>
                      <input type="password" id="password-confirm" class="form-control"
                      name="password_confirmation" required autocomplete="new-password">

                    </div>
                  </div>
                  <button type="submit" class="btn btn-raised btn-block btn-primary">Registrarse</button>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
