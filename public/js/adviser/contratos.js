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


//=================================================================================================================================

$(document).ready(function() {
	
	var BASE_URL = getBaseUrl();
	
//strToUpper
	strToUpper2('#dni');
	strToUpper('#nombres');
	
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
		selector:	'#tipoTelf_id', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#tipoTelf', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#marca', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#trans', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	//==================================================
	
	selectDependent({
		origin:		'#estado',
		selector:	'#municipio', 
		url:		BASE_URL + "select/loadSelectDepent"
	});

	selectDependent({
		origin:		'#municipio',
		selector:	'#parroquia_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});

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
	
	
	/*
	var selectYear = $("#anio");
	
	var yy = new Date(); // Año
	selectYear.append('<option value="">Seleccione...</option>');
	for (var i=0; i<70; i++) {
		selectYear.append('<option value="' + (yy.getFullYear()-i) + '">' + (yy.getFullYear()-i) + '</option>');
	}
	*/
	
		
// datepicker 
	
// maskedinput 
	// =============================================== dni ===========================================
	var select1 = $('#tipoPersona_id');
	$('#dni').attr('disabled', true);
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
	var a = $("#init div").length + 1;
	var b = $("#init div").length + 1;
		
	var maxPhones       = 2;	
	var addPhone        = $("#addPhone");	
	$('#phones div#clone').hide();
	
	$(addPhone).click(function(e){
		if(a <= maxPhones){
			
			var clone = $('#phones div#clone').clone(true);
			
			clone.attr('id','parent');
			
			$('.aux',clone).attr('value', a );
		    $('.tp_phone',clone).attr('name','tipo_'+a);
		    $('.num_phone',clone).attr('name','telf_'+a);
		    
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
			
			a++;
		}
		return false
	});
	
	var MaxPhones       = 2;	
	var addMail        	= $("#addMail");	
	$('#mail div#clone2').hide();
	
	$(addMail).click(function(e){
		if(b <= MaxPhones){
			
			var clone = $('#mail div#clone2').clone(true);
			
			clone.attr('id','parent');
			
			$('.aux2',clone).attr('value', b );
		    $('.email',clone).attr('name','mail_'+b);
		    
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
			$(this).parent('div').hide("1500", function(){ $(this).remove(); })
			a--;
		}else if( b > 1 ) {
			$(this).parent('div').hide("1500", function(){ $(this).remove(); })
			b--;
		}
			
		return false;
	});
	
	// Remove Select and Input Dinamic all ===================================================================
	
// End Section of Content dinamic
	
	var d = new Date();
	var today = d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear();
	
	$('#fecha_ini').val(today);
	$('.date').on("focus", "#fecha_ini", function() { 
		$(this).val(today);		
	});
	$('.date').on("focusout", "#fecha_ini", function() { 
		$(this).val(today);		
	});
	$('.date').on("keyup", "#fecha_ini", function() { 
		$(this).val(today);		
	});
	
	
	
// Validate
	
	var myForm = $('#adviser_contratos');
	
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
			tpPersona_id:		"required",			
			dni:{
				required: 		true,
				//remote: 		BASE_URL + "partners/remoteQuery", 
			},
			nombres:{
				required: 		true,
				minlength: 		2,
				maxlength: 		30,
				lettersonly: 	true,
			},
			apellidos:{
				required: 		true,
				minlength: 		2,
				maxlength: 		30,
				lettersonly: 	true,				
			},
			estado:				"required",
			municipio:			"required",
			parroquias_id:		"required",
			direccion:			"required",
			tipoTelf_id:		"required",
			num_Telf:			"required",
			marca:				"required",
			modelos_id:			"required",
			trans:				"required",
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
			clase:				"required",
			tpVehiculo:			"required",
			numero:				"required",//
			tpPago:				"required",
			cobertura:			"required",
			uso:				"required",
			carga:				"required",
		},
		messages: {
			tpPersona_id:		"Selección requerida",
			dni:{
				required: 		"Campo requerido",
				number: 		"Introduzca un número válido.",
				remote: 		"Cédula ya está registrada.",
			},
			nombres:{
				required: 		"Campo requerido",
				minlength: 		"Mínimo 2 carácteres",
				maxlength: 		"Máximo 30 carácteres",
				lettersonly: 	"Introduzca caracteres válidos.",
			},
			apellidos:{
				required:		"Campo requerido",
				minlength: 		"Mínimo 2 carácteres",
				maxlength: 		"Máximo 30 carácteres",
				lettersonly: 	"Introduzca caracteres válidos.",
			},
			estado:				"Selección requerida",
			municipio:			"Selección requerida",
			parroquias_id:		"Selección requerida",
			direccion: 			"Campo requerido",
			tipoTelf_id:		"Selección requerida",
			num_Telf:			"Campo requerido",
			marca:				"Selección requerida",
			modelos_id:			"Selección requerida",
			trans:				"Selección requerida",
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
			clase:				"Selección requerida",
			tpVehiculo:			"Selección requerida",
			numero:				"Selección requerida",//
			tpPago:				"Selección requerida",
			cobertura:			"Selección requerida",
			uso:				"Selección requerida",
			carga:				"Selección requerida",
		},
		submitHandler: function() {
			//$(location).attr('href', myForm.attr('action'));
			//location.reload();
			
			$.ajax({
	            url:	myForm.attr('action'),
	            type:	myForm.attr('method'),
	            data:	myForm.serialize(),
	            success: function(response) {
	                console.log(response);
	            }            
	        });
        },
		success: function(element) {
			element.remove();
			$('precio').attr('disabled', false);
			
		}
	});
	
	
});

	