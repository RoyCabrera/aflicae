
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



<div class="row">
	<div class="col-md-12">


	<a  style = 'position:absolute;left:350px' class="btn btn-labeled btn-green mb-2" href='<?php echo base_url('Pedido/AllPedidoDetalle/') ;?>'><span class="btn-label"><i class="fa fa-eye"></i></span>Ver todo</a>

		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead>
					<tr>
                        <th>FechaHora</th>
						<th>Familia</th>
					 	<th>Plato</th>
						<th>Estado</th>
						<th>Observación</th>
						<th>Mesero</th>
                        <th>Mesa</th>
						<th></th>

					</tr>
				</thead>
				<tbody>

					<?php
                                if($allpedido_detalle){

                                    foreach ($allpedido_detalle->result() as $aux) {


                                        $ID = encriptar($aux->ID_LPedido);
                                        $ID_Pedido = encriptar($aux->ID_Pedido);
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


                                    if($aux->Estado=='Pendiente'){
                                        $estado='';
                                    }else{
                                        $estado="style='display:none'";
                                    }

									$Almacen = desencriptar($_SESSION['ID_Almacen']);
									if($Almacen == 1) {
										if($aux->EsMenu==1){
											$icono="";
											$classplatoCarta="";
										}else{
											$icono="<em class='icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}
									}
									if($Almacen == 2) {
										if($aux->EsMenu2==1){
											$icono="";
											$classplatoCarta="";
										}else{
											$icono="<em class='icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}
									}
									if($Almacen == 3) {
										if($aux->EsMenu3==1){
											$icono="";
											$classplatoCarta="";
										}else{
											$icono="<em class='icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}
									}



                                    echo "
                                    <tr>
										<td class='$classplatoCarta'>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
										<td class='$classplatoCarta' >$aux->Familia</td>
                                        <td class='$classplatoCarta'>$icono " .  $aux->Menu ." </td>
                                        <td><span id='estado' class='badge badge-".$color." btn-xs'>".$aux->Estado ."</span></td>
                                        <td class='$classplatoCarta'>".  $aux->Observacion ."</td>
                                        <td class='$classplatoCarta'>".$aux->Nombre."</td>
                                        <td class='$classplatoCarta'>".$aux->Mesa."</td>
                                        <td>
                                        <form action='".base_url('Pedido/estado/')."' method='POST'".$hecho." >
                                        <input type='hidden' name='menu' value='$aux->ID_Menu'>
                                        <input type='hidden' name='id' value='$ID'>
                                        <input type='hidden' name='idpedido' value='$aux->ID_Pedido'>
                                        <input type='hidden' name='cantidad' value='$aux->Cantidad'>
                                        <input type='hidden' name='id_almacen' value='$Almacen'>

                                        <input id='hecho' type='submit'".$estado."  class='btn btn-success btn-xs ' value='Hecho'>
                                        </form>
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
	$(document).ready(function () {

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
			function () {
				swal("Eliminar!", "Este Menu ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
