<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Dispositivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('device.dsave')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="mb-3">
          <label for="" class="form-label">Nomenclatura</label>
          <input type="text" class="form-control" name="nomenclatura" id="" placeholder=""/>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Dirección IP</label>
          <input type="text" class="form-control" name="direccion" id="" placeholder=""/>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Localización</label>
          <select name="idciudad" id="" class="form-control">
            @foreach($Localizaciones as $Localizacion)
            <option value="{{$Localizacion->id}}"> {{$Localizacion->ciudad}} </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Estado</label>
          <select class="form-control" name="estado" id="estado">
            <option value="" disabled selected>Selecciona un estado</option>
            <option value="Activo" {{ $Dispositivo->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ $Dispositivo->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            <!-- Agrega más opciones según sea necesario -->
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>