<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class='thead-light'>
                    <tr>
						<th>Fecha Hora</th>
						<th>Estado</th>
						<th>Cliente</th>
                        <th>Distrito</th>
                        <th>Dirección</th>
						<th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id ='pedidosDeliveryTable'>
				<?php

				if($pedido_list){
					foreach ($pedido_list->result() as $aux) {

						$ID = encriptar($aux->ID_Pedido);
						$rutaeliminar= base_url('Pedido/eliminar');

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
								break;
							case 8:
								$color="purple";
								break;
							case 9:
								$color="green";
								break;
							case 10:
								$color="inverse";
								break;
							default:
								$color="info";
									break;
						}
						if($aux->Estado=='Preparado'){
							$estadoPreparado="";
						}else{
							$estadoPreparado="style='display:none'";
						}


						echo "
						<tr role='row' class='odd'>
							<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
							<td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
							<td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
                            <td class='label label-info'>$aux->Distrito</td>
							<td>$aux->Direccion</td>
							<td>
							
							<button $estadoPreparado type='button' data-toggle='modal' onclick=\"return armarpedido('$aux->ID_Pedido')\" data-target='#modal_lonchera' class='btn btn-info btn-xs '>Armar pedido</button>
							</td>
							<td class='w-20'>
								<a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
									<em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
								</a>
							</td>


						</tr>";
						echo "
								<tr id='mostrarDetalle'>
									<td colspan='5'>
										<table>";
										if($pedidodet_list){
											foreach ($pedidodet_list->result() as $aux2) {
												if( $aux2->ID_Pedido == $aux->ID_Pedido){
													echo "
													<tr >
														<td>".$aux2->Menu."</td>
													
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

<script>
$(document).ready(function() {

    $('#m_pedidodelivery').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Lista de Pedidos Delivery</span>";
	setInterval(realTimePedidoDelivery,5000);
});

function realTimePedidoDelivery() {
	console.log('act');
	var ruta ="<?php echo base_url('Pedido/realTimePedidosDeliveryMesero');?>";
	$.ajax({
			type: "POST",
			url: ruta,
			success: function (data) {
				$("#pedidosDeliveryTable").html(data);
			}
		});
}
function detalleDelivery(ID_PedidoNow) {

	$.ajax({
		type:'POST',
		url:"<?php echo base_url('Pedido/VerDetallePedidoDelivery') ?>/" + ID_PedidoNow,
		success:function(data) {
			$('#detalleDelivery').html(data);
		},
		fail:function() {
			alert("error");
		}
	});

}
function armarpedido(ID_PedidoD){
	$("#pe").html("<input type='hidden' value='"+ID_PedidoD+"' name='pedi'>");

}

<?php maestra(); ?>
</script>

</html>
