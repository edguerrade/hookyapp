<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">@yield('modaltitle')</h4>
        </div>
        <div class="modal-body">
            @yield('modalcontent')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            @yield('modalbuttons')
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->