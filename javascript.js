function showps(){
	var x = document.getElementById('password');
	if(x.type === "password"){
		x.type = "text";
	}
	else{
		x.type = "password";
	}
}

function optionCek(element){
	var change = document.getElementById('user');
	if(element.value == "student"){
		change.name = 'nim';
		change.placeholder = 'NIM';
		element.checked;
	}
	else{
		change.name = 'nip';
		change.placeholder = 'NIP';
		element.checked;
	}
}

function validateForm() {
	var error = false;
	var user = document.getElementById('user').value;
	var pass = document.getElementById("password").value;

	var pattern = /^[0-9]+$/;

	if (user.match(pattern)) {
		error = true;
	}
	else{
		alert('NIM or NIP is numeric only');
		error = false;
	}

	if (pass.match(pattern)){
		error = true;
	}
	else{
		alert('Password is numeric only');
		error = false;
	}

	return error;
}

function validateReg() {
	var error = false;
	var fname = document.getElementById('firstname').value;
	var lname = document.getElementById('lastname').value;
	var user = document.getElementById('user').value;
	var email = document.getElementById('email').value;
	var cemail = document.getElementById('cf_email').value;
	var pass = document.getElementById("password").value;
	var cpass = document.getElementById("cf_password").value;

	var pattern = /^[0-9]+$/;
	var alphabet = /^[a-zA-Z'-.]+$/;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if (fname.match(alphabet)) {
		error = true;
	}
	else{
		alert('First name is alphabet only');
		error = false;
	}
	if (lname.match(alphabet)) {
			error = true;
		}
	else{
			alert('Last name is alphabet only');
			error = false;
		}
	if (user.match(pattern)) {
			error = true;
		}
	else{
			alert('NIM or NIP is numeric only');
			error = false;
		}
	if (email.match(mailformat)) {
			error = true;
		}
	else{
			alert('Email is not valid');
			error = false;
		}
	if (cemail.match(mailformat)) {
			error = true;
		}
	else{
			alert('Email confirmation is not valid');
			error = false;
		}

	if (cemail == email) {
			error = true;
		}
	else{
			alert('Email and email confirmation not match');
			error = false;
		}

	if (pass.match(pattern)){
		error = true;
	}
	else{
		alert('Password is numeric only');
		error = false;
	}
	
	if (cpass.match(pattern)){
		error = true;
	}
	else{
		alert('Confirmation password is numeric only');
		error = false;
	}

	if (cpass == password){
		error = true;
	}
	else{
		alert('Password and confirmation password not match');
		error = false;
	}

	return error;
}


function validateCP() {
	var error = false;
	var cPass = document.getElementById('cr_password').value;
	var pass = document.getElementById("n_password").value;
	var cfpass = document.getElementById("cf_password").value;

	var pattern = /^[0-9]+$/;

	if (cPass.match(pattern)){
		error = true;
	}
	else{
		alert('Current password is numeric only');
		error = false;
	}

	if (pass.match(pattern)){
		error = true;
	}
	else{
		alert('New password is numeric only');
		error = false;
	}

	if (cfpass.match(pattern)){
		error = true;
	}
	else{
		alert('Confirmation password is numeric only');
		error = false;
	}

	if (pass == cfpass){
		error = true;
	}
	else{
		alert('Password and confirmation password not match');
		error = false;
	}

	return error;
}