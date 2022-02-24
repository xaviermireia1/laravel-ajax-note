window.onload= function() {
    document.getElementById("titulo").focus()
}
function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function filtro() {
    var table = document.getElementById('table');
    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('postFiltro').value;
    var filtro = document.getElementById('search').value;

    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', method);
    formData.append('titulo', filtro);

    var ajax = objetoAjax();

    ajax.open("POST", "notes/shows", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);

                var recarga = '';
                recarga += '<tr>';
                recarga += '<th scope="col">#</th>';
                recarga += '<th scope="col">Nombre</th>';
                recarga += '<th scope="col">Descripcion</th>';
                recarga += '<th scope="col" colspan="2">Acciones</th>';
                recarga += '</tr>';
                for (let i = 0; i < respuesta.length; i++) {
                    recarga += '<tr>';
                    recarga += '<td scope="row">' + respuesta[i].id + '</td>';
                    recarga += '<td>' + respuesta[i].titulo + '</td>';
                    recarga += '<td>' + respuesta[i].descripcion + '</td>';
                    recarga += '<td>';
                    // boton editar
                    recarga += '<button class="btn btn-secondary" type="submit" value="Edit" onclick="modalbox(' + respuesta[i].id + ',\'' + respuesta[i].titulo + '\',\'' + respuesta[i].descripcion + '\');return false;">Editar</button>';
                    recarga += '</td>';
                    recarga += '<td>';
                    // boton modificar
                    recarga += '<form method="post">';
                    recarga += '<input type="hidden" name="_method" value="DELETE" id="deleteNote">';
                    recarga += '<button class= "btn btn-danger" type="submit" value="Delete" onclick="eliminar(' + respuesta[i].id + ');return false;">Eliminar</button>';
                    recarga += '</form>';
                    recarga += '</td>';
                    recarga += '</tr>';
                }
                table.innerHTML = recarga;
            }
        }
    ajax.send(formData)
}

function crear() {
    var message = document.getElementById('message');

    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('createNote').value;
    var formData = new FormData(document.getElementById('formcrear'));
    formData.append('_token', token);
    formData.append('_method', method);
    var ajax = objetoAjax();

    ajax.open("POST", "notes", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    message.innerHTML = '<p>Nota creada correctamente.</p>';

                } else {
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
                filtro();
                document.getElementById("titulo").focus()
                document.getElementById("titulo").value="";
                document.getElementById("descripcion").value=""
            }
        }
    ajax.send(formData)
}

function eliminar(note_id) {
    var message = document.getElementById('message');

    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('deleteNote').value;
    var formData = new FormData();
    formData.append('_token', token);
    formData.append('_method', method);

    var ajax = objetoAjax();

    ajax.open("POST", "notes/" + note_id, true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    message.innerHTML = '<p>Nota eliminada correctamente.</p>';

                } else {
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
    ajax.send(formData)
}


function actualizar() {
    var message = document.getElementById('message');

    var token = document.getElementById('token').getAttribute("content");
    var method = document.getElementById('modifNote').value;
    var formData = new FormData(document.getElementById('formUpdate'));
    formData.append('_token', token);
    formData.append('_method', method);

    var ajax = objetoAjax();

    ajax.open("POST", "notes", true);
    ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.resultado == "OK") {
                    message.innerHTML = '<p>Nota modificada correctamente.</p>';

                } else {
                    message.innerHTML = 'Ha habido un error:' + respuesta.resultado;
                }
            }
            filtro();
        }
    ajax.send(formData)
}