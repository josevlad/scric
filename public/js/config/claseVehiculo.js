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

//=================================================================================================================================

$(document).ready(function() {
	
	var BASE_URL = getBaseUrl();
	
	
//strToUpper
	strToUpper2('#claseVehiculo');

//update	
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
	
	var myForm = $('#config_newTipoPers');
	
	$.validator.setDefaults({
		errorClass: 'form_error',
		errorElement: 'div',
		validClass: "success"
	})
	
	
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[0-9a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ\-\+\(\)\.\s]+$/i.test(value);
	}, "Letters only please"); 
	
	myForm.validate({
		rules:{		
			claseVehiculo:{
				required: 		true,
				lettersonly:	true,
			}
		},
		messages: {
			claseVehiculo:{
				required: 		"Campo requerido",
				lettersonly:	"Caracteres inválidos",
			},
			
		},
		submitHandler: function() {
			
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

	