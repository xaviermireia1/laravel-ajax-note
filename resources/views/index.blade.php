<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajax.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Laravel notes</title>
</head>
<body>
    <center>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form id="formUpdate" method="post" onsubmit="actualizar();closeModal();return false;">
                        <h2 id="tituloNota"></h2>
                        <input type="hidden" name="_method" value="PUT" id="modifNote">
                        <span>titulo</span>
                        <input type="text" name="titulo" id="tituloUpdate">
                        <span>descripcion</span>
                        <input type="text" name="descripcion" id="descripcionUpdate">
                        <input type="submit" value="Editar">
                        <input type="hidden" name="id" id="idUpdate">
                    </form>
                </div>
            </div>
        <br><br><br>
        <div>
            <div>
                <form id="formcrear" method="post" onsubmit="crear();return false;">
                    <span>Titulo</span>
                    <input type="text" name="titulo" id="titulo">
                    <span>Descripción</span>
                    <input type="text" name="descripcion" id="descripcion">
                    <input type="hidden" name="_method" value="POST" id="createNote">
                    <input class="btn btn-success" type="submit" value="Crear">
                </form>
                <br>
                <div id="message" style="color:green"></div>
            </div>
        </div>
        </div>
        <br><br><br>
        <div>
            <form method="post" onsubmit="return false;">
                <input type="hidden" name="_method" value="POST" id="postFiltro">
                <div class="form-outline">
                   <input type="search" id="search" name="titulo" class="form-control" placeholder="Buscar por titulo..." aria-label="Search" onkeyup="filtro(); return false;"/>
                </div>
             </form>
        </div>
        <div>
            <table class="table" id="table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col" colspan="2">Acciones</th>
                </tr>
                @forelse ($notes as $note)
                <tr>
                    <td scope="row">{{$note->id}}</td>
                    <td>{{$note->titulo}}</td>
                    <td>{{$note->descripcion}}</td>
                    <td>
                        {{-- Route::get('/clientes/{cliente}/edit',[ClienteController::class,'edit'])->name('clientes.edit'); --}}
                        <button class= "btn btn-secondary" type="submit" value="Edit" onclick="modalbox({{$note->id}},'{{$note->titulo}}','{{$note->descripcion}}');return false;">Editar</button>
                    </td>
                    <td>
                        {{-- Route::delete('/clientes/{cliente}',[ClienteController::class,'destroy'])->name('clientes.destroy'); --}}
                        <form method="post">
                            <input type="hidden" name="_method" value="DELETE" id="deleteNote">
                            <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$note->id}}); return false;">Eliminar</button>
                         </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">No hay registros</td></tr>
                @endforelse
            </table>
        </div>
    </center>
    <script>
                /*FI*/
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function modalbox(id,titulo,descripcion){
            modal.style.display = "block";
            document.getElementById('tituloNota').innerHTML = "Nota #"+id;
            document.getElementById('tituloUpdate').value = titulo;
            document.getElementById('descripcionUpdate').value = descripcion;
            document.getElementById('idUpdate').value = id;
        }
        function closeModal(){
            modal.style.display = "none";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            closeModal();
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>
        