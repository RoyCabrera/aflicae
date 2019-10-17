<?php
if(desencriptar($_SESSION['ID_Perfil'])==1 || desencriptar($_SESSION['ID_Perfil']) == 2){
    $superadmin = "";
    $maestra = "maestra";
    $agregar = "";
}
else{
    $superadmin = "style='display:none'";
    $maestra = "";
    $agregar = "display:none";
}
?>

<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
    <a <?php echo $superadmin ?>; href='<?php echo base_url('Compra/AsignarInsumoListaCompra/'.$ID_ListaCompra.'/'.$CodUsuario) ;?>'>
        <div class="fab bg-warning">+</div>
    </a>
</div>
<div class="row">
    <?php 
    
    
    
   /*  if(isset($dineroAsignado)){
                
        foreach($dineroAsignado->result() as $row){
            echo "<div class='col-3'>
            <div class='input-group mb-2'>
            <div class='input-group-prepend'>
               <div class='input-group-text'>Saldo</div>
            </div><input class='form-control' id='inlineFormInputGroup' disabled type='text' placeholder='Username' value='S/ $row->Total'>
         </div></div>";
        
            
        }
    }
     */
    if(isset($dineroTotalAsigando)){
        foreach($dineroTotalAsigando->result() as $row){
            if($row->total == "" || $row->total == 0){
                $TotalDineroAsignado = "0.00";
            }else{
               $TotalDineroAsignado = $row->total;
            }
            echo "<div class='col-3'>
            <div class='input-group mb-2'>
            <div class='input-group-prepend'>
               <div class='input-group-text'>Monto asignado</div>
            </div><input class='form-control' id='inlineFormInputGroup' disabled type='text' placeholder='Username' value='S/ ".number_format($TotalDineroAsignado,2)."'>
         </div></div>";
         //$totalDinero = $row->total;
           
        }
        
    }
    

    if(isset($dineroTotal)){
        foreach($dineroTotal->result() as $row){
            if($row->Total == ""){
                $TotalDineroAsignado = "0.00";
            }else{
               $TotalDineroAsignado = $row->Total;
            }
            echo "<div class='col-3'>
            <div class='input-group mb-2'>
            <div class='input-group-prepend'>
               <div class='input-group-text'>Saldo</div>
            </div><input class='form-control' id='inlineFormInputGroup' disabled type='text' placeholder='Username' value='S/ ".number_format($TotalDineroAsignado,2)."'>
         </div></div>";
        //$totalDinero = $row->TotalDineroAsignado;
           
        }
    }
    
    ?>
    
    
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
        
			<table class="table maestra table-hover">
				<thead class="">
					<tr>
                     
                         <th>Producto</th>
                         <th></th>
                         <th>Estado</th>
                         <th width="10">Cantidad</th>
                        <th>Familia</th>
                        <th>Atributo 1</th>
                        <th>Atributo 2</th>
                        <th>Precio</th>
                        <?php 
                        if(desencriptar($_SESSION['ID_Perfil']) == 1 || desencriptar($_SESSION['ID_Perfil']) == 2):
                            echo "<th></th>";
                            
                        endif;
                        ?>
						
					</tr>
				</thead>
				<tbody>

                <?php 
                
                
                    if(isset($list_asignado)){
                        foreach($list_asignado->result() as $row){
                            $ID = encriptar($row->ID_Lista);
                            $rutaeliminar= base_url('Compra/eliminarListaCompraDetalle/'.$ID);
                            // permisos
                            if(desencriptar($_SESSION['ID_Perfil']) == 1 || desencriptar($_SESSION['ID_Perfil']) == 2){
                                $vereliminar = "
                                <td class='w-20'>
                                    <a href='#'  onclick=\"return baja('$rutaeliminar')\" >
                                        <em class='icon-trash'></em>
                                    </a>
                                </td>";
                            }else {
                                $vereliminar="";
                            }
                                
                            // estados
                            if($row->Comprado == 0){
                                $comprado = "pendiente";
                                $color = "danger";
                                $mostrar = "";
                            }
                            else {
                                $comprado = "comprado";
                                $color = "success";
                                $mostrar = "style='display:none'";
                            }

                            //ver el precio si en caso ya se compro
                            if($row->Precio){
                                $verprecio = "S/ $row->Precio";
                            }else{
                                $verprecio = "---";
                            }

                            // dinero asignado
                            if($dineroTotalAsigando->num_rows() < 1){
                                $verComprar="<td></td>";
                              
                            }else{
                                $verComprar= "<td class='text-center' >
                                <a  $mostrar  class='btn btn-info btn-xs' href=".base_url('Compra/ComprarInsumo/'.$row->ID_UnidadMedida.'/'.$row->Abreviatura.'/'.$row->Insumo.'/'.$row->Cantidad.'/'.$row->ID_Insumo.'/'.$row->ID_Lista.'/'.$ID_ListaCompra.'/'.$CodUsuario).">Comprar</a>
                            </td>";
                            }
                            
                                echo"<tr>
     
                                <td width='10'>$row->Insumo</td>
                                $verComprar
                                <td><span class='badge badge-$color'>$comprado</span></td>
                                <td class='text-right' width='55'>$row->Cantidad $row->Abreviatura</td>
                                <td>$row->Familia</td>
                                <td>$row->Atributo1</td>
                                <td>$row->Atributo2</td>
                                <td>$verprecio</td>
                                $vereliminar
                                
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
      
		$('#t_compras').addClass('show').addClass('active');
        $('#t_lista').addClass('active');
        $('#m_compra_asigna').addClass('active');
        var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Lista</span>";

	});
    function baja(eliminar) {

swal({
        title: "¿Desea eliminar esta lista de compras?",
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
