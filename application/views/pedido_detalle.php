<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
    <a href='<?php echo base_url('Pedido/nuevo/'.$ID_Pedido) ;?>'>
        <div class="fab fondo-tema"> + </div>
    </a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover maestra">
                <thead>
                    <tr>
                        <th>Plato</th>

                        <th>Cantidad</th>
                        <th class='w-20'></th>
                        <th class='w-20'></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						if($detalle_list){
							foreach ($detalle_list->result() as $aux) {
							$ID = encriptar($aux->ID_Pedido);

							$rutaeliminar= base_url('Pedido/eliminar/' . $ID);

							echo "
							<tr>
								<td>".date_format(date_create($aux->FechaHora),'d/m/Y H:i:s')."</td>
								<td>".  $aux->Menu ."</td>
								<td>".  $aux->Cantidad ."</td>
							</tr>
							";

							}
						}
						//var_dump($detalle);
					?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $('#m_insumo').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-building-o'></em> <span><?php echo $NombreMenu;?></span>";
});

function baja(eliminar) {
    swal({
            title: "¿Desea eliminar este Menu?",
            text: "Recuerde que no aparecerá en la lista",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, ¡Eliminar!",
            closeOnConfirm: false
        },
        function() {
            swal("Eliminar!", "Este Menu ha sido eliminado", "success");
            window.location.href = eliminar;
        });
}

<?php maestra(); ?>
</script>

</html>
