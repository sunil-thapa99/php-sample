/*
	UN id: 17421492
*/
//Display form on Click
function addFormOpen() {
	var getform = document.getElementById('addform');
	if(getform.style.display == "none"){
		getform.style.display = "block";
	}
	else{
		getform.style.display = "none";
	}
}
function editFormOpen() {
	var getform = document.getElementById('selectEditform');
	if(getform.style.display == "none"){
		getform.style.display = "block";
	}
	else{
		getform.style.display = "none";
	}
}
function deleteFormOpen() {
	var getform = document.getElementById('selectdeleteform');
	if(getform.style.display == "none"){
		getform.style.display = "block";
	}
	else{
		getform.style.display = "none";
	}
}