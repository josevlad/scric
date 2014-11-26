function getBaseUrl(){
	var url = $(location).attr('href').split("/").splice(0, 4).join("/")+'/';
	return url;
}

function strToUpper(field){
	$(field).focusout(function(event){
		$(this).val($(this).val().toUpperCase());
	});
}

function loadSelect( element, url){
	
	var name = element.attr('name');
	
	$.post(
 		url, 
		{ type: name }, 
		function(data){
			element.empty();
			element.append('<option value="">Seleccione...</option>');
			for (var i=0; i<data.length; i++) {
				element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
			}
		}, 
		"json"
	); 
	
}

function loadSelectUpdate( element, url){
	
	var name = element.attr('name');
	
	$.post(
 		url, 
		{ type: name }, 
		function(data){
			element.empty();
			element.append('<option value="">Seleccione...</option>');
			for (var i=0; i<data.length; i++) {
				if (element.attr('id-data') == data[i].value) {
					element.append('<option selected value="' + data[i].id + '">' + data[i].option + '</option>');
				}else {
					element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
				}
			}
		}, 
		"json"
	); 
	
}

function selectDependent( origin, element, url){
	
	var idOrigin = '#'+origin.attr('id');	
	var name = origin.attr('name');
	
	$( origin ).change(function () {
        
		$(idOrigin+' option:selected').each(function () {
     		selected = $(this).val();
     		var select = $(element);
     		
         	$.post(
         		url, 
     			{ name: name, id: selected }, 
     			function(data){
     				alert(data);
     				select.empty();
					select.append('<option value="">Seleccione...</option>');
     				for (var i=0; i<data.length; i++) {
						select.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
					}
     			}, "json");            
     	});
	});
	
}

//=================================================================================================================================

$(document).ready(function() {
	
	var BASE_URL = getBaseUrl();
	//var BASE_URL = "http://beta.taxi.com/"
	
//strToUpper
	strToUpper('#dni');
	strToUpper('#nombres');
	strToUpper('#apellidos');
	strToUpper('#');
	strToUpper('#');
	strToUpper('#');
	strToUpper('#');
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
	
	var select1 = $("#tpPersona_id");
	var select2 = $("#estado");
	var select3 = $("#municipio");
	var select4 = $("#parroquias_id");
	var select5 = $("#tipoTelf_id");
	var select6 = $("#tipoTelf"); //clone
	var select7 = $("#marca");
	var select8 = $("#modelos_id");
	var select9 = $("#anio");
	var select10 = $("#clase");
	var select11 = $("#tpVehiculo");
	var select12 = $("#numero");
	var select13 = $("#");
	var select14 = $("#");
	var select15 = $("#");
	var select16 = $("#");
	
	
	loadSelect(
		select1, 
		BASE_URL + "select/loadSelect/"
	);

	loadSelect(
		select2, 
		BASE_URL + "select/loadSelect/"
	);
	
	selectDependent(
		select2, 
		select3, 
		BASE_URL+"select/loadSelectDepent/"
	);
	
	selectDependent(
		select3, 
		select4, 
		BASE_URL+"select/loadSelectDepent/"
	);

	loadSelect(
		select5, 
		BASE_URL + "select/loadSelect/"
	);

	loadSelect(
		select6, 
		BASE_URL + "select/loadSelect/"
	);

	loadSelect(
		select5, 
		BASE_URL + "select/loadSelect/"
	);

	loadSelect(
		select7, 
		BASE_URL + "select/loadSelect/"
	);
	
	selectDependent(
		select7, 
		select8, 
		BASE_URL+"select/loadSelectDepent"
	);
	
	var yy = new Date();
	select9.append('<option value="">Seleccione...</option>');
	for (var i=0; i<40; i++) {
		select9.append('<option value="' + (yy.getFullYear()-i) + '">' + (yy.getFullYear()-i) + '</option>');
	}
	
	loadSelect(
		select11, 
		BASE_URL + "select/loadSelect/"
	);
	
	selectDependent(
		select11, 
		select12, 
		BASE_URL+"select/loadSelectDepent"
	);
	
	selectDependent(
		select12, 
		select13, 
		BASE_URL+"select/loadSelectDepent"
	);
	
	

// End Section of Content Select
	
// maskedinput 
	// =============================================== dni ===========================================
	
	$('#dni').attr('disabled', true);
	
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
			$('#dni').attr('placeholder', '');
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
	
	var maxPhones       = 2;	
	var addPhone        = $("#addPhone");	
	var $clone = $('#phones div#clone').hide();
	
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
	var $clone = $('#mail div#clone2').hide();
	
	$(addMail).click(function(e){
		if(b <= MaxPhones){
			
			var clone = $('#mail div#clone2').clone(true);
			
			clone.attr('id','parent');
			
			$('.aux',clone).attr('value', a );
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
	
	var a = $("#contenedor div").length + 1;
	var b = $("#contenedor div").length + 1;
	
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
	
// datepicker bootstrap
	
	$('.dp').datepicker({
		language: 'es'
	});
	
	
// Validate
	
	var form = $('#contracts_newContract');
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'div'		
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
	
	form.validate({
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
			direccion:{
				required: 		true,
				lettersonly: 	true,				
			},
			tipoTelf_id:		"required",
			num_Telf:			"required",
			marca:				"required",
			modelos_id:			"required",
			trans:				"required",
			anio:				"required",
			color:				"required",
			placa:{
				required: 		true,
				remote: 		BASE_URL + "partners/remoteQuery",
				serial: 		true,
			},
			serial_c:{
				required: 		true,
				remote: 		BASE_URL + "partners/remoteQuery", 
				serial: 		true,
			},
			serial_m:{
				required: 		true,
				remote: 		BASE_URL + "partners/remoteQuery", 
				serial: 		true,
			},
			clase:				"required",
			tpVehiculo:			"required",
			numero:				"required",
			
			
			
			foto_s:				"required",
			img_dni:			"required",
			n_socio:{
				required: 		true,
				number: 		true,
				remote: 		BASE_URL + "partners/remoteQuery",
			},
			fecha_ldc:			"required",
			fecha_cds:			"required",
			fecha_rcv:			"required",
			img_carro:			"required",
			
			
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
			direccion:{
				required: 		"Campo requerido",
				lettersonly: 	"Introduzca carácteres válidos.",				
			},
			tipoTelf_id:		"Selección requerida",
			num_Telf:			"Campo requerido",
			marca:				"Selección requerida",
			modelos_id:			"Selección requerida",
			trans:				"Selección requerida",
			anio:				"Selección requerida",
			color:				"Campo requerido",
			placa:{
				required: 		"Campo requerido",
				remote: 		"Placa ya registrada.",
				serial: 		"Introduzca un serial válido.",
			},
			serial_c:{
				required: 		"Campo requerido",
				remote: 		"Serial ya registrado.",
				serial: 		"Introduzca un serial válido.",
			},
			serial_m:{
				required: 		"Campo requerido",
				remote: 		"Serial ya registrado.",
				serial: 		"Introduzca un serial válido.",
			},
			clase:				"Selección requerida",
			tpVehiculo:			"Selección requerida",
			numero:				"Selección requerida",
			
			
			
			
			foto_s:				".",
			img_dni:			".",
			n_socio:{
				required: 		"Campo requerido",
				number: 		"Introduzca un número válido.",
				remote: 		"N° de socio ya registrado.",
			},
			fecha_ldc:			"Campo requerido",
			fecha_cds:			"Campo requerido",
			fecha_rcv:			"Campo requerido",
			img_carro:			".",			
			
		},
		success: function(element) {
			element.remove();
		}
	});
	
});

	