<!-- Modal -->
<div class="modal fade" id="edit{{$Localizacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Dispositivo</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('index.update',$Localizacion->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="modal-body">
        <div class="mb-3">
          <label for="" class="form-label">Ciudad</label>
          <input type="text" class="form-control" name="ciudad" id="" placeholder="" required value="{{$Localizacion->ciudad}}"/>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="delete{{$Localizacion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar Dispositivo</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('index.destroy',$Localizacion->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
      <div class="modal-body">
        Seguro de borrar dispositivo <strong>{{$Localizacion->ciudad}}?</strong>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>