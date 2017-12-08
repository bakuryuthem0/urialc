<div class="modal" tabindex="-1" role="dialog" id="modalElim">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title elim-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert responseAjax">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p></p>
        </div>
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-triangle"></i> Atención! Tenga en cuenta que esta acción es irreversible
        </div>
      </div>
      <div class="modal-footer">
        <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger btn-elim">Eliminar</button>
      </div>
    </div>
  </div>
</div>