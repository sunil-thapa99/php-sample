/*
	UN id: 17421492
*/
// Select one radio option
var radioButton = document.getElementsByName('radio');
for(var i=0; i<radioButton.length; i++){
	if(radioButton[i].checked){
		break;	
	}
}
/*Add and remove classname*/
function validateEmpty() {
	var userName = document.getElementById('username');
	if(userName.value == ""){
		userName.classList.add("empty");
	}
	else{
		userName.classList.remove("empty");
	}
	var passWord = document.getElementById('password');
	if(passWord.value == ""){
		passWord.classList.add("empty");
	}
	else{
		passWord.classList.remove("empty");
	}
}