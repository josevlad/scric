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
	
	strToUpper2('#precio');
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
		
	loadSelect({
		selector:	'#claseVehiculo', 
		url:		BASE_URL + "select/loadSelect"
	});
	
	selectDependent({
		origin:		'#claseVehiculo',
		selector:	'#cobertura_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	selectDependent({
		origin:		'#claseVehiculo',
		selector:	'#tipoVehiculo', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	

	selectDependent({
		origin:		'#tipoVehiculo',
		selector:	'#numPuesto_id', 
		url:		BASE_URL + "select/loadSelectDepent"
	});
	
	$('#claseVehiculo').change(function(){
		$('#numPuesto_id').empty();
		$('#numPuesto_id').append('<option value="">Seleccione...</option>');
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
		
		loadSelect({
			selector:	'#claseVehiculo', 
			url:		BASE_URL + "select/loadSelect/",
			choose:		$(this).attr('select1')
		});
		
		selectOptionDependent({
			selector:	'#tipoVehiculo', 
			url:		BASE_URL + "select/loadSelectDepent",
			id:			$(this).attr('select1'),
			choose:		$(this).attr('select2'),
			table:		'tipoVehiculo'
			
		})
		
		selectOptionDependent({
			selector:	'#numPuesto_id', 
			url:		BASE_URL + "select/loadSelectDepent",
			id:			$(this).attr('select2'),
			choose:		$(this).attr('select3'),
			table:		'numPuesto'
			
		})
		
		selectOptionDependent({
			selector:	'#cobertura_id', 
			url:		BASE_URL + "select/loadSelectDepent",
			id:			$(this).attr('select1'),
			choose:		$(this).attr('select4'),
			table:		'cobertura'
			
		})
		
		$('.data').val($(this).attr('inputText'));
		$('#cancel').show('slow');
		//$(this).mask("(9999) 999-99-99");
	});
	
	$(document).on("click", "#cancel", function() { 
		//alert($(this).attr('id'));
		$('#tpAction').attr('value','0');
		
		loadSelect({
			selector:	'#claseVehiculo', 
			url:		BASE_URL + "select/loadSelect/",
		});
				
		$('#tipoVehiculo').empty();
		$('#tipoVehiculo').append('<option value="">Seleccione...</option>');
		
		$('#numPuesto_id').empty();
		$('#numPuesto_id').append('<option value="">Seleccione...</option>');
		
		$('#cobertura_id').empty();
		$('#cobertura_id').append('<option value="">Seleccione...</option>');
		
		$('.data').val('');
		$(this).hide('slow');
		//$(this).mask("(9999) 999-99-99");
	});

	
// datatable
	
	$('#np').DataTable({
		"bSort": false,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
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
	
//check
	$(document).on("click", "#all", function() { 
		if(this.checked){
			$('.check').prop('checked', true);
		}else {
			$('.check').prop('checked', false);
		}
	})
	

	$('input[type=search]').attr('placeholder','Buscar');
	
// Validate
	
	var myForm = $('#config_asignarConcepto');
	
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
			gastosMedicos1:{
				required: 		true,
				digits:			true, 
			},
			invalidez1:{
				required: 		true,
				digits:			true, 
			},
			muerte1:{
				required: 		true,
				digits:			true, 
			},
			gastosMedicos2:{
				required: 		true,
				digits:			true, 
			},
			invalidez2:{
				required: 		true,
				digits:			true, 
			},
			muerte2:{
				required: 		true,
				digits:			true, 
			},
			daniosPropiedad:{
				required: 		true,
				digits:			true, 
			},
			grua:{
				required: 		true,
				digits:			true, 
			},
			estacionamiento:{
				required: 		true,
				digits:			true, 
			},
			indemnizacionSem:{
				required: 		true,
				digits:			true, 
			},
			asistenciaLegal:{
				required: 		true,
				digits:			true, 
			},
		},
		messages: {
			gastosMedicos1:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			invalidez1:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			muerte1:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			gastosMedicos2:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			invalidez2:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			muerte2:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			daniosPropiedad:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			grua:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			estacionamiento:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			indemnizacionSem:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			asistenciaLegal:{
				required: 		"Campo requerido",
				digits:	 		"Monto inválido",
			},
			
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
	            	//console.log(data);
	            	//location.reload();
	            	
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

	