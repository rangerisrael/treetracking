
$(document).ready(function(){
//$('#switcher').themeswitcher();
$("#container").hide();

$('#clickform').click(function(){
	$('#container').attr('title','Registration Process').dialog({width: 550, closeOnEscape: false, draggable: false, resizable: false, show:'fadeIn', modal:true});
});

	//global vars
	var form = $("#customForm");
	var name = $("#name");
	var nameInfo = $("#nameInfo");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var pass1 = $("#pass1");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2");
	var pass2Info = $("#pass2Info");
	var state = false;


	//validation functions
		function validateName(){
		//if it's NOT valid
		if(name.val().length <= 4){
			name.removeClass("valid");
			nameInfo.removeClass("valid");
			name.addClass("error");
			nameInfo.addClass("error");
			nameInfo.text("We want names with more than 4 letters!");
			state = false;
		}else{
		if(name.val().length > 4){
				var uname=name.val();
				$.post('validation.php', {names:uname}, function(data){
				if(data!=0){
					name.removeClass('valid');
					nameInfo.removeClass('valid');
					name.addClass("error");
					nameInfo.addClass("error");
					nameInfo.text("This name is already registered!");
					state = false;
				}else{
					name.removeClass('error');
					nameInfo.removeClass('error');
					name.addClass("valid");
					nameInfo.addClass("valid");
					nameInfo.text("Name available");
					state = true;
				}
				});		
		}
		
	}
	return state;
	}
	
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		var uemail = email.val();
		//if it's valid email
		if(filter.test(a)){
			$.post('validation.php', {emails:uemail}, function(data){
				if(data!=0){
					email.removeClass("valid");
					emailInfo.removeClass("valid");
					email.addClass("error");
					emailInfo.addClass("error");
					emailInfo.text("This email is already registered!");
					state = false;
				}else{
					email.removeClass("error");
					emailInfo.removeClass("error");
					email.addClass("valid");
					emailInfo.addClass("valid");
					emailInfo.text("Email available");
					state = true;
				}
				});	
		}
		//if it's NOT valid
		else{
			email.removeClass("valid");
			emailInfo.removeClass("valid");
			email.addClass("error");
			emailInfo.addClass("error");
			emailInfo.text("Please type a valid e-mail please :P");
			state = false;
		}
		return state;
	}

	
	function validatePass1(){
		var a = $("#password1");
		var b = $("#password2");

		//it's NOT valid
		if(pass1.val().length <5){
			pass1.removeClass("valid");
			pass1Info.removeClass("valid");
			pass1.addClass("error");
			pass1Info.addClass("error");
			pass1Info.text("Password must have least 5 characters!");
			state = false;
		}
		//it's valid
		else{
			pass1.removeClass("error");
			pass1Info.removeClass("error");
			pass1.addClass("valid");
			pass1Info.addClass("valid");
			pass1Info.text("OK!");
			validatePass2();
			state = true;
		}
		return state;
	}
	
	function validatePass2(){
		var a = $("#password1");
		var b = $("#password2");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			
			pass2.removeClass("valid");
			pass2Info.removeClass("valid");
			pass2.addClass("error");
			pass2Info.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			state = false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.removeClass("error");
			pass2.addClass("valid");
			pass2Info.addClass("valid");
			pass2Info.text("Confirmed password!");
			state = true;
		}
		return state;
	}
	
	name.keyup(validateName);
	email.keyup(validateEmail);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	
	$('#send').click(function(){
var all = $("form").serialize();
	if((validateName() & validateEmail() & validatePass1() & validatePass2()) == true){
			$.ajax({
			type: "POST",
			url: "insert.php",
			data: all,
			success: function(data){
			if(data==1){
				alert('Success! You have registered!');
						
				}else{
				alert('Errors!');
				}
		}
	});
	}else{
		alert("check YOUR errors!");
	}
});
	
});