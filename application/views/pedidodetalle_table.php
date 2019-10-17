<?php
$ID_Perfil= desencriptar($_SESSION['ID_Perfil']);

	// validar boton hecho
	if($ID_Perfil=='3'){
		$hecho="style='display:none'";

	}else{
		$hecho='';
	}
	// validar botones actualizar y eliminar
	if($ID_Perfil == '4'){
		$botones ="style='display:none'";
	}
	else{
		$botones='';
	}
?>

<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
    <a href='<?php echo base_url('Pedido/nuevodetalle/'. $ID_Pedido);?>' <?php echo $botones ?>>
        <div class="fab bg-warning"> + </div>
    </a>
</div>
<div class="row">
	
    <div class="col-md-12">
	
		<a class="btn btn-warning mb-2" href='<?php echo base_url('Pedido');?>'><em class="fas fa-arrow-circle-left mr-1"></em>Volver</a>
        <div class="table-responsive">
            <table class="table table-hover maestra">
                <thead>
                    <tr>
						<th>Mesa</th>
                        <th>Plato</th>
                        <th>Estado</th>
                        <th>Observación</th>
                        <th>Almacen</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
		<?php
			if($pedidodetalle_list){
				foreach ($pedidodetalle_list->result() as $aux) {
				$ID = encriptar($aux->ID_LPedido);
				$ID_Pedido = encriptar($aux->ID_Pedido);
				$ID_Almacen=desencriptar($_SESSION['ID_Almacen']);
				$rutaeliminar= base_url('Pedido/eliminardetalle/' . $ID.'/'.$ID_Pedido);
				switch ( $aux->ID_Estado) {
					case 1:
						$color="danger";
						break;
					case 2:
						$color="info";
						break;
					case 3:
						$color="success";
						break;
					case 4:
						$color="warning";
						break;
					case 5:
						$color="inverse";
						break;
					case 6:
						$color="purple";
						break;
					default:
						# code...
						break;
				}

				if($aux->Estado=='Preparado'){
					$estadoPreparado="style='display:none'";
				}else{
					$estadoPreparado="";
				}

				if($aux->Estado=='Pendiente'){
					$estado='';
				}else{
					$estado="style='display:none'";
				}
				$Almacen = desencriptar($_SESSION['ID_Almacen']);

				if($aux->ID_Almacen == 1){
					if($aux->EsMenu==1){
						$icono="";
					}else{
					$icono="<em class='icon-book-open text-info pl-3'></em>";
					}
				}
				if($aux->ID_Almacen == 2){
					if($aux->EsMenu2==1){
						$icono="";
					}else{
					$icono="<em class='icon-book-open text-info pl-3'></em>";
					}
				}

				if($aux->ID_Almacen == 3){
					if($aux->EsMenu3==1){
						$icono="";
					}else{
					$icono="<em class='icon-book-open text-info pl-3'></em>";
					}
				}

				echo "
				<tr>
					<td>$aux->Mesa</td>
					<td>".  $aux->Menu ." $icono</td>
					<td><span id='estado' class='badge badge-".$color." btn-xs'>".$aux->Estado ."</span></td>
					<td>".  $aux->Observacion ."</td>
					<td>".  $aux->Almacen ."</td>
					<td>
						<form action='".base_url('Pedido/estado/')."' method='POST'".$hecho." >
							<input type='hidden' name='menu' value='$aux->ID_Menu'>
							<input type='hidden' name='id' value='$ID'>
							<input type='hidden' name='idpedido' value='$aux->ID_Pedido'>
							<input type='hidden' name='cantidad' value='$aux->Cantidad'>
							<input type='hidden' name='id_almacen' value='$aux->ID_Almacen'>
							<input id='hecho' type='submit'".$estado."  class='btn btn-success btn-xs ' value='Hecho'>
						</form>
					</td>

					<td class='w-20'>
						<a $estadoPreparado href='".base_url('Pedido/pedidodetalle/'.$ID)."'>
							<em class='icon-pencil  color-tema'".$botones."></em>
						</a>
					</td>

					<td class='w-20'>
						<a href='#' onclick=\"return baja('" . $rutaeliminar  ."')\">
							<em class='icon-trash color-tema'".$botones." ></em>
						</a>
					</td>
				</tr>
				";

				}
			}
		?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $('#m_pedido').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-cutlery'></em> <span>Lista de Ordenes</span>";

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
