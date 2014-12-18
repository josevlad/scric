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

function selectOptionDependent( parameters ){
	
	var element = $( parameters.selector );
	var url 	= parameters.url;
	var table	= element.attr('table');
	var choose 	= element.attr('choose');
	var id 		= element.attr('id-data');
	
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
		}, "json"); 
	
}
function selectOptionDependent2( parameters ) {
	
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

//strToUpper
	strToUpper2('#dni');
	strToUpper('#nombres');
	strToUpper('#apellidos');
	strToUpper('#direccion');
	strToUpper('#color');
	strToUpper('#placa');
	strToUpper('#serial_c');
	strToUpper('#serial_m');
	
	var dniSaved = $('#dni').val();
	$('#dni').focusout(function(event){
		$.post(		
	 		BASE_URL+'adviser/ajaxTitular', 
			{ dni: $(this).val() }, 
			function(data){
				if (data.length > 0) {
					bootbox.alert(
							'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
								'<h4><strong>!Atencion¡</strong> Este usuario ya exite en la base de datos</h4>'+
							'</div>', 
						function() {
							$('#dni').val(dniSaved);
						}); 
				}
			}, "json"
		);
	});
	
	var placaSaved = $('#placa').attr('data');
	$('#placa').focusout(function(event){
		$.post(		
	 		BASE_URL+'adviser/ajaxAuto', 
			{ placa: $(this).val() }, 
			function(data){
				//console.log(data);
				if ( data.length > 0 ) {
					if ( data['0'].placa != placaSaved ) {
						bootbox.alert(
							'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
								'<h4><strong>!ERROR¡</strong> Esta placa pertenece a un contrato existente</h4>'+
							'</div>', 
							function() {
								$('#placa').val(placaSaved);
						});
					} 
				}
			}, "json"
		);
	});
	
	var serialcSaved = $('#serial_c').attr('data');
	$('#serial_c').focusout(function(event){
		$.post(		
	 		BASE_URL+'adviser/ajaxAuto', 
			{ serial_c: $(this).val() }, 
			function(data){
				//console.log(data);
				if ( data.length > 0 ) {
					if ( data['0'].serial_c != serialcSaved ) {
						bootbox.alert(
							'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
								'<h4><strong>!ERROR¡</strong> Este Serial pertenece a un contrato existente</h4>'+
							'</div>', 
							function() {
								$('#serial_c').val(serialcSaved);
						});
					} 
				}
			}, "json"
		);
	});
	
	var serialmSaved = $('#serial_m').attr('data');
	$('#serial_m').focusout(function(event){
		$.post(		
	 		BASE_URL+'adviser/ajaxAuto', 
			{ serial_m: $(this).val() }, 
			function(data){
				//console.log(data);
				if ( data.length > 0 ) {
					if ( data['0'].serial_m != serialmSaved ) {
						bootbox.alert(
							'<div class="alert alert-danger alert-dark" style="text-align: center;">'+
								'<h4><strong>!ERROR¡</strong> Este Serial pertenece a un contrato existente</h4>'+
							'</div>', 
							function() {
								$('#serial_m').val(serialmSaved);
						});
					} 
				}
			}, "json"
		);
	});
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
	
	loadSelect({
		selector:	'#tipoPersona_id', 
		url:		BASE_URL + "select/loadSelect"
	});

	loadSelect({
		selector:	'#estado', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#tipo_1', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#tipoTelf', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'.tipoTelf', 
		url:		BASE_URL + "select/loadSelect"
	});
	
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
	
	// select dependiente 1
	selectDependent({
		origin:		'#estado',
		selector:	'#municipio', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
		selectOptionDependent({
			selector: 	'#municipio',
			url:		BASE_URL + "select/loadSelectDepent",			
		});
	
	
	$('#estado').change(function () {
		$('#parroquia_id').empty();
		$('#parroquia_id').append('<option value="">Seleccione...</option>');
	});
	
	// select dependiente 2
	selectDependent({
		origin:		'#municipio',
		selector:	'#parroquia_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
		selectOptionDependent({
			selector: 	'#parroquia_id',
			url:		BASE_URL + "select/loadSelectDepent",			
		});
	
	// select dependiente 3
	selectDependent({
		origin:		'#marca',
		selector:	'#modelo_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});

		selectOptionDependent({
			selector: 	'#modelo_id',
			url:		BASE_URL + "select/loadSelectDepent",			
		});
		
	// select dependiente 4
	selectDependent({
		origin:		'#claseVehiculo',
		selector:	'#tipoVehiculo', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
		selectOptionDependent({
			selector: 	'#tipoVehiculo',
			url:		BASE_URL + "select/loadSelectDepent",			
		});
	
	selectDependent({
		origin:		'#tipoVehiculo',
		selector:	'#numPuesto', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
		
		selectOptionDependent({
			selector: 	'#numPuesto',
			url:		BASE_URL + "select/loadSelectDepent",			
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
			
			selectOptionDependent2({
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
		 		BASE_URL+'adviser/getPrecio',{ 
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
		
		selectOptionDependent({
			selector: 	'#usoVehiculo_id',
			url:		BASE_URL + "select/loadSelectDepent",			
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
	
	var selectYear 	= $("#anio");
	var choose 		= selectYear.attr('choose');
	var yy = new Date(); // Año
	selectYear.append('<option value="">Seleccione...</option>');
	for (var i=0; i<100; i++) {
		
		if (choose == (yy.getFullYear()-i)) {
			selectYear.append('<option selected value="' + (yy.getFullYear()-i) + '">' + (yy.getFullYear()-i) + '</option>');
		}else {
			selectYear.append('<option value="' + (yy.getFullYear()-i) + '">' + (yy.getFullYear()-i) + '</option>');
		}
	}
	
	
		
// datepicker 
	
// maskedinput 
	// =============================================== dni ===========================================
	var select1 = $('#tipoPersona_id');
	//$('#dni').attr('disabled', true);
	$('#dni').attr('placeholder', 'Seleccione el Tipo de Persona');
	
	select1.change(function () {
		$('#dni').val('');
		
		if ($(this).val() == '1') {
			$('#dni').attr('disabled', false);
			$('#dni').attr('placeholder', 'V - 00.000.000');			
		}else if ($(this).val() == '2') {
			$('#dni').attr('disabled', false);
			$('#dni').attr('placeholder', 'J - 00000000 - 0');
		}else if ($(this).val() == '3') {
			$('#dni').attr('disabled', false);
			$('#dni').attr('placeholder', 'G - 00000000 - 0');
		}else {
			$('#dni').attr('disabled', true);
			$('#dni').attr('placeholder', 'Seleccione el Tipo de Persona');
		}
	
	})
	
	$(document).on("focus", "#dni", function() { 
		
		if (select1.val() == '1') {
			$.mask.definitions['~']='[VEve]';
			$(this).mask("~ - 99.999.999");
		}else if (select1.val() == '2') {
			$.mask.definitions['~']='[Jj]';
			$(this).mask("~ - 99999999 - 9");
		}else if (select1.val() == '3') {
			$.mask.definitions['~']='[Gg]';
			$(this).mask("~ - 99999999 - 9");
		}else{
			$(this).di
		}
		
	});
	
	// =============================================== Phone ===========================================
	
	$(document).on("focus", ".phone", function() { 
		$(this).mask("(9999) 999-99-99");
	});
	
	// =============================================== dni ===========================================
	
// End maskedinput 
	
// Section of Content dinamic 	
	
	// Cant Max Content Dinamic  ============================================================================
	var a = $("#aux").val();
	//alert(a);
	var b = $("#aux2").val();
	//alert(b);
	var maxPhones       = 1;	
	var addPhone        = $("#addPhone");	
	$('#phones div#clone').hide();
	
	$(addPhone).click(function(e){
		if(a <= maxPhones){
			var cont = 1 + 1;
			var clone = $('#phones div#clone').clone(true);
			
			clone.attr('id','parent');
						
			$('#aux').attr('value', cont );
			
		    $('.tp_phone',clone).attr('id','tipo_'+cont);
		    $('.tp_phone',clone).attr('name','tipo_'+cont);

		    $('.num_phone',clone).attr('id','telf_'+cont);
		    $('.num_phone',clone).attr('name','telf_'+cont);
		    
		    $(clone).appendTo('#phones').show('1500');
		    
			$('.tp_phone',clone).rules('add',{
				required:true,
				messages:{
					required:"Selección requerida"
				}
			});
		    
			$('.num_phone',clone).rules('add',{
				required:true,
				messages:{
					required:"Campo requerido"
				}
			});
			cont = 0;
			a++;
		}
		return false
	});
	
	var MaxMeil      	= 1;	
	var addMail        	= $("#addMail");	
	$('#mail div#clone2').hide();
	
	$(addMail).click(function(e){
		if(b < MaxMeil){
			
			var clone = $('#mail div#clone2').clone(true);
			
			clone.attr('id','parent');
			
			$('#aux2').attr('value', (b+1) );
		    $('.email',clone).attr('name','mail_'+(b+1));
		    
		    $(clone).appendTo('#mail').show('1500');
		    
			$('.email',clone).rules('add',{
				required: true,
			    email: true,				
				messages:{
					required:"Campo requerido",
					email: "Formato invalido",
				}
			});
		    
			b++;
		}
		return false
	});
	
	// Remove Select and Input Dinamic all ===================================================================
	
	$("body").on("click",".delete", function(e){
		
		if( a > 1 ) {
			$(this).parent('div').hide("1500", function(){ $(this).remove(); });
			$('#aux').attr('value', $('#aux').attr('value')-1 );
			a--;
		}
			
		return false;
	});
	
	$("body").on("click",".delete2", function(e){
		
		if( b > 0 ) {
			$(this).parent('div').hide("1500", function(){ $(this).remove(); });
			$('#aux2').attr('value', $('#aux2').attr('value')-1 );
			b--;
		}
			
		return false;
	});
	
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
	
	var myForm = $('#adviser_editarAsoc');
	
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
			color:				"required",
			placa:{
				required: 		true,
				serial: 		true,
			},
			serial_c:{
				required: 		true, 
				serial: 		true,
			},
			serial_m:{
				required: 		true,
				serial: 		true,
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
			color:				"Campo requerido",
			placa:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
			},
			serial_c:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
			},
			serial_m:{
				required: 		"Campo requerido",
				serial: 		"Introduzca un serial válido.",
			},
			claseVehiculo:		"Selección requerida",
			tipoVehiculo:		"Selección requerida",
			numPuesto:			"Selección requerida",//
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
						'<h4><strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> ¿Se han correjido los datos correctamente?</h4>'+
					'</div>',
				function(result) {
				if (result == true) {
					$.ajax({
			            url:	myForm.attr('action'),
			            type:	myForm.attr('method'),
			            data:	myForm.serialize(),
			            success: function(response) {
			                //console.log(response);
			               
			                if (response == true) {
			                	$(location).attr('href', BASE_URL+'adviser/procesoImp2');
							}else {
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

	