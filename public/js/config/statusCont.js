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
	var title 	= 'null';
	
	if(parameters.name){
		var name = parameters.name;
	}else {
		var name = element.attr('name');
	}
	
	if(element.attr('title')){
		title = element.attr('title');
	}
	
	$.post(		
 		url, 
		{ type: name }, 
		function(data){
			element.empty();
			element.append('<option value="">Seleccione...</option>');
			for (var i=0; i<data.length; i++) {
				if ( title == data[i].id ) {
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
	
	var origin 		= $( parameters.origin );
	var idOrigin 	= parameters.origin;
	var element 	= $( parameters.selector );
	var url			= parameters.url;
	var type		= $( parameters.selector ).attr('name');

	element.append('<option value="">Seleccione...</option>');
	
	$( origin ).change(function () {
        
		$(idOrigin+' option:selected').each(function () {
			
     		selected = $(this).val();
     		var select = $(element);
         	$.post(
         		url, 
     			{ type: type, id: selected }, 
     			function(data){
     				select.empty();
					select.append('<option value="">Seleccione...</option>');
     				for (var i=0; i<data.length; i++) {
						select.append('<option value="' + data[i].id + '">' + data[i].option + '</option>');
					}
     			}, "json");            
     	});
	});
	
}

function openFancyBox( parameters ) {
	
	var element = parameters.button
	var url = parameters.url
	
	$(element).click(function() {
		$.fancybox.open({
			href : url,
			type : 'iframe',
			//autoSize: false,
	        //width: 1024,
	        //height: 490,
			afterClose : function(){
				
   			}
		});
	});
}

//=================================================================================================================================

$(document).ready(function() {
	
	var BASE_URL = getBaseUrl();
	
	
//strToUpper
	strToUpper2('#statusCont');
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
		
	loadSelect({
		selector:	'#tpPersona_id', 
		url:		BASE_URL + "select/loadSelect/"
	});

	selectDependent({ 
		origin:		'#estado', 
		selector:	'#municipio', 
		url:		BASE_URL+"select/loadSelectDepent/"
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
		$('.data').val($(this).attr('name'));
		$('#cancel').show('slow');
		//$(this).mask("(9999) 999-99-99");
	});
	
	$(document).on("click", "#cancel", function() { 
		//alert($(this).attr('id'));
		$('#tpAction').attr('value','0');
		$('.data').val('');
		$(this).hide('slow');
		//$(this).mask("(9999) 999-99-99");
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
	
	var myForm = $('#config_statusCont');
	
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
			statusCont:{
				required: 		true,
				lettersonly:	true, 
			}
		},
		messages: {
			statusCont:{
				required: 		"Campo requerido",
				lettersonly: 	"Caracteres inválidos",
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

	