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
		
		bootbox.confirm('<h4 class="bootbox-text">¿Todos los datos están correctos en la vista previa de impresión?<h4>', function(result) {
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
				$('#editarContrac').attr('disabled', true);
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
	
	var myForm = $('#adviser_procesoImp2');
	
	myForm.submit (function() { 

		
		var isChecked = jQuery("input[name=resulImp]:checked").val();
	    var booleanVlaueIsChecked = false;
	    
	    if(isChecked){
	          booleanVlaueIsChecked = true;
	    }
	    
		if(booleanVlaueIsChecked){
	    	//alert(isChecked);
	    	
	    	switch (isChecked) {
				case '1':
					$.ajax({
			            type:	myForm.attr('method'),
			            data:	myForm.serialize(),
						url:	myForm.attr('action'),
				        async: 	false,
			            success: function(res) {
			            				            	
			            	if (res == 1) {
			            		$(location).attr('href', BASE_URL + 'adviser/impFact');
							}else if (res == 2) {
								$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
							}else if (res == 3) {
			            		$(location).attr('href', BASE_URL + 'adviser/');
							}else if (res == 4) {
			            		$(location).attr('href', BASE_URL + 'adviser/');
							}else if (res == 5) {
			            		$(location).attr('href', BASE_URL + 'adviser/');
							}else{
								alert(res);
							}
			            }            
			        });
				break;
				case '2':
					bootbox.confirm(
							'<div class="alert alert-dark bootbox-text">'+
								'<strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> tome en cuenta lo siguente:'+
							'</div>'+
							'<p class="text-warning"><strong>1.- </strong> El contrato actual pasará a estatus "ERROR".</p>'+
							'<p class="text-warning"><strong>2.- </strong> Se creará Otro con un nuevo número de contrato y se le asignará una nueva planilla.</p>'+
							'<p class="text-warning"><strong>3.- </strong> El contrato actual no podrá ser utilizado de nuevo.</p>'+
							'<p class="text-warning bootbox-text">¿Desea Continuar con la reaccionación?</p>',
						function(result) {
						if (result == true) {
							$.ajax({
					            type:	myForm.attr('method'),
					            data:	myForm.serialize(),
								url:	myForm.attr('action'),
						        async: 	false,
					            success: function(res) {
					            					            	
					            	if (res == 1) {
					            		$(location).attr('href', BASE_URL + 'adviser/impFact');
									}else if (res == 2) {
										$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else if (res == 3) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else if (res == 4) {
					            		$(location).attr('href', BASE_URL + 'adviser/');
									}else if (res == 5) {
					            		$(location).attr('href', BASE_URL + 'adviser/');
									}else{
										alert(res);
									}
					            }            
					        });
						}
					}); 
				break;
				case '3':
					bootbox.confirm(
							'<div class="alert alert-dark bootbox-text">'+
								'<strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> tome en cuenta lo siguente:'+
							'</div>'+
							'<p class="text-warning"><strong>1.- </strong> El contrato actual pasará a estatus "ERROR".</p>'+
							'<p class="text-warning"><strong>2.- </strong> Se creará Otro con un nuevo número de contrato y se le asignará una nueva planilla.</p>'+
							'<p class="text-warning"><strong>3.- </strong> El contrato actual no podrá ser utilizado de nuevo.</p>'+
							'<p class="text-warning bootbox-text">¿Desea Continuar hacia la edición de datos?</p>',
						function(result) {
						if (result == true) {
							$.ajax({
					            type:	myForm.attr('method'),
					            data:	myForm.serialize(),
								url:	myForm.attr('action'),
						        async: 	false,
					            success: function(res) {
					            	
					            	if (res == 1) {
					            		$(location).attr('href', BASE_URL + 'adviser/impFact');
									}else if (res == 2) {
										$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else if (res == 3) {
					            		$(location).attr('href', BASE_URL + 'adviser/editarAsoc2');
									}else if (res == 4) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else if (res == 5) {
					            		$(location).attr('href', BASE_URL + 'adviser/');
									}else{
										alert(res);
									}
					            	
					            }            
					        });
						}
					}); 
				break;
				case '4':
					bootbox.confirm(
							'<div class="alert alert-dark bootbox-text">'+
								'<strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> tome en cuenta lo siguente antes de continuar:'+
							'</div>'+
							'<p class="text-warning"><strong>1.- </strong> Verifique que la impresora esté bien conectada (corriente y pc).</p>'+
							'<p class="text-warning"><strong>2.- </strong> Que no exista cola de impresión la impresora usada.</p>'+
							'<p class="text-warning"><strong>3.- </strong> Solo tendrá 2 oportunidades mas de imprimir este contrato.</p>'+
							'<p class="text-warning"><strong>3.- </strong> De ser necesario, pruebe una impresión con otro programa.</p>'+
							'<p class="text-warning bootbox-text">¿Desea Continuar?</p>',
						function(result) {
						if (result == true) {
							$.ajax({
					            type:	myForm.attr('method'),
					            data:	myForm.serialize(),
								url:	myForm.attr('action'),
						        async: 	false,
					            success: function(res) {
					            	
					            	if (res == 1) {
					            		$(location).attr('href', BASE_URL + 'adviser/impFact');
									}else if (res == 2) {
										$(location).attr('href', BASE_URL + 'adviser/procesoImp');
									}else if (res == 3) {
					            		$(location).attr('href', BASE_URL + 'adviser/editContrato');
									}else if (res == 4) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else if (res == 5) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp');
									}else{
										alert(res);
									}
					            }            
					        });
						}
					}); 
				break;
				case '5':
					bootbox.confirm(
							'<div class="alert alert-dark bootbox-text">'+
								'<strong><i class="fa fa-exclamation-triangle"></i> ¡Precaución!</strong> tome en cuenta lo siguente antes de continuar:'+
							'</div>'+
							'<p class="text-warning"><strong>1.- </strong> Verifique que la impresora esté bien conectada (corriente y pc).</p>'+
							'<p class="text-warning"><strong>2.- </strong> Que no exista cola de impresión la impresora usada.</p>'+
							'<p class="text-warning"><strong>3.- </strong> Solo tendrá 2 oportunidades mas de imprimir este contrato.</p>'+
							'<p class="text-warning"><strong>3.- </strong> De ser necesario, pruebe una impresión con otro programa.</p>'+
							'<p class="text-warning bootbox-text">¿Desea Continuar?</p>',
						function(result) {
						if (result == true) {
							$.ajax({
					            type:	myForm.attr('method'),
					            data:	myForm.serialize(),
								url:	myForm.attr('action'),
						        async: 	false,
					            success: function(res) {
					            	
					            	if (res == 1) {
					            		$(location).attr('href', BASE_URL + 'adviser/');
									}else if (res == 2) {
										$(location).attr('href', BASE_URL + 'adviser/procesoImp');
									}else if (res == 3) {
					            		$(location).attr('href', BASE_URL + 'adviser/editContrato');
									}else if (res == 4) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp');
									}else if (res == 5) {
					            		$(location).attr('href', BASE_URL + 'adviser/procesoImp2');
									}else{
										alert(res);
									}
					            }            
					        });
						}
					}); 
				break;
	
			}
	    	
	    }else {
			alert('Debe selecionar una opción!');
		};
		
		return false;
			
	});
	
});

	