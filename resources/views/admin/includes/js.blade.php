  <script src="{{asset('/')}}assets/admin/js/core/jquery.min.js"></script>
  <script src="{{asset('/')}}assets/admin/js/core/popper.min.js"></script>
  <script src="{{asset('/')}}assets/admin/js/core/bootstrap.min.js"></script>
  <script src="{{asset('/')}}assets/admin/js/core/bootstrap-material-design.min.js"></script>
  <script src="{{asset('/')}}assets/admin/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{asset('/')}}assets/admin/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('/')}}assets/admin/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('/')}}assets/admin/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('/')}}assets/admin/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jquery.dataTables.min.js"></script>
  <script src="{{asset('/')}}assets/admin/js/plugins/dataTables.bootstrap4.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('/')}}assets/admin/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('/')}}assets/admin/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('/')}}assets/admin/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('/')}}assets/admin/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{asset('/')}}assets/admin/js/plugins/arrive.min.js"></script>
  <script src="{{asset('admin/js/sale.js')}}"></script>
  <!-- Chartist JS -->
  <script src="{{asset('/')}}assets/admin/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('/')}}assets/admin/js/plugins/bootstrap-notify.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $('#minimizeSidebar').click(function() {
      var $btn = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;
      } else {
        $('body').addClass('sidebar-mini');
        md.misc.sidebar_mini_active = true;
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
      });
    });
  </script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('/assets/admin/js/material-dashboard.js?v=2.1.2')}}" type="text/javascript"></script>


    <script>
      $(document).ready(function () {
          var interval = setInterval(function () {
              var momentNow = moment();
              $('#date-part').html(momentNow.format('dddd') + ' ' + momentNow.format('DD MMMM YYYY'));
              $('#time-part').html(momentNow.format('kk:mm:ss'));
          }, 100);
      });

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
          setFormValidation('#RegisterValidation');
          setFormValidation('#Password');
          setFormValidation('#banner');

        });
      </script>
