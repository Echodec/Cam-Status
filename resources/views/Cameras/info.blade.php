<!-- Modal -->
<div class="modal fade" id="edit{{$Dispositivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Dispositivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('device.dupdate',$Dispositivo->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="mb-3">
          <label for="" class="form-label">Nomenclatura</label>
          <input type="text" class="form-control" name="nomenclatura" id="" placeholder="" required value="{{$Dispositivo->nomenclatura}}"/>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Dirección IP</label>
          <input type="text" class="form-control" name="direccion" id="" placeholder="" required value="{{$Dispositivo->direccion}}"/>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Localización</label>
          <select class="form-control" name="localizacion" id="localizacion" class="form-control">
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






<!-- Modal -->
<div class="modal fade" id="delete{{$Dispositivo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar Dispositivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('device.ddestroy',$Dispositivo->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
      <div class="modal-body">
        Seguro de borrar dispositivo <strong>{{$Dispositivo->nomenclatura}}?</strong>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>