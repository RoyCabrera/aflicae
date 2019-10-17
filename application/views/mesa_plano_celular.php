
        
        <div class='row'>
            
                <?php 
                if($Mesa_list){
                    foreach($Mesa_list->result() as $row) {
                        switch ( $row->ID_Estado) {
                            case 1:
                                $estado ="Pendiente";
                                $color="danger";
                                break;
                            case 2:
                            $estado ="Preparado";
                                $color="success";
                                break;
                            case 3:
                            $estado ="Entregado";
                                $color="info";
                                break;
                            case 4:
                            $estado ="Cobrado";
                                $color="inverse";
                                break;
                            case 5:
                            $estado ="Anulado";
                                $color="inverse";
                                break;
                            case 6:
                            $estado ="Devuelto";
                                $color="purple";
                                break;
                            case 7:
                            $estado ="En Preparación";
                            $color="warning";
                            break;
                            default:
                            $estado ="Libre";
                            $color="info";
                                break;
                        }
                        
                        echo "
                        <div class='col col-xl-3 col-sm-3 col-xs-3'>";
                            echo "<div class='col-12'>";
                if($row->ID_PedidoNow==0) {
                    $equipo=base_url("assets/img/mesa2.jpg");
                    echo "
                <div  data-toggle='modal' data-target='#modalMesaVacia' data-id='$row->ID_Mesa'  onclick=\"return obtenerMesa('$row->ID_Mesa')\"  title='Mesa ".$row->Mesa."' ?>
                    <div class='text-center'>
                    <p class='badge badge-$color btn-xs'>$estado</p>
                    
                    <h5><img src='".$equipo."' width='100%' height='100%'>".$row->Mesa."</h5>
                    </div>
                </div>";
    
                }else
                {
                    $equipo=base_url("assets/img/mesa.jpg");
                    echo "
                <div   data-toggle='modal' data-target='#modaldetalle' data-id='$row->ID_Mesa'  onclick=\"return detalle('$row->ID_PedidoNow')\"  title='Mesa ".$row->Mesa."' ?>
                <div class='text-center'>
                <p class='badge badge-$color btn-xs'>$estado</p>
                    <h5><img src='".$equipo."' width='100%' height='100%'>".$row->Mesa."</h5>
                </div>
                </div>";
    
                }
                echo "</div>";
                echo"
                </div>";
                    }
                }
                
                ?>
                
        </div>
    
<?php
	if($Mesa_list){


		foreach($Mesa_list->result() as $row) {
			

		}
	}
?>

   
<?php

	$id=desencriptar($_SESSION['ID_Perfil']);
	if($id == 1 || $id==2){
		echo "<script src='//code.jquery.com/ui/1.11.2/jquery-ui.js'></script>";
	}
?>

<script>

$(document).ready(function() {
	$('#m_planoMesa').addClass('show').addClass('active');
	$('#almacen_1').addClass('active');
    $(".mesa").draggable({
        stop: function(event, ui) {

            var id = parseInt(event.target.attributes['data-id'].value);

            var estilo = "class='mesa' style='" + event.target.attributes['style'].nodeValue + "'";

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('Mesa/actualizarEstilo') ?>/' + id,
                data: {
                    estilo: estilo
                },
                success: function(data) {

                }
            });

        }
    });
});

function detalle(ID_PedidoNow) {
	var urladd= '<?php echo base_url('Pedido/nuevodetalle') ?>/' + ID_PedidoNow;
	var verMesa='<?php echo base_url('Pedido/posicionMesa/')?>/' + ID_PedidoNow;
	$("#verMesa").html("<a href="+verMesa+" class='btn btn-info' >Ver Mesa</a>");
	$("#nuevo").html("<a href="+urladd+" class='btn btn-success' >nuevo</a>");
	$.ajax({
		type:'POST',
		url:'<?php echo base_url('Pedido/VerDetallePedidoMesa') ?>/' + ID_PedidoNow,
		success:function(data) {
			$('#detalle').html(data);
		},
		fail:function() {
			alert("error");
		}
	})
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

function nuevoPedido(ID_Mesa) {
	var nuevo= '<?php echo base_url('Pedido/nuevoDesdePanelMesa') ?>/' + ID_Mesa;
	window.location.href = nuevo;
}
function obtenerMesa(ID_Mesa) {

	var id= "<button class='btn btn-success' onclick='return nuevoPedido("+ID_Mesa+")' >Nuevo Pedido</button>";
	$("#nuevoPedido").html(id);
}

</script>
