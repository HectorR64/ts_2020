
		document.addEventListener('DOMContentLoaded', function(){
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl,{

				defaultDay : new Date(2020,7,20),
				plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],

				header: {
					left: 'prev,next, today',
					center: 'title',
					right: 'dayGridMonth, timeGridWeek, timeGridDay'
				},

				defaultView: 'dayGridMonth',

				dateClick: function(info) {

					limpiarFormulario();
                     // Setting date and time
                     var date = new Date();
                     var year = date.getFullYear();
                     var month = (date.getMonth()+1);
                     var day = date.getDate();

                     month = (month<10)?"0"+month:month;
                     day = (day<10)?"0"+day:day;

					$('#txtFecha').val(info.dateStr)
					$('#btnAgregar').prop('disabled', false);
					$('#btnModificar').prop('disabled', true);
					$('#btnEliminar').prop('disabled', true);
    				$('#myModal').modal('show')

    			},

    			eventClick:function(info){

    				$('#txtID').val(info.event.id);
    				$('#txtTitulo').val(info.event.title);
    				$('#txtDescripcion').val(info.event.extendedProps.descripcion);
    				$('#txtColor').val(info.event.backgroundColor);

                    start_month = (info.event.start.getMonth()+1);
                    start_day = info.event.start.getDate();
                    start_year = info.event.start.getFullYear();
                    start_hours = info.event.start.getHours();
                    start_minutes = info.event.start.getMinutes();

                    start_month = (start_month<10)?"0"+start_month:start_month;
                    start_day = (start_day<10)?"0"+start_day:start_day;
                    start_hours = (start_hours<10)?"0"+start_hours:start_hours;
                    start_minutes = (start_minutes<10)?"0"+start_minutes:start_minutes;

                    // Getting end date and time
                    end_month = (info.event.end.getMonth()+1);
                    end_day = info.event.end.getDate();
                    end_year = info.event.end.getFullYear();
                    end_hours = info.event.end.getHours();
                    end_minutes = info.event.end.getMinutes();

                    end_month = (end_month<10)?"0"+end_month:end_month;
                    end_day = (end_day<10)?"0"+end_day:end_day;
                    end_hours = (end_hours<10)?"0"+end_hours:end_hours;
                    end_minutes = (end_minutes<10)?"0"+end_minutes:end_minutes;

    				$('#txtFecha_inicio').val(start_year+"-"+start_month+"-"+start_day);
                    $('#txtFecha_final').val(end_year+"-"+end_month+"-"+end_day);
    				$('#txtHora_inicio').val(start_hours+":"+start_minutes);
                    $('#txtHora_final').val(end_hours+":"+end_minutes);

					$('#btnAgregar').prop('disabled', true);
					$('#btnModificar').prop('disabled', false);
					$('#btnEliminar').prop('disabled', false);

    				$('#myModal').modal()

    			},

    			events:url_show

			});

			calendar.setOption('locale', 'es');

			calendar.render();

			$('#btnAgregar').click(function(){
				objEvento=recolectarDatosGUI('POST');
				enviarInformacion('', objEvento);
			});

			$('#btnEliminar').click(function(){
				objEvento=recolectarDatosGUI('DELETE');
				eliminarInformacion('/'+$('#txtID').val(), objEvento);
			});

			$('#btnModificar').click(function(){
				objEvento=recolectarDatosGUI('PATCH');
				enviarInformacion('/'+$('#txtID').val(), objEvento);
			});

			function recolectarDatosGUI(method){
				nuevoEvento={
					id: $('#txtID').val(),
					title: $('#txtTitulo').val(),
					descripcion: $('#txtDescripcion').val(),
					color: $('#txtColor').val(),
					textColor: '#FFFFFF',
					start: $('#txtFecha_inicio').val()+' '+$('#txtHora_inicio').val(),
					end: $('#txtFecha_final').val()+' '+$('#txtHora_final').val(),
					'_token':$("meta[name='csrf-token']").attr("content"),
					'_method':method
				}

				// console.log(nuevoEvento);
				return nuevoEvento;
			};

			function enviarInformacion(accion, objEvento){
				$.ajax({
					type: 'POST',
					url: url_ + accion,
					data: objEvento,
					success: function(msg){
                        swal({
                            title: "Dato guardado",
                             text: "Correctamente",
                              icon: "success",
                                buttons: true,
                                dangerMode: true,
                            });
						// console.log(msg);
						$('#myModal').modal("toggle");
						calendar.refetchEvents();


					},
					error: function(){alert('Hay un error');}
				});
			}
            function eliminarInformacion(accion, objEvento){
				$.ajax({
					type: 'POST',
					url: url_ + accion,
					data: objEvento,
					success: function(msg){
                        swal({
                            title: "Dato eliminado",
                             text: "Correctamente",
                              icon: "success",
                                buttons: true,
                                dangerMode: true,
                            });
						// console.log(msg);
						$('#myModal').modal("toggle");
						calendar.refetchEvents();


					},
					error: function(){alert('Hay un error');}
				});
			}

			function limpiarFormulario(){
				$('#txtID').val("");
				$('#txtTitulo').val("");
				$('#txtDescripcion').val("");
				$('#txtColor').val("");
				$('#txtFecha_inicio').val("");
                $('#txtFecha_final').val("");
				$('#txtHora_inicio').val("07:00");
                $('#txtHora_final').val("08:00");

			}

		});






