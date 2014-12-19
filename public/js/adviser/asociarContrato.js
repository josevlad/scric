function getBaseUrl(){
	var url = $(location).attr('href').split("/").splice(0, 4).join("/")+'/';
	return url;
}

function strToUpper(field){
	$(field).keyup(function(event){
		$(this).val($(this).val().toUpperCase());
	});
}

function strToUpper2(field){
	$(field).focusout(function(event){
		$(this).val($(this).val().toUpperCase());
	});
}

function loadSelect( parameters ){
	
	var element = $( parameters.selector );
	var url 	= parameters.url;
	var table	= element.attr('table');
	
	if (element.attr('choose')) {
		var choose = element.attr('choose');
	}else if (parameters.choose) {
		var choose = parameters.choose;
	}
	else {
		var choose = '';
	}
	
	$.post(		
 		url, 
		{ table: table }, 
		function(data){
			element.empty();
			element.append('<option value="">Seleccione...</option>');
			for (var i=0; i<data.length; i++) {
				if ( choose == data[i].id ) {
					element.append('<option selected value="' + data[i].id + '">' + data[i].option + '</option>');
				}else {
					element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
				}
			}
		}, "json"); 
	
}

function selectDependent( parameters ){
	
	var origin 		= 	$(parameters.origin);
	var idOrigin 	=	parameters.origin;
	var element 	= 	$( parameters.selector );
	var url 		= 	parameters.url;
	var table		= 	element.attr('table');
	
	element.append('<option value="">Seleccione...</option>');
	
	$(origin).change(function(){
		$(idOrigin+' option:selected').each(function(){
			var id = $(this).val();
			$.post(		
		 		url, 
				{ table: table, id: id }, 
				function(data){
					element.empty();
					element.append('<option value="">Seleccione...</option>');
					for (var i=0; i<data.length; i++) {
						element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
					}
				}, "json");
		})
	});
	
}

function selectOptionDependent( parameters ) {
	
	var selector	=	parameters.selector;
	var element		= 	$( parameters.selector )
	var url 		= 	parameters.url;
	var id			= 	parameters.id;
	var choose		=	parameters.choose;
	var table		=	parameters.table

	$.post(		
 		url, 
		{ table: table, id: id }, 
		function(data){
			element.empty();
			element.append('<option value="">Seleccione...</option>');
			for (var i=0; i<data.length; i++) {
				if ( choose == data[i].id ) {
					element.append('<option selected value="' + data[i].id + '">' + data[i].option + '</option>');
				}else {
					element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
				}
			}
		}, "json"
	);
	
}

function getval() {
    var currentTime = new Date()
    var hours = currentTime.getHours()
    var minutes = currentTime.getMinutes()

    if (minutes < 10)
        minutes = "0" + minutes;

    var suffix = "AM";
    if (hours >= 12) {
        suffix = "PM";
        hours = hours - 12;
    }
    if (hours == 0) {
        hours = 12;
    }
    var current_time = hours + ":" + minutes + " " + suffix;
    return current_time;
}

//=================================================================================================================================

$(document).ready(function() {
	
	var BASE_URL = getBaseUrl();
	
//verificación de formatos
	if ($('#stPlanillas').attr('dt-Planilla') == 0) {
		bootbox.alert(
			'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
				'<h4><strong>!Atencion¡</strong> Aun no puede crear un contrato, ya que no existe planillas registradas en el sistema. por favor registre un lote</h4>'+
			'</div>', 
			function() {
			 $(location).attr('href', BASE_URL+'adviser/formatos');
		});
	}else if ($('#stFacturas').attr('dt-Facturas') == 0) {
		bootbox.alert(
			'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
				'<h4><strong>!Atencion¡</strong> Aun no puede crear un contrato, ya que no existe Facturas registradas en el sistema. por favor registre un lote</h4>'+
			'</div>', 
			function() {
			 $(location).attr('href', BASE_URL+'adviser/formatos');
		});
	}else if ($('#countPlanillas').attr('numP') < 20) {
		bootbox.alert(
				'<div class="alert alert-dark" style="text-align: center;">'+
					'<h4><strong>!Atencion¡</strong> quedan '+$('#countPlanillas').attr('numP')+' Planillas para crear contratos, se sugiere registrar mas formatos al sistema</h4>'+
				'</div>', 
				function() {
			});
	}else if ($('#countFacturas').attr('numF') < 20 ) {
		bootbox.alert(
			'<div class="alert alert-dark" style="text-align: center;">'+
				'<h4><strong>!Atencion¡</strong> quedan '+$('#countFacturas').attr('numF')+' Facturas para imprimir, se sugiere registrar mas formatos al sistema</h4>'+
			'</div>', 
			function() {
		});
	}
//strToUpper
	strToUpper2('#dni');
	strToUpper('#nombres');
	strToUpper('#apellidos');
	strToUpper('#direccion');
	strToUpper('#color');
	strToUpper('#placa');
	strToUpper('#serial_c');
	strToUpper('#serial_m');
	
//load imput
	$('#dni').focusout(function(event){
		$.post(		
	 		BASE_URL+'adviser/ajaxTitular', 
			{ dni: $(this).val() }, 
			function(data){
				if (data.length > 0) {
					bootbox.confirm(
							'<div class="alert alert-info alert-dark" style="text-align: center;">'+
								'<h4><strong>!Atencion¡</strong> Este usuario ya exite, ¿desea asociarle un nuevo contrato de vehiculo?.</h4>'+
							'</div>', 
						function(result) {
							if(result){								
								$(location).attr('href', BASE_URL+'adviser/asociarContrato/'+data[0]['id']);								
							}else {
								$('#dni').val('');
							}	
						}); 
				}
			}, "json"
		);
		/*
		$(this).val($(this).val().toUpperCase());
		*/
	});
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
	
	loadSelect({
		selector:	'#marca', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#tipoTrans_id', 
		url:		BASE_URL + "select/loadSelect"
	});

	loadSelect({
		selector:	'#claseVehiculo', 
		url:		BASE_URL + "select/loadSelect"
	});

	loadSelect({
		selector:	'#tipoPago', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	//==================================================
	
	selectDependent({
		origin:		'#marca',
		selector:	'#modelo_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});

	selectDependent({
		origin:		'#claseVehiculo',
		selector:	'#tipoVehiculo', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	selectDependent({
		origin:		'#tipoVehiculo',
		selector:	'#numPuesto', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	$('#claseVehiculo').change(function () {
		$('#numPuesto').empty();
		$('#numPuesto').append('<option value="">Seleccione...</option>');
		$('#cobertura').empty();
		$('#cobertura').append('<option value="">Seleccione...</option>');
		$('#cobertura').attr('disabled', true);
		$('#precio_id').val('');
		$('#precioTxt').val('Sin precio');	
	});
	
	$('#cobertura').attr('disabled', true);
	
	$('#numPuesto').change(function () {
		
		if ($(this).val() == '') {
			$('#cobertura').empty();
			$('#cobertura').append('<option value="">Seleccione...</option>');
			$('#cobertura').attr('disabled', true);
			$('#precio_id').val('');
			$('#precioTxt').val('Sin precio');				
		}else{
			$('#cobertura').attr('disabled', false);
			$('#precio_id').val('');
			$('#precioTxt').val('Sin precio');
			
			selectOptionDependent({
				selector:	'#cobertura', 
				url:		BASE_URL + "select/loadSelectDepent",
				id:			$('#claseVehiculo').val(),
				choose:		'0',
				table:		'cobertura'
			});
		}

	});
	
	$('#cobertura').change(function () {
		var cobertura_id = $(this).val();
		var numPuesto_id = $('#numPuesto').val();
		
		if (cobertura_id == '') {
			$('#precio_id').val('');
			$('#precioTxt').val('sin precio');
			$('#precio_id').val('');
			$('#precioTxt').val('Sin precio');
		}else {
			$.post(
		 		BASE_URL+'adviser/getPrecio',
		 		{ 
		 			cobertura_id: cobertura_id, 
		 			numPuesto_id: numPuesto_id 
		 		}, 
				function(data){
					$('#precio_id').val(data.id);
					$('#precioTxt').val(data.precio);
					
				}, "json"
			);
		}	
	});

	selectDependent({
		origin:		'#claseVehiculo',
		selector:	'#usoVehiculo_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	/*
	loadSelect({
		selector:	'#', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	selectDependent({
		origin:		'#',
		selector:	'#', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	*/
	
	var selectYear = $("#anio");
	
	var yy = new Date(); // Año
	selectYear.append('<option value="">Seleccione...</option>');
	for (var i=0; i<100; i++) {
		selectYear.append('<option value="' + (yy.getFullYear()-i) + '">' + (yy.getFullYear()-i) + '</option>');
	}
	
	
		
// datepicker 
	

	

	
	// Remove Select and Input Dinamic all ===================================================================
	
// End Section of Content dinamic
	
	$('#hours').text(getval());
	
	var d = new Date();
	var today = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
	
	$('#hora_exp').val('11:59 PM');
	$('.hour').on("focus", "#hora_exp", function() { 
		$(this).val('11:59 PM');		
	});
	$('.hour').on("focusout", "#hora_exp", function() { 
		$(this).val('11:59 PM');		
	});
	$('.hour').on("keyup", "#hora_exp", function() { 
		$(this).val('11:59 PM');		
	});
	
	$('#fecha_exp').val(today);
	$('.date').on("focus", "#fecha_exp", function() { 
		$(this).val(today);		
	});
	$('.date').on("focusout", "#fecha_exp", function() { 
		$(this).val(today);		
	});
	$('.date').on("keyup", "#fecha_exp", function() { 
		$(this).val(today);		
	});
	
	
	
// Validate
	
	var myForm = $('#adviser_asociarContrato');
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'div',
		validClass: "success"
	})
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\.\s]+$/i.test(value);
	}, "Letters only please"); 
	
	jQuery.validator.addMethod("serial", function(value, element) {
	  return this.optional(element) || /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ]+$/i.test(value);
	}, "Serial only please");
	
	jQuery.validator.addMethod("minage", function(value, element, min) {
		var today = new Date();
		var DD 		= Number(today.getDate());
		var MM 		= Number(today.getMonth());
		var YYYY 	= Number(today.getFullYear());

		var birthDate = value;
		var BD_D = Number(birthDate.split("-")[0])
		var BD_M = Number(birthDate.split("-")[1])
		var BD_Y = Number(birthDate.split("-")[2])
		
		var aux = YYYY - BD_Y;
		var age;
		
		if (MM > BD_M) {
			age = aux - 1;
		}else if (MM == BD_M || DD > BD_D) {
			age = aux - 1;
		}else{
			age = aux;
		}
		
	    if (age > min+1) {
	        return true;
	    }
	 
	    return age >= min;
	}, "You are not old enough!");
	
	myForm.validate({
		rules:{
			marca:				"required",
			modelo_id:			"required",
			tipoTrans_id:		"required",
			anio:				"required",
			color:{
				required: 		true,
				lettersonly: 	true,				
			},
			placa:{
				required: 		true,
				serial: 		true,
				remote:			BASE_URL + 'select/remote'
			},
			serial_c:{
				required: 		true, 
				serial: 		true,
				remote:			BASE_URL + 'select/remote'
			},
			serial_m:{
				required: 		true,
				serial: 		true,
				remote:			BASE_URL + 'select/remote'
			},
			claseVehiculo:		"required",
			tipoVehiculo:		"required",
			numPuesto:			"required",//
			tipoPago:			"required",
			cobertura:			"required",
			uso:				"required",
			carga:				"required",
			peso:{
				required: 		true,
				digits: 		true,
			},
			usoVehiculo_id:		"required",
		},
		messages: {			
			marca:				"Selección requerida",
			modelo_id:			"Selección requerida",
			tipoTrans_id:		"Selección requerida",
			anio:				"Selección requerida",
			color:{
				required: 		"Campo requerido",
				lettersonly: 	"Introduzca caracteres válidos.",				
			},
			placa:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
				remote:			"Placa asociada a un contrato"
			},
			serial_c:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
				remote:			"Serial asociada a un contrato"
			},
			serial_m:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
				remote:			"Serial asociada a un contrato"
			},
			claseVehiculo:		"Selección requerida",
			tipoVehiculo:		"Selección requerida",
			numPuesto:			"Selección requerida",//peso
			tipoPago:			"Selección requerida",
			cobertura:			"Selección requerida",
			uso:				"Selección requerida",
			carga:				"Selección requerida",
			peso:{
				required: 		"Campo requerido",
				digits: 		"Introduzca un serial válido.",
			},
			usoVehiculo_id:		"Selección requerida",
		},
		submitHandler: function() {
			//$(location).attr('href', myForm.attr('action'));
			//location.reload();
			bootbox.confirm(
					'<div class="alert alert-dark bootbox-text">'+
						'<h4><strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> ¿La información Cargada es la correcta?.</h4>'+
					'</div>',
				function(result) {
				if (result == true) {
					$.ajax({
			            url:	myForm.attr('action'),
			            type:	myForm.attr('method'),
			            data:	myForm.serialize(),
			            success: function(response) {
			            	console.log(response);
			            	if(response == true){
			            		$(location).attr('href', BASE_URL+'adviser/procesoImp2');
			            	}else{
			            		alert(response);
			            	}
			            }            
			        });
				}
			}); 
			
			
        },
		success: function(element) {
			element.remove();
			$('precio').attr('disabled', false);
			
		}
	});
	
	
});

	