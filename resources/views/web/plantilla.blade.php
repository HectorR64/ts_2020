<!DOCTYPE html>
<html lang="en">
    @include('web.head')
    <body>
     @include('web.extra')

       @include('web.modal')
        @include('web.header')
         @include('web.nav')
          @yield('content')
         @include('web.footer')

       @include('web.sidebar')
      @include('web.js')
    </body>
</html>
