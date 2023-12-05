<div class="sidebar" data-color="azure" data-background-color="white" data-image="../../assets/img/sidebar-1.jpg">
    <div class="logo"><a href="http://www.creative-tim.com/" class="simple-text logo-mini">
        <a href="{{route('admin.dashboard')}}" class="simple-text logo-mini">
            <img src="{{asset('web/img/circ1.png')}}" height="55px" width="55px">
          </a>
           <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
            Taco Santo
          </a>
        </div>
        <div class="sidebar-wrapper">
          <div class="user">
            <div class="photo">
              <img src="" style=" border-radius:38px;" height="38px" width="38px"/>
            </div>
            <div class="user-info">
              <a data-toggle="collapse" href="#collapseExample" class="username">
                <span>
                 {{ Auth::user()->name }}
                  <b class="caret"></b>
                </span>
              </a>
              <div class="collapse" id="collapseExample">
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('edit.profile')}} ">
                        <i class="material-icons">face</i>
                      <p>Perfil</p>
                    </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link"  href="{{route('logout')}}" onclick="event.preventDefault(
                        ); document.getElementById('logout-form').submit();">
                      <i class="material-icons">logout</i>
                      <p> Salir </p>
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
                        @csrf

                        </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <ul class="nav">
            <li class="nav-item @yield('admin')">
              <a class="nav-link"  href="{{route('admin.dashboard')}}">
                <i class="material-icons">dashboard</i>
                <p> Inicio </p>
              </a>
            </li>
            <li class="nav-item @yield('slider')">
              <a class="nav-link" href="{{route('slider.index')}}">
                <i class="material-icons">view_carousel</i>
                <p> Carrusel </p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#pagesExamples" @yield('true')>
                <i class="material-icons">restaurant</i>
                <p> Productos
                  <b class="caret"></b>
                </p>
              </a>
              <div class="collapse @yield('prod')" id="pagesExamples">
                <ul class="nav">
                  <li class="nav-item @yield('cat')">
                    <a class="nav-link" href="{{route('category.index')}}">
                      <i class="material-icons">category</i><p>Categorias</p>
                    </a>
                  </li>
                  <li class="nav-item @yield('prods') ">
                    <a class="nav-link" href="{{route('item.index')}}">
                       <i class="material-icons">restaurant_menu</i>
                      <p> Productos </p>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
             <li class="nav-item @yield('vent')">
              <a class="nav-link" href="{{ url('admin/pos') }}">
                <i class="material-icons">shopping_cart</i>
                <p> Ventas </p>
              </a>
            </li>
            <li class="nav-item @yield('user')">
              <a class="nav-link" href="{{ url('admin/usuarios') }}">
                <i class="material-icons">people_alt</i>
                <p> Usuarios </p>
              </a>
            </li>
            <li class="nav-item @yield('client')">
                <a class="nav-link" href="{{ url('admin/clients') }}">
                  <i class="material-icons">person_pin</i>
                  <p> Clientes </p>
                </a>
              </li>
            <li class="nav-item @yield('call')">
              <a class="nav-link" href="{{ url('admin/eventos') }}">
                <i class="material-icons">date_range</i>
                <p> Calendario </p>
              </a>
            </li>

          </ul>
    </div>
    <div class="sidebar-background"></div>
  </div>
