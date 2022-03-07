function generarURLserialize(idForm) {
	var cadena = $('#' + idForm).serialize();
	
	for (var i = 0; i < cadena.length; i++) {
        cadena = cadena.replace('+', ' ');
	}

    var temp = cadena.split('&');
    var temp2 = [];
    var data = [];
    var nombre_campo = '';
    var valor_campo = '';
	
    for (i = 0; i < temp.length; i++) {
        temp2 = temp[i].split('=');
        if (nombre_campo == temp2[0]) {
			
            if (valor_campo.length > 0) {
                valor_campo = valor_campo + '|' + temp2[1];
            } else {
                valor_campo = temp2[1];
                temp2 = temp[i - 1].split('=');
                valor_campo = temp2[1] + '|' + valor_campo;
            }
        } else {
            if (valor_campo.length > 0) {
                data.pop();
                data.push(valor_campo);
                nombre_campo = '';
                valor_campo = '';
            }
            if(temp2[1].length == 0) {
                temp2[1] = '-';
            }
            data.push(temp2[1]);
        }
        nombre_campo = temp2[0];
    }
    return data;
}