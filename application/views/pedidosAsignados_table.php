<div class="row">
    <div class="col-md-12">
        <button class='btn btn-info mb-2' data-toggle='modal' data-target='#modalimporte'>Ver dinero asignado</button>
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped maestra">
                <thead class='thead-light'>
                    <tr>
						<th>Fecha Hora</th>
						<th>Estado</th>
						<th>Cliente</th>
                        <th>Distrito</th>
                        <th>Dirección</th>
						<th>Loncheras</th>
						<th class="text-center">Entregar</th>
                        <th>Platos</th>
                       
                    </tr>
                </thead>
                <tbody id =''>
				<?php

				if($pedidoAsignado){
					foreach ($pedidoAsignado->result() as $aux) {

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
						/* if($aux->Estado=='Preparado'){
							$estadoPreparado="";
						}else{
							$estadoPreparado="style='display:none'";
						} */


						echo "
                        <tr>
                        
							<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
							<td class='text-center'><span class=' text-center badge badge-$color btn-xs'>$aux->Estado</span></td>
							<td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
                            <td class='label label-info'>$aux->Distrito</td>
                            <td>$aux->Direccion</td>
                            <td>$aux->CantidadLonchera</td>
							<td class='text-center'>
							<button  type='button'  class='btn btn-info btn-xs'>Entregar</button>
							</td>
							<td class='w-20 text-center'>
								<a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
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

<script>
$(document).ready(function() {

    $('#m_pedidoMotorizado').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Mis Pedidos Asignados</span>";
	
});


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


<?php maestra(); ?>
</script>

</html>
