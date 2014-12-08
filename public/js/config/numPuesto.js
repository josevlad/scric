function getBaseUrl(){
	var url = $(location).attr('href').split("/").splice(0, 4).join("/")+'/';
	return url;
}

function strToUpper(field){
	$(field).focusout(function(event){
		$(this).val($(this).val().toUpperCase());
	});
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
		}, 
		"json"
	); 
	
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
	strToUpper2('.keyup');
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
		
	loadSelect({
		selector:	'#cv_1', 
		url:		BASE_URL + "select/loadSelect/"
	});

	selectDependent({ 
		origin:		'#cv_1', 
		selector:	'#id_1', 
		url:		BASE_URL+"select/loadSelectDepent/"
	});
	
	loadSelect({
		selector:	'#selectClone1', 
		url:		BASE_URL + "select/loadSelect/"
	});
	
	$(document).on({
	    
	    change: function(){
	    	
	    	var element = $( $(this).attr('dest') );
	    	var table = element.attr('table');
	    	var idOrigin 	=	$(this).attr('id');
	    	
	    	$('#'+idOrigin+' option:selected').each(function(){
				var id = $(this).val();
				$.post(		
					BASE_URL+"select/loadSelectDepent/", 
			 		{ table: table, id: id }, 
					function(data){
						element.empty();
						element.append('<option value="">Seleccione...</option>');
						for (var i=0; i<data.length; i++) {
							element.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
						}
					}, "json");
			})
    	}
	
	}, ".origin" );



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
			selector:	'#tipoVehiculo_id', 
			url:		BASE_URL + "select/loadSelectDepent",
			id:			$(this).attr('select1'),
			choose:		$(this).attr('select2'),
			table:		'tipoVehiculo'
			
		})
		
		$('.data').val($(this).attr('inputText'));
		$('#cancel').show('slow');
		$('#add').hide('slow');
		//$(this).mask("(9999) 999-99-99");
	});
	
	$(document).on("click", "#cancel", function() { 
		//alert($(this).attr('id'));
		$('#tpAction').attr('value','0');
		
		loadSelect({
			selector:	'#claseVehiculo', 
			url:		BASE_URL + "select/loadSelect/",
		});
		
		$('#tipoVehiculo_id').empty();
		$('#tipoVehiculo_id').append('<option value="">Seleccione...</option>');
		
		$('.data').val('');
		$(this).hide('slow');
		$('#add').show('slow');
		//$(this).mask("(9999) 999-99-99");
	});

//dinamic
	
		
	$('#dynamicContent div#clone').hide();
	
	var a = $("#init div").length + 1;
	var b = $("#init div").length + 1;
	var max1       = 15;	
	var add        = $("#add");
	
	$(add).click(function(e){
		if(a <= max1){
			//alert(a);
			var clone = $('#dynamicContent div#clone').clone(true);
			
			clone.attr('id','parent');
			
			$('.origin',clone).attr('dest','#id_'+(a+1));
			
			$('.origin',clone).attr('name','cv_'+(a+1));
			$('.origin',clone).attr('id','cv_'+(a+1));
			
			$('.dependence',clone).attr('name','id_'+(a+1));
			$('.dependence',clone).attr('id','id_'+(a+1));
			$('.dependence',clone).append('<option value="">Seleccione...</option>');
			
		    $('.text',clone).attr('name','np_'+(a+1));
		    $('.text',clone).attr('id','np_'+(a+1));

			$('#aux').attr('value',	a+1);
		    
		    $(clone).appendTo('#dynamicContent').show('1500');
			
			$('.origin',clone).rules('add',{
				required: 		true, 
				messages:{
					required: 		"Selección requerido",
				}
			});
			
			$('.dependence',clone).rules('add',{
				required: 		true, 
				messages:{
					required: 		"Selección requerido",
				}
			});
		   
			$('.text',clone).rules('add',{
				required: 		true,
				digits:			true,  
				messages:{
					required: 		"Campo requerido",
					digits: 		"Numero inválido",
				}
			});
			
			a++;
		}
		return false
	});

//remove
	
	$("body").on("click",".delete", function(e){
		
		if( a > 1 ) {
			$(this).parent('div').hide("1500", function(){ $(this).remove(); });
			$('#aux').attr('value',	$('#aux').attr('value')-1);
			a--;
		}
			
		return false;
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
	
	
	
	var myForm = $('#config_numPuesto');
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'div',
		validClass: "success"
	})
	
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\+\-\(\)\.\s]+$/i.test(value);
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
			np_1:{
				required: 		true,
				lettersonly:	true, 
			}
		},
		messages: {
			np_1:{
				required: 		"Campo requerido",
				lettersonly: 	"Caracteres inválido",
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
	            	//console.log(data)
	            	location.reload();
	            }            
	        });
			
			
			
        },
		success: function(element) {
			element.remove();
			
		}
	});
	
	$('.se').rules('add',{
		required: 		true, 
		messages:{
			required: 		"Selección requerido",
		}
	});
	
	$('.se2').rules('add',{
		required: 		true, 
		messages:{
			required: 		"Selección requerido",
		}
	});
	
	
});

	