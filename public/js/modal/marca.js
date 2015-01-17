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
	
	var form1 = $("#modal_marca");	

	strToUpper('#marca');
	
	//parent.jQuery.fancybox.close();
	$('#cancel').click(function() {
		parent.jQuery.fancybox.close();
	});
	
// Validate
		
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
	
	form1.validate({
		rules:{			
			marca:{
				required: 		true,
			}
		},
		messages: {
			marca:{
				required: 		"Campo requerido",
			}
		},
		submitHandler: function() {
			$.ajax({
	            url:	form1.attr('action'),
	            type:	form1.attr('method'),
	            data:	form1.serialize(),
	            success: function(response) {
	                if (response == true) {
	                	parent.jQuery.fancybox.close();
					}else {
						alert(response);
					}
	            }            
	        });
        },
		success: function(element) {
			element.remove();
			$('precio').attr('disabled', false);
			
		}
	});
	
	
});