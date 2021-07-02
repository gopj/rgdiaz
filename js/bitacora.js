function activarSalidas() {
	var len = $('input[type="checkbox"]:checked').length;

    if (len>0){
    	$("#reg_salidas").prop('disabled', false);
    } else {
    	$("#reg_salidas").prop('disabled', true);
    }

}

try {
    //var inputs = document.getElementsByType('my-input-class');
    var inputs = document.getElementsByTagName('my-input-class');
    
    for(var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = false;
    }
} catch (error) {
  console.error(error);
  // expected output: ReferenceError: nonExistentFunction is not defined
  // Note - error messages will vary depending on browser
}
