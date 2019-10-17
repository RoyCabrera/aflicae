<?php
    if($existe_apertura->num_rows() >= 1){
     

    }else{
        echo "<div class='pb-4'>

        <a class='btn btn-outline-info' href='".base_url('Caja/apertura_caja')."'>Aperturar caja<em class='fas fa-dollar pl-2'></em></a>
        </div>";
    }
?>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">

			<table class="table table-hover maestra2">
				<thead class="">
					<tr>
                         <th>Fecha Hora</th>
                         <th>Nombre</th>
                         <th>Detalle de Apertura</th>
                        <th>Total de apertura</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
					</tr>
				</thead>
				<tbody id="">
                    <?php
                    if(isset($apertura_cajas)){
                        date_default_timezone_set('America/Lima');
                        $now = new DateTime();
                        $dia = $now->format('d');
                        $mes = $now->format('m');
                        $anio = $now->format('Y');
                        foreach($apertura_cajas->result() as $row){
                            $ID = encriptar($row->ID_Apertura);
                            

                            $FechaDiaAlta= date_format(date_create($row->FechaAlta), 'd');
                            $FechaMesAlta= date_format(date_create($row->FechaAlta), 'm');
                            $FechaAnioAlta= date_format(date_create($row->FechaAlta), 'Y');

                            
                            if($FechaDiaAlta==$dia && $FechaMesAlta==$mes && $FechaAnioAlta == $anio){
                                $resaltarHoy="text-bold";
                            }else{
                                $resaltarHoy="";
                            }
                            if($existe_pedido->num_rows() < 1 && $FechaDiaAlta==$dia && $FechaMesAlta==$mes && $FechaAnioAlta == $anio){
                                
                                $editar="<a href='".base_url('Caja/actualizarApertura_caja/'.$ID)."' class='alert-link font-weight-bold'><em class='icon-pencil color-tema'></em></a>";
                               
                            }else{
                                $editar="";
                                
                            }
                           
                            
                            $rutaeliminar= base_url('Caja/eliminarApertura/'.$ID);
                            echo "<tr>
                            <td class='$resaltarHoy'>".date_format(date_create($row->FechaAlta), 'd/m/Y H:i:s')."</td>
                            <td class='$resaltarHoy'>$row->Nombre $row->ApellidoPaterno $row->ApellidoMaterno</td>
                            
                            <td class='$resaltarHoy'>";
                            $lista = "";
                            if($row->Q00010!=0){
                                $lista=$lista." S/0.10 (".$row->Q00010.")";
                            }
                            if($row->Q00020!=0){
                                $lista=$lista." S/0.20 (".$row->Q00020.")";
                            }
                            if($row->Q00050!=0){
                                $lista=$lista." S/0.50 (".$row->Q00050.")";
                            }
                            if($row->Q00100!=0){
                                $lista=$lista." S/1 (".$row->Q00100.")";
                            }
                            if($row->Q00200!=0){
                                $lista=$lista." S/2 (".$row->Q00200.")";
                            }
                            if($row->Q00500!=0){
                                $lista=$lista." S/5 (".$row->Q00500.")";
                            }
                            if($row->Q01000!=0){
                                $lista=$lista." S/10 (".$row->Q01000.")";
                            }
                            if($row->Q02000!=0){
                                $lista=$lista." S/20 (".$row->Q02000.")";
                            }
                            if($row->Q05000!=0){
                                $lista=$lista." S/50 (".$row->Q05000.")";
                            }
                            if($row->Q10000!=0){
                                $lista=$lista." S/100 (".$row->Q10000.")";
                            }
                            if($row->Q20000!=0){
                                $lista=$lista." S/200 (".$row->Q20000.")";
                            }

                            echo $lista;
    
                            echo"</td>
                            <td>S/$row->total</td>
                            <td class='$resaltarHoy'>$editar</td>
                            <td class='w-20' class='$resaltarHoy'>
                                <a href='#'  onclick=\"return baja('$rutaeliminar')\" >
                                    <em class='icon-trash color-tema'></em>
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
$(document).ready(function(){
    $('#caja').addClass('show').addClass('active');
    $('#apertura_caja').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-history'></em> <span>Historial de apertura de caja</span>";


})
function baja(eliminar) {

swal({
    title: "¿Desea eliminar esta apertura de caja?",
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
<?php
maestra2();
?>
</script>