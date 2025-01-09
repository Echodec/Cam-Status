<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localizaciones</title>

    <!-- Enlazar el archivo CSS -->
    <link rel="stylesheet" href="{{ asset('assets/main.css') }}">
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
</head>

<body>
    <header>
        <h1>Localizaciones</h1>
    </header>

    <!-- Main content area with menu and dashboard -->
    <div class="main-content">
        <!-- Menu -->
        <div id="menu">
            <a href="{{ route('pingstatus.pform') }}">Cam-Status</a>
            <a href="#view2">Usuarios</a>
            <a href="#view2">Busqueda</a>
            <a href="{{ route('device.dbond') }}">Dispositivos</a>
            <a href="{{ route('index.lbond') }}">Localización</a>
            <a href="#view2">Status</a>
            <!-- Add more links as needed -->
        </div>

        <div class="deviceslist">
            <div class='rows'>
                <div class='col-mid-2'></div>
                <div class='col-mid-8'>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                    Agregar Localizacion
                    </button><br><br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="tablehead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($Localizaciones as $Localizacion)
                                <tr class="">
                                    <td>{{ $Localizacion->id }}</td>
                                    <td>{{ $Localizacion->ciudad }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{$Localizacion->id}}">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$Localizacion->id}}">
                                            Borrar
                                        </button>
                                    </td>
                                </tr>
                                @include('Location.info')
                            @endforeach    
                            </tbody>
                        </table>
                        {{ $Localizaciones->links() }} <!-- Aquí agregas la paginación -->
                    </div>
                    @include('Location.create')
                </div>
                <div class='col-mid-2'></div>
            </div>
        </div>

    </div>


    
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0oXLT9A9Jex2uSa9H7b1lHGH4SAkX1hrlIN4gBxJh2eHgqZb" crossorigin="anonymous"></script>
</body>
</html>