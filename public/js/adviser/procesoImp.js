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
	
	function main(){
     
	}
		
	var BASE_URL = getBaseUrl();
	
	var contratoPDF = new PDFObject({ 
		url: BASE_URL+'report/contratoPdf',
		id: "viewerPDF",
		 width: "100%",
		 height: "298px"
	}).embed("pdf");
	
	$('#pdf').on("contextmenu",function(e){
        alert('No tiene Permisos para esta acción');
        return false;
    });
	
	$('#hideForm').hide();
	
	$('#viewerPDF').printPage({
    	url: 		BASE_URL+'report/contratoPdf',
		attr: 		'href',
		message:	'Espere mientras se crea el reporte'
    });
	
	$(document).on("click", "#printbtn", function() {
		
		bootbox.confirm("¿Todos los datos esta correctos en la vista previa de impresión?", function(result) {
			if (result == true) {
				$.post(		
					BASE_URL+'adviser/createVariableSession', 
					{ printbtn: true }, 
					function(data){
						if (data != true) {
							alert(data);
						}
					}, "json"
				);
				
				$('#printbtn').attr('disabled', true);
				$('#hideForm').delay(7000).show('slow');
				
				$('#viewerPDF').click().printPage({
			    	url: 		BASE_URL+'report/contratoPdf',
					attr: 		'href',
					message:	'Espere mientras se crea el reporte'
			    });
			}
		}); 
    });
	
	$('#disableSelect').on("contextmenu",function(e){
		 alert('No tiene Permisos para esta acción');
	     return false;
	});
	
//click Derecho:

	
	
	
// Section of Content Select
	
	// Load Select for Data Base =======================================================================================
		
	
	
// Validate
	
	var myForm = $('#adviser_procesoImp');
	
	myForm.submit (function() { 

		
		var isChecked = jQuery("input[name=resulImp]:checked").val();
	    var booleanVlaueIsChecked = false;
	    
	    if(isChecked){
	          booleanVlaueIsChecked = true;
	    }
	    
		if(booleanVlaueIsChecked){
	    	$.ajax({
	            type:	myForm.attr('method'),
	            data:	myForm.serialize(),
				url:	myForm.attr('action'),
		        async: 	false,
	            success: function(data) {
	            	if (data == true) {
	            		$(location).attr('href', BASE_URL+'adviser/');
					}else{
						alert(data);
					}
	            	//console.log(data);
	            	//location.reload();
	            	
	            }            
	        });
	    	
	    }else {
			alert('Debe selecionar una opción!');
		};
		
		return false;
			
	});
	
});

	