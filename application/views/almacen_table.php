<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Almacen/nuevo') ;?>'><div class="fab bg-warning"> + </div></a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead class="">
					<tr>
					 	<th>Fecha Hora</th>
						<th>Almacen Origen</th>
                        <th>Almacen Destino</th>
						<th>Insumo</th>
						<th class="text-right">Cantidad</th>
						<!-- <th></th>
						<th></th> -->
					</tr>
				</thead>
				<tbody>


			<?php
						if($traspaso_list){
							foreach ($traspaso_list->result() as $aux) {
							//$ID = encriptar($aux->ID_Compra);

							//$rutaeliminar= base_url('Compra/eliminar/' . $ID);


							echo "
							<tr>
							<td>".date_format(date_create($aux->FechaTraspaso), 'd/m/Y H:i:s')."</td>
							<td class = ''>".  $aux->AlmacenOrigen ."</td>
							<td class=''>".  $aux->AlmacenDestino."</td>
							<td class=''>".  $aux->Insumo ."</td>
							<td class='text-right'>".  $aux->Cantidad ." Kg</td>

							";

							}
						}

						/* <td class='w-20'><a href=''><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
						<td class='w-20'><a href='#'  onclick=\"return baja('')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
						</tr> */
			?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		$('#m_trapaso').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-truck'></em> <span>Lista de Traspasos</span>";
	});



	<?php maestra(); ?>
</script>

</html>
