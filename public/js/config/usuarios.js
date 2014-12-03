function getBaseUrl(){
	var url = $(location).attr('href').split("/").splice(0, 4).join("/")+'/';
	return url;
}

function strToUpper2(field){
	$(field).keyup(function(event){
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
	
	strToUpper2('#nombre');	
	strToUpper2('#apellido');	
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
		
	loadSelect({
		selector:	'#perfilUsuario_id', 
		url:		BASE_URL + "select/loadSelect"
	});	
	
	loadSelect({
		selector:	'#agencias_id', 
		url:		BASE_URL + "select/loadSelect"
	});	

	loadSelect({
		selector:	'#pregunta_id', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	loadSelect({
		selector:	'#statusUsuarios_id', 
		url:		BASE_URL + "select/loadSelect/",
	});
	
	
// End Section of Content Select
	/*
	openFancyBox({
		button:		'.update',
		url:		BASE_URL + "index/index",	
	})
	*/
	
	$('#cancel').hide();
	
	$(document).on("click", ".update", function() { 
		//alert($(this).attr('id'));
		$('#tpAction').attr('value',$(this).attr('id'));
		
		$.post(
			$(this).attr('url'),
			{ id: $(this).attr('id') },
			function (data) {
				
				$('#nick').val(data['nick']);
				$('#clave').val(data['clave']);
				$('#clave_eq').val(data['clave']);
				$('#nombre').val(data['nombre']);
				$('#apellido').val(data['apellido']);
				$('#statusUsuarios_id').attr('disabled',false);
				$('#respuesta').val(data['respuesta']);
				
				$('#nick').attr('disabled',true);
				$('#clave').attr('disabled',true);
				$('#clave_eq').attr('disabled',true);
				$('#respuesta').attr('disabled',true);
				
				loadSelect({
					selector:	'#agencias_id', 
					url:		BASE_URL + "select/loadSelect/",
					choose:		data['agencias_id']
				});
				
				loadSelect({
					selector:	'#perfilUsuario_id', 
					url:		BASE_URL + "select/loadSelect/",
					choose:		data['perfilUsuario_id']
				});

				loadSelect({
					selector:	'#pregunta_id', 
					url:		BASE_URL + "select/loadSelect/",
					choose:		data['pregunta_id']
				});
				
				loadSelect({
					selector:	'#statusUsuarios_id', 
					url:		BASE_URL + "select/loadSelect/",
					choose:		data['statusUsuarios_id']
				});
				

				$('#pregunta_id').attr('disabled',true);

				
			},"json"
		);
		
		$('#cancel').show('slow');
		//$(this).mask("(9999) 999-99-99");
	});
	
	$(document).on("click", "#cancel", function() { 
		//alert($(this).attr('id'));
		$('#tpAction').attr('value','0');

		$('#pregunta_id').attr('disabled',false);
		
		loadSelect({
			selector:	'#agencias_id', 
			url:		BASE_URL + "select/loadSelect/",
		});
		loadSelect({
			selector:	'#perfilUsuario_id', 
			url:		BASE_URL + "select/loadSelect/",
		});
		loadSelect({
			selector:	'#pregunta_id', 
			url:		BASE_URL + "select/loadSelect/",
		});
		
		$('#nick').val('');
		$('#clave').val('');
		$('#clave_eq').val('');
		$('#nombre').val('');
		$('#apellido').val('');
		$('#respuesta').val('');
		$('#statusUsuarios_id').empty();
		$('#statusUsuarios_id').attr('disabled',true);
		$(this).hide('slow');
		

		$('#nick').attr('disabled',false);
		$('#clave').attr('disabled',false);
		$('#clave_eq').attr('disabled',false);
		$('#respuesta').attr('disabled',false);
	});

	
// datatable
	
	$('#tbTipoPers').DataTable({
	    "language": {
	        "sProcessing":    "Procesando...",
	        "sLengthMenu":    " _MENU_ ",
	        "sZeroRecords":   "No se encontraron resultados",
	        "sEmptyTable":    "Ningún dato disponible en esta tabla",
	        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
	        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
	        "sInfoPostFix":   "",
	        "sSearch":        "",
	        "sUrl":           "",
	        "sInfoThousands":  ",",
	        "sLoadingRecords": "Cargando...",
	        "oPaginate": {
	            "sFirst":    "Primero",
	            "sLast":    "Último",
	            "sNext":    "Siguiente",
	            "sPrevious": "Anterior"
	        },
	        "oAria": {
	            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	        }
	    },
	    'info': false,
	    "bAutoWidth": false, // Disable the auto width calculation 
	    //"aoColumns": [
	      //{ "sWidth": "5%" }, 	//cedula 
	      //{ "sWidth": "20%" },  //Nombre
	      //{ "sWidth": "20%" },  //Apellidos
	      //{ "sWidth": "13%" },  //N socio
	      //{ "sWidth": "10%" },  //LDC
	      //{ "sWidth": "10%" },  //CDS
	      //{ "sWidth": "10%" },  //RCV
	      //{ "sWidth": "1%" }   //Acciones
	    //]

        
	});

	$('input[type=search]').attr('placeholder','Buscar');
	
// Validate
	
	var myForm = $('#config_usuarios');
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'div',
		validClass: "success"
	})
	
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\(\)\.\s]+$/i.test(value);
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
			nick:{
				required: 		true,
				//lettersonly:	true,
				remote: 		BASE_URL + "config/remote",   
			},
			clave:{				
				required:		true,
				equalTo:		'#clave_eq'
			},
			clave_eq:{		
				required:		true,
				equalTo:		'#clave'
			},
			nombre:{
				required: 		true,
				lettersonly:	true,
			},
			apellido:{
				required: 		true,
				lettersonly:	true,
			},
			perfilUsuario_id:		"required",
			agencias_id:		"required",
			pregunta_id:		"required",
			respuesta:{
				required: 		true,
				//lettersonly:	true,
			},
			statusUsuarios_id:	"required",
		},
		messages: {
			nick:{
				required: 		'Campo requerido',
				//lettersonly:	true,
				remote: 		'Nick Existente',  
			},
			clave:{				
				required:		'Campo requerido',
				equalTo:		'Clave no coinciden'
			},
			clave_eq:{		
				required:		'Campo requerido',
				equalTo:		'Clave no coinciden'
			},
			nombre:{
				required: 		'Campo requerido',
				lettersonly:	'',
			},
			apellido:{
				required: 		'Campo requerido',
				lettersonly:	'Caracteres inválidos',
			},
			perfilUsuario_id:	'Selección requerida',
			agencias_id:		'Selección requerida',
			pregunta_id:		'Selección requerida',
			respuesta:{
				required: 		'Campo requerido',
				//lettersonly:	true,
			},
			statusUsuarios_id:	"Selección requerida",
			
		},
		submitHandler: function() {
			//$(location).attr('href', myForm.attr('action'));
			//location.reload();
			
			$.ajax({
	            type:	myForm.attr('method'),
	            data:	myForm.serialize(),
				url:	myForm.attr('action'),
		        async: 	false,
	            success: function(data) {
	            	if (data == true) {
	            		location.reload();
	    			}else {
	    				alert(data);
	    			}
	            }            
	        });
			
        },
		success: function(element) {
			element.remove();
			
		}
	});

	
});

	