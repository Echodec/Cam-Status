<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>

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
        <h1>Dispositivos</h1>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                    Agregar Dispositivo
                    </button><br><br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="tablehead">
                                <tr>
                                    <th scope="col">Nomenclatura</th>
                                    <th scope="col">Dirección IP</th>
                                    <th scope="col">Localización</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($Dispositivos as $Dispositivo)
                                <tr class="">
                                    <td>{{ $Dispositivo->nomenclatura }}</td>
                                    <td>{{ $Dispositivo->direccion }}</td>
                                    <td>{{ $Dispositivo->Localizacion->ciudad}}</td>
                                    <td>{{ $Dispositivo->estado }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$Dispositivo->id}}">
                                            Editar
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$Dispositivo->id}}">
                                            Borrar
                                        </button>
                                    </td>
                                </tr>
                                @include('Cameras.info')
                            @endforeach    
                            </tbody>
                        </table>
                        {{ $Dispositivos->links() }} <!-- Aquí agregas la paginación -->
                    </div>
                    @include('Cameras.create')
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

        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>