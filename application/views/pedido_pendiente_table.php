<div class="row">
    <div class="col-md-12">

		<div class="card" role="tabpanel">			
			<div class="card-body">
            <div class="row">
						<div class="col-md-12">						
							<div class="table-responsive">
								<table class="table maestra" style=' border-collapse: collapse;'>
									<thead>
										<tr>
                                            <th width="5">Fecha Hora</th>
                                            <th width="50">Cliente</th>
											<th width="20">Mesa</th>
											<th width="50">Estado</th>
											<th width="50">Mesero</th>
											<th width="50"></th>
											<th>Cobrar</th>
											<th class="text-right">ver</th>
											
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

                                    <td width='5'>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
                                    <td>$aux->RazonSocial</td>
                                    <td class='label label-info' >$aux->Mesa</th>

                                    <td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>

                                    <td>$aux->Nombre</td>


                                    <td>$ticket</td>
                                    <td class='w-20' >
                                       
                                    <a title='Cobrar' href='".base_url('Pedido/cobrarPedido/'.$ID)."' class='btn btn-secondary'>
                                        <em class='fas fa-dollar color-tema' style='padding-right:5px'></em>Cobrar
                                    </a>
                                </td>
                                    <td class='w-20 text-right' >
                                       
                                        <a title='Ver detalle' href='".base_url('Pedido/detalle/'.$ID)."'>
                                        <em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
                                    </a>
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
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {

		$('#m_pedidopendiente').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Pedidos pendientes de cobro</span>";
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
