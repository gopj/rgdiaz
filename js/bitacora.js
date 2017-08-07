function activarSalidas() {
	var len = $('input[type="checkbox"]:checked').length;

    if (len>0){
    	$("#reg_salidas").prop('disabled', false);
    } else {
    	$("#reg_salidas").prop('disabled', true);
    }

}


var inputs = document.getElementsByType('my-input-class');
for(var i = 0; i < inputs.length; i++) {
    inputs[i].disabled = false;
}