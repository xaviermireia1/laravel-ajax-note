<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/ajax.js"></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <title>Laravel notes</title>
</head>

<body>
    <center>
        <br><br><br>
        <div>
            <div>
                <form method="post" onsubmit="crear();return false;">
                    <span>Titulo</span>
                    <input type="text" name="titulo" id="titulo">
                    <span>Descripción</span>
                    <input type="text" name="descripcion" id="descripcion">
                    <input type="hidden" name="_method" value="POST" id="createNote">
                    <input type="submit" value="Crear">
                </form>
                <br>
                <div id="message"></div>
            </div>
        </div>
        </div>
        <br><br><br>
        <div>
            <form method="post">
                <input type="search" name="filtro" id="filtro" placeholder="Buscar por titulo">
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
                        <form method="post">
                            <input type="hidden" name="_method" value="GET">
                            <button class= "btn btn-secondary" type="submit" value="Edit">Editar</button>
                        </form>
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
</body>

</html>
        