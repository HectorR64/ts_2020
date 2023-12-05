@extends('web.plantilla')

@section('content')
<style type="text/css">
  div.fondito{
    background-color: #d8da3d }
  </style>
      <div >

            <div id="carousel-example-generic" class="ms-carousel carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ol class="carousel-indicators">
                @foreach ($sliders as $slider)
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

                  @endforeach
                </ol>
                <!-- Wrapper for slides -->

                <div class="carousel-inner" role="listbox">
                    <?php echo $i='';?>
                     @foreach ($sliders as $slider)
                  <div class="carousel-item <?php if($i ==1){echo"active";}?>">
                    <img class="d-block img-fluid" src="../../upload/sliders/{{$slider->image}}" alt="...">
                    <div class="carousel-caption">
                      <h3>{{$slider->title}}</h3>
                      <p>{{$slider->sub_title}}.</p>
                    </div>
                  </div>
                  <?php $i++;?>
                  @endforeach
                </div>

                <!-- Controls -->
                <a href="#carousel-example-generic" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary left carousel-control-prev" role="button" data-slide="prev"><i class="zmdi zmdi-chevron-left"></i></a>
                <a href="#carousel-example-generic" class="btn-circle btn-circle-xs btn-circle-raised btn-circle-primary right carousel-control-next" role="button" data-slide="next"><i class="zmdi zmdi-chevron-right"></i></a>

              </div>

        </div> <!-- container -->
      </div> <!-- ms-hero ms-hero-black -->
      <div class="container mt-6" id="menu">
        <div class="card-body card-body-big">
            <h1 class="font-light">Tienes hambre y no sabes como saciar tu apetito?</h1>
        <p class="lead color-primary">—  Con nuestra variedad sera imposible no saciar tu hambre voraz!</p>
          <h3 class="text-center fw-500 mb-3">Menu</h3>
          <div class="mw-800 center-block mb-3">
            <ul class="nav nav-tabs nav-tabs-transparent indicator-primary nav-tabs-full nav-tabs-4" role="tablist">
              <li role="presentation" class="nav-item"><a class="nav-link filter active withoutripple" href="#home7" aria-controls="home7" role="tab" data-toggle="tab" data-filter="all"><img src="web/iconos/santo.png" height="32" width="32" /></i> <span class="d-none d-md-inline">Todo</span></a></li>
              @foreach($categorys as $category)
              <li role="presentation" class="nav-item"><a class="nav-link filter withoutripple" href="#profile7" aria-controls="profile7" role="tab" data-toggle="tab" data-filter=".{{ $category->slug }}"><img src="../../upload/category/{{$category->image}}" height="32" width="32"></i> <span class="d-none d-md-inline">{{ $category->name }}</span></a></li>
              @endforeach
            </ul>
          </div>
          <div class="row" id="Container">
         @foreach ($products as $product)
            <div class="col-lg-4 col-sm-6 mix {{ $product->category->slug }}">
              <div class="card">
                <figure class="ms-thumbnail">
                  <img src="{{ $product -> image_path }}" alt="" class="img-fluid">
                  <figcaption class="ms-thumbnail-caption text-center">
                    <div class="ms-thumbnail-caption-content">
                        <h3 class="ms-thumbnail-caption-title">{{$product-> product_name}}</h3>
                        <p>{{$product-> description}}.</p>
                      <!--  <a href="javascript:void(0)" class="btn-circle btn-circle-raised mr-1 btn-circle-white color-danger"><i class="material-icons">shopping_cart</i></a>-->
                        <a  href="{{route('web.show',($product->id))}}" class="btn-circle btn-circle-raised ml-1 mr-1 btn-circle-white color-warning" data-toggle="tooltip" data-template="<div class=&quot;tooltip tooltip-success&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner&quot;></div></div>" data-placement="bottom" title="Saber mas">
                            <i class="material-icons">visibility</i></a>
                            <a  href="https://wa.me/+527292429930?text=Buen dia, quisiera pedir {{ $product->product_name}} " target="_blank" rel="noflow" class="btn-circle btn-circle-raised ml-1 mr-1 btn-circle-white color-success" data-toggle="tooltip" data-template="<div class=&quot;tooltip tooltip-success&quot; role=&quot;tooltip&quot;><div class=&quot;tooltip-inner&quot;></div></div>" data-placement="bottom" title="Pedir ahora">
                                <i class="zmdi zmdi-whatsapp"></i></a>
                      </div>


                  </figcaption>
                </figure>
              </div>
            </div> <!-- item -->
            @endforeach
          </div>
        </div>
      </div>
      <div class="container" id="servicios">
        <h2 class="text-center color-primary mb-2 wow fadeInDown animation-delay-4">Nuestros Servicios </h2>
        <p class="lead text-center aco wow fadeInDown animation-delay-5 mw-800 center-block mb-4">¡Los esperamos en Taco Santo!  </p>
        <div class="row">
          <div class="ms-feature col-xl-4 col-lg-6 col-md-6 card wow flipInX animation-delay-4">
            <div class="text-center card-body">
              <span class="ms-icon ms-icon-circle ms-icon-xxlg color-info"><i class="icon ion-md-bicycle"></i></span>
              <h4 class="color-info">Entrega a domicilio</h4>
              <p class="">Entregas en Toluca y alrrededores.</p>
              <a href="https://wa.me/+527292429930" target="_blank" class="btn btn-info btn-raised">Realiza tu pedido</a>
            </div>
          </div>
          <div class="ms-feature col-xl-4 col-lg-6 col-md-6 card wow flipInX animation-delay-8">
            <div class="text-center card-body">
              <span class="ms-icon ms-icon-circle ms-icon-xxlg color-warning"><i class="icon ion-md-calendar"></i></span>
              <h4 class="color-warning">Eventos especiales</h4>
              <p class="">Contactanos para reservar tu evento.</p>
              <a href="#contactanos" class="btn btn-warning btn-raised">Contactanos</a>
            </div>
          </div>
          <div class="ms-feature col-xl-4 col-lg-6 col-md-6 card wow flipInX animation-delay-10">
            <div class="text-center card-body">
              <span class="ms-icon ms-icon-circle ms-icon-xxlg color-success"><i class="icon ion-ios-timer"></i></span>
              <h4 class="color-success">Abierto de Lunes a Viernes</h4>
              <p class="">Abrimos de Lunes a Viernes de 9am a 5pm.</p>
              <a href="#ubicacion" class="btn btn-success btn-raised">Visitanos</a>
            </div>
          </div>
        </div>
      </div>
      <!-- container -->

    </div> <!-- ms-site-container -->
       <section id="contactanos" class="mt-6">
          <div class="fondito">
            <div class="container">
              <h1 class="text-center color-white mb-4 wow fadeInUp animation-delay-2">Contactanos</h1>
              <div class="row">
                <div class="col-lg-12">
                  <div class="card card-primary animated zoomInUp animation-delay-5">
                    <div class="card-body" >
                      <form class="form-horizontal" method="post" action="{{route('contactanos.store')}}" >
                        @csrf
                        <fieldset class="container">
                          <div class="form-group row">
                            <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Nombre</label>
                            <div class="col-lg-9">
                              <input type="text" class="form-control" id="inputName" name="nombre" placeholder="Nombre">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" autocomplete="false" class="col-lg-2 control-label">Correo</label>
                            <div class="col-lg-9">
                              <input type="email" class="form-control" id="inputEmail" name="correo" placeholder="Correo">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="textArea" class="col-lg-2 control-label">Mensaje</label>
                            <div class="col-lg-9">
                              <textarea class="form-control" rows="3" id="textArea" name="mensaje" placeholder="Mensaje"></textarea>
                            </div>
                          </div>
                          <div class="form-group row justify-content-end">
                            <div class="col-lg-10">
                              <button type="submit" class="btn btn-raised btn-primary">Enviar</button>
                              <button type="button" class="btn btn-danger">Cancelar</button>
                            </div>
                          </div>
                        </fieldset>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- container -->
          </div >
          <iframe id="ubicacion" width="100%" height="340" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4478.433049344633!2d-99.64080601818613!3d19.28678848784068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd894879085083%3A0x752dd80c79b5d84f!2sTaco%20Santo!5e0!3m2!1sen!2smx!4v1614884551981!5m2!1sen!2smx"></iframe>
        </section>



@endsection
