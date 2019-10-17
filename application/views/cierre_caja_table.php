
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
            <a class="btn btn-info mb-3" href="<?= base_url('Caja/CierreCajaAll') ;?>">Ver todo</a>
			<table class="table table-hover maestra">
				<thead class="">
					<tr>
                         <th>Fecha Hora</th>
                         <th>Usuario cuadre</th>
						<th>Usuario cierre</th>
                        <th>Total de cierre detallado</th>
                        <th>Total</th>
                        <th>Cerrar caja</th>
                      
					</tr>
				</thead>
				<tbody id="">
                    <?php
                    if(isset($cierre_caja)){
                        foreach($cierre_caja->result() as $row){
                            if($row->UsuarioCierre == ""){
                                $cerrar="<form action='".base_url('Caja/CerrarCaja/')."' method='POST'>
                            <input type='hidden' name='ID_Cierre' value='$row->ID_Cierre'>
                            <input type='submit'  value='Cerrar Caja' class='btn btn-xs btn-inverse'>
                            </form>";
                            }else{
                                $cerrar = "";
                            }

                            $ID = encriptar($row->ID_Cierre);
                            $rutaeliminar= base_url('Caja/eliminarApertura/'.$ID);
                            echo "<tr>
                            <td>".date_format(date_create($row->FechaAlta), 'd/m/Y H:i:s')."</td>
                            <td>$row->Nombre $row->ApellidoPaterno $row->ApellidoMaterno</td>

                            <td>$row->NombreCierre $row->ApellidoPaternoCierre $row->ApellidoMaternoCierre</td>
                            <td>";
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
                            echo "</td>
                            <td>S/$row->total</td>
                            <td>$cerrar</td>
                           
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
    $('#cierre_caja').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fas fa-key'></em> <span>Cierre de caja</span>";


})
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
<?php
maestra();
?>
</script>