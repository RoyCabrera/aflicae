<style>
#stockmin,#stock,#costo,#StockPorAlmacen {
	text-align: right;
}
#UnidadMedida {
	text-align:center;
}
</style>
<?php

$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
if($ID_Perfil==1 || $ID_Perfil ==2){
	$mostrar="";
}else{
	$mostrar="style='display:none'";
}

?>
<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Insumo/nuevo') ;?>' <?= $mostrar ?> ><div class="fab bg-warning"  > + </div></a>
</div>
<div class="row">
	<div class="col-md-10 offset-md-1">
		<div class="table-responsive">
			<table class="table  maestra">
				<thead>
					<tr>
                        <th class="text-left">Producto</th>

                        <th class="text-right">Costo</th>
                        <th class="text-right">Stock</th>
						<th class="text-right">Stock por Almacén propio</th>
						<th class="text-right">Unidad de Medida</th>
                        <th class="text-right">Stock Minimo</th>
						<th class='w-20'></th>
						<th class='w-20'></th>
					</tr>
				</thead>
				<tbody>


			<?php


				if($Insumo_list){
					foreach ($Insumo_list as $aux) {
					$ID = encriptar($aux['ID_Insumo']);
						if($aux['StockAlmacen'] == ""){
							$stockPorAlmacen = 0;
						}
						else{
							$stockPorAlmacen = $aux['StockAlmacen'];
						}
					$rutaeliminar= base_url('Insumo/eliminar/' . $ID);

					if($aux['Stock'] < $aux['StockMinimo']){
						$danger="class=''";

					}else{
						$danger='';
					}


					echo "
					<tr>
							<td ".$danger."> ". $aux['Insumo'] ."</td>

							<td ".$danger." id='costo'>S/ ".  $aux['Costo'] ."</td>
							<td ".$danger." id='stock'>".  $aux['Stock']." ". $aux['Abreviatura'] ."</td>

							<td ".$danger." id='StockPorAlmacen'>".  $stockPorAlmacen ." ". $aux['Abreviatura']." </td>

							<td ".$danger." id='UnidadMedida'>".  $aux['UnidadMedida'] ."</td>

							<td ".$danger." id='stockmin'>".$aux['StockMinimo']." ". $aux['Abreviatura']."</td>
							<td class='w-20 text-right'><a href='".base_url('Insumo/insumo/'.$ID)."'  ><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
							<td class='w-20 text-right'><a href='#' $mostrar onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
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
	$('#m_maestros').addClass('show').addClass('active');
		$('#m_insumo').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-lemon-o'></em> <span>Lista de Insumos</span>";
	});

	function baja(eliminar) {
		swal({
				title: "¿Desea eliminar este Insumo?",
				text: "Recuerde que no aparecerá en la lista",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Eliminar!",
				closeOnConfirm: false
			},
			function () {
				swal("Eliminar!", "Este Insumo ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
