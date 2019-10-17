<div class="row">
    <div class="col-md-12">

    <div class="card" role="tabpanel">
               <!-- Nav tabs-->
               <ul class="nav nav-tabs nav-fill" role="tablist">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true"><em class="fa fa-motorcycle"></em> Asignar motorizado</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#profile" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false"><em class="far fa-user fa-fw"></em> Asignados</a></li>
               </ul><!-- Tab panes-->
               <div class="tab-content p-0">
                  <div class="tab-pane active m-3" id="home" role="tabpanel">

                    <!-- <button href="#" data-toggle='modal' data-target='#modalasignarmotorizado' class="btn btn-primary btn-oval" onclick="numeroPedidosSelecionados();">Asignar Repartidor</button> -->
                    
                     <!-- START list group-->
                     <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class='thead-light'>
                                <tr>
                                    <th>Fecha Hora</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    
                                    <th>Distrito</th>
                                    <th>Dirección</th>
                                    <th class="text-right">#Loncheras</th>
                                    <th>CodigoLoncheras</th>
                                    <th>Detalles</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <tbody id='sinasignar'>
                            <?php
        
                            if($pedidos_armados){
                                foreach ($pedidos_armados->result() as $aux) {

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

                                    echo "
                                    <tr>
                                        <td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
                                        <td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
                                        <td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
                                        
                                        <td class='label label-info'>$aux->Distrito</td>
                                        <td>$aux->Direccion</td>
                                        <td class='text-right'>$aux->CantidadLonchera</td>
                                        <td>$aux->CodigoLoncheras</td>
                                        <td class='w-20 text-right'>
                                            <a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
                                                <em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
                                            </a>
                                        </td>
                                        <td class='w-20 text-right'>
                                            <a href='#' onclick='AsignarPedido($aux->ID_Pedido);' data-toggle='modal' data-target='#modalasignarmotorizado''>
                                                <em class='fas fa-motorcycle color-tema' style='padding-right:5px'></em>
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
                  <div class="tab-pane  m-3" id="profile" role="tabpanel">
                  <div class="table-responsive">
                        <table class="table table-hover  table-bordered">
                            <thead class='thead-light'>
                                <tr>
                                    <th>Fecha Hora</th>
                                    <th>Motorizado</th>
                                    <th>Estado</th>
                                    <th>Zona</th>
                                    <th>Distrito</th>
                                    <th>Dirección</th>
                                    <th>Cliente</th>
                                    <th class="text-right">Loncheras</th>
                                    <th>Platos</th>
                                    <th>Importe</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody  id='asig'>
                            <?php
        
                            if($allpedidosAsignados){
                                foreach ($allpedidosAsignados->result() as $aux) {

                        
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

                                    echo "
                                    <tr>
                                    
                                        <td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
                                        <td>$aux->NombreMotorizado $aux->ApellidoMotorizado</td>
                                        <td><span class='badge badge-$color btn-xs'>$aux->Estado</span></td>
                                        <td>$aux->Zona</td>
                                        <td class='label label-info'>$aux->Distrito</td>
                                        <td>$aux->Direccion</td>
                                        <td>$aux->Nombre"." "."$aux->ApellidoPaterno"." "."$aux->ApellidoMaterno</td>
                                        <td class='text-right'>$aux->CantidadLonchera</td>
                                        
                                        <td class='w-20 text-center'>
                                            <a href='#' onclick=\"return detalleDelivery('$aux->ID_Pedido')\" data-toggle='modal' data-target='#modalmotorizado'>
                                                <em class='fas fa-list-ol color-tema' style='padding-right:5px'></em>
                                            </a>
                                        </td>
                                        <td class='w-20 text-center'>
                                            <a href='#'onclick=\"return VerImporteMotorizado('$aux->ID_Pedido')\"  data-toggle='modal' data-target='#modalimporteMotorizado'>
                                                <em class='fas fa-eye color-tema' style='padding-right:5px'></em>
                                            </a>
                                        </td>
                                        <td class='w-20 text-center'>
                                            <a href='#' onclick='QuitarPedido($aux->ID_Pedido);'>
                                                <em class='fas fa-times color-tema' style='padding-right:5px'></em>
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
    $('#m_maestros').addClass('show').addClass('active');
    $('#m_repartidor').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Asignar Motorizado</span>";
    setInterval(sinasignar,5000);
    
});
function sinasignar(){
    $.ajax({
		type:'POST',
		url:"<?php echo base_url('Repartidor/RealTimeSinAsignar'); ?>",
		success:function(data) {
			$('#sinasignar').html(data);
            
		},
		fail:function() {
			alert("error");
		}
	});
}

function AsignarPedido(ID_Pedido){
   /*  var numpedidos=$(".acciones input:checked").length;
    $("#numeroPedidosSeleccionados").html(numpedidos); */
    $("#ID_P").val(ID_Pedido);
   
}

function factura(ruta) {
    window.open(ruta, "Imprimir", 'width=500, height=650');
}
function validar(obj){
    alert($('input:checkbox[name=ID_Pedido]:checked').val());
	
	if(obj.checked==true){
		$('#botonasignar').attr("disabled", false);
	}else{
		$('#botonasignar').attr("disabled", true);
	}
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

function VerImporteMotorizado(ID_Pedido){
    $.ajax({
		type:'POST',
		url:"<?php echo base_url('Repartidor/VerImporte') ?>/" + ID_Pedido,
		success:function(data) {
			$('#ver').html(data);
		},
		fail:function() {
			alert("error");
		}
	});
}
function QuitarPedido(ID_Pedido) {

    $.ajax({
        type:"POST",
        url:"<?php echo base_url('Repartidor/desasignar') ?>/" + ID_Pedido,
        success:function(data){
           $("#asig").html(data);
        },
        error:function(){
            alert("error");
        }
    });
    
}

<?php maestra(); ?>
</script>

</html>
