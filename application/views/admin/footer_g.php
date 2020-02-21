<footer class="main-footer">
    <strong>&copy; <?= date("Y"); ?> <a href="<?= site_url(); ?>"> Subasta y Anuncios</a>.</strong> Todos los derechos reservados.
</footer>
<!-- modal error-->
<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Mensaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="mensaje_error" class="text-center"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="aceptar_error" type="button" class="btn btn-danger">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!--fin modal error-->


</body>

</html>



<script>
    $(document).ready(function() {

    });

    var d = null;

    function show_dialog(obj, data) {
        d = data;
        $(obj).modal("show");
    }

    function item_action() {
        window.location.href = d[1] + '/' + d[0];
    }
    setTimeout(hide_dialog, 2000);

    function hide_dialog() {
        $(".alert-success").fadeOut("slow");
    }
</script>

</body>

</html>