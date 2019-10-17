<div class="row">
    <div class="col-md-12">

		<div class="card" role="tabpanel">
				<!-- Nav tabs-->
			<ul class="nav nav-tabs nav-fill" role="tablist">
				<li class="nav-item" role="presentation"><a class="nav-link active" href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true"><em class="fa fa-book"></em> Pedidos del día</a></li>
				<li class="nav-item" role="presentation"><a class="nav-link" href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false"><em class="fa fa-book"></em> PedidosDetallados</a></li>
			</ul>
			<!-- Tab panes-->
			<div class="tab-content p-0">

				<div class="tab-pane active m-3" id="home" role="tabpanel">
					<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">

						<a  href='<?php echo base_url('Pedido/nuevo') ;?>'>
							<div class="fab bg-warning">+</div>
						</a>
					</div>
					<div class="row">
						<div class="col-md-12">
						<a class="btn btn-info" href="<?= base_url('Pedido/select_all_pedidos_hoy') ;?>">Ver todo</a>
							<?php
								$ID_Perfil= desencriptar($_SESSION['ID_Perfil']);
								if($ID_Perfil == 1 || $ID_Perfil == 2):
							?>
<!-- 								<a href="<?= base_url('Pedido/selectAll') ;?>" class="btn btn-green">Ver todo</a>
 -->								<hr>

							<?php
								endif;
							?>
							<div class="table-responsive">
								<table class="table " style=' border-collapse: collapse;'>
									<thead>
										<tr>
											<th width="5">Fecha Hora</th>
											<th width="20">Mesa</th>
											<th width="50">Estado</th>
											<th width="50">Mesero</th>
											<th width="50"></th>
											<th width="50"></th>
											<th width="50"></th>
											
											<th>ver</th>
											<th>Editar</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<?php

										if($pedido_list){
											foreach ($pedido_list->result() as $aux) {

												$ID = encriptar($aux->ID_Pedido);
												$rutaeliminar= base_url('Pedido/eliminar/' . $ID."/".$aux->ID_Mesa);

												switch ( $aux->ID_Estado) {
													case 1:
														$color="danger";
														break;
													case 2:
														$color="success";
														break;
													case 3:
														$color="info";
														break;
													case 4:
														$color="inverse";
														break;
													case 5:
														$color="inverse";
														break;
													case 6:
														$color="purple";
														break;
													case 7:
													$color="warning";
													case 16:
													$color = "inverse";
													break;
													default:
														# code...
														break;
												}
													if(($aux->Estado=='Preparado') || ($aux->Estado=='Cobrado')){
														$estadoPreparado="style='display:none'";
													}else{
														$estadoPreparado="";
													}

													if($aux->Estado == "Preparado" || $aux->Estado=='Cobrado' || $aux->Estado=='Por cobrar'){

														$boleta="<a class='btn btn-pill-left btn-secondary' href=".base_url('Venta/datosFactura/'.$ID.'/2/'.$aux->ID_Mesa).">Boleta</a>";
														$factura="<a class='btn btn-pill-right btn-secondary' href=".base_url('Venta/datosFactura/'.$ID.'/1/'.$aux->ID_Mesa).">Factura</a>";
														$ticket="<input type='button' class='btn btn-xs btn-purple' value='Ticket'  onclick=\"return factura('" . base_url('Venta/verFactura/'.$ID)."')\">";
													}
													else{
														$factura="";
														$boleta="";
														$ticket="";
													}


												echo "
												<tr>

													<td width='5' style='border-top:1px solid dimgray'>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
													<td class='label label-info' style='border-top:1px solid dimgray'>$aux->Mesa</td>
													<td style='border-top:1px solid dimgray'><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
													<td style='border-top:1px solid dimgray'>$aux->Nombre</td>
													<td style='border-top:1px solid dimgray'>$boleta</td>
													<td style='border-top:1px solid dimgray'>$factura</td>
													<td style='border-top:1px solid dimgray'>$ticket</td>
													
													<td class='w-20' style='border-top:1px solid dimgray'>
														<!--<a href='#' onclick=\"return detalle('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modaldetalle'>
															<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
														</a>-->
														<a href='".base_url('Pedido/detalle/'.$ID)."'>
														<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
													</a>

													</td>
													<td class='w-20' style='border-top:1px solid dimgray'>
														<a href='".base_url('Pedido/pedido/'.$ID)."'>
															<em class='icon-pencil color-tema'  ></em>
														</a>
													</td>


													<td class='w-20' style='border-top:1px solid dimgray'>
														<a href='#'  onclick=\"return baja('$rutaeliminar')\" >
															<em $estadoPreparado class='icon-trash color-tema'></em>
														</a>
													</td>
												</tr>";
												echo "
												<tr id='mostrarDetalle'>
													<td colspan='4'>
														<table>";

														if(isset($pedidodet_list)){
															foreach ($pedidodet_list->result() as $aux2) {
																$Almacen = desencriptar($_SESSION['ID_Almacen']);
									if($Almacen == 1) {
										if($aux2->EsMenu==1){
											$icono="";
											$classplatoCarta="";
										}elseif ($aux2->ID_Familia == 2){
											$icono="<em class='pl-3 icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}else{
											$icono = "";

										}
									}
									if($Almacen == 2) {
										if($aux2->EsMenu2==1){
											$icono="";
											$classplatoCarta="";
										}elseif ($aux2->ID_Familia == 2){
											$icono="<em class='pl-3 icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}else{
											$icono = "";

										}
									}
									if($Almacen == 3) {
										if($aux2->EsMenu3==1){
											$icono="";
											$classplatoCarta="";
										}elseif ($aux2->ID_Familia == 2){
											$icono="<em class='pl-3 icon-book-open text-info'></em>";
											$classplatoCarta="font-weight-bold";
										}else{
											$icono = "";

										}
									}
																switch ( $aux2->ID_Estado) {
																	case 1:
																		$color="danger";
																		break;
																	case 2:
																		$color="success";
																		break;
																	case 3:
																		$color="info";
																		break;

																	default:
																		$color="purple";

																		break;
																}
																if( $aux2->ID_Pedido == $aux->ID_Pedido){
																	echo "
																	<tr>
																		<td class='bg-gray-lighter'>".$aux2->Menu."$icono</td>

																		<td class='text-$color '>".$aux2->Estado."</td>
																	</tr>";
																}

														}}
														echo "
														</table>
													</td>
												</tr>";
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane m-3" id="profile" role="tabpanel">
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
								<div class="table-responsive">
									<table class="table table-hover maestra">
										<thead>
												<tr>
													<th>Mesa</th>
													<th>Plato</th>
													<th>Estado</th>
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
														$icono="<em class='icon-book-open'></em>";
														}
													}
													if($aux->ID_Almacen == 2){
														if($aux->EsMenu2==1){
															$icono="";
														}else{
														$icono="<em class='icon-book-open'></em>";
														}
													}

													if($aux->ID_Almacen == 3){
														if($aux->EsMenu3==1){
															$icono="";
														}else{
														$icono="<em class='icon-book-open'></em>";
														}
													}

													echo "
													<tr>
													<td>".  $aux->Mesa ."</td>
														<td>".  $aux->Menu ." $icono</td>

														<td><span id='estado' class='badge badge-".$color." btn-xs'>".$aux->Estado ."</span></td>

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
				</div>
			</div>

		</div>
	</div>
</div>


<script>
	$(document).ready(function() {

		$('#m_pedido').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Pedidos</span>";
	});

	function factura(ruta) {
		window.open(ruta, "Imprimir", 'width=500, height=650');
	}


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
	function detalle(ID_Pedido) {
		var ruta ="<?php echo base_url('Pedido/VerDetallePedidoMesa')?>/"+ID_Pedido;
	$.ajax({
		type:'POST',
		url:ruta,
		success:function(data) {
			$('#detalle').html(data);
		},
		fail:function() {
			alert("error");
		}
	});
}


	<?php maestra(); ?>
</script>

</html>
