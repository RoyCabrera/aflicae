<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Compra/nuevo_afliace') ;?>'><div class="fab bg-warning"> + </div></a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead class="">
					<tr>
					 	<th>Fecha Hora</th>
						<th>Producto</th>
						<th>Almacen</th>
						<th class="text-right">Cantidad</th>
					</tr>
				</thead>
				<tbody>


			<?php
						if($compra_list){
							foreach ($compra_list->result() as $aux) {
							$ID = encriptar($aux->ID_Compra);
							$rutaeliminar= base_url('Compra/eliminar/' . $ID);
							echo "
							<tr>
							<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
							<td class = ''>".  $aux->Insumo ."</td>
							<td class=''>".  $aux->Almacen ."</td>
							<td class='text-right'>".  $aux->Cantidad."</td>
							</tr>
							";
							}
						}
						/*
						<td class='w-20'><a href='".base_url('Compra/compra/'.$ID)."'><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
							<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
						*/
			?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#m_compra').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-cart-plus'></em> <span>Lista de Compras</span>";
	});
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
			function () {
				swal("Eliminar!", "Este Menu ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}
	<?php maestra(); ?>
</script>

</html>