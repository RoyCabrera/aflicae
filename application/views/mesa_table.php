<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Mesa/nuevo') ;?>'><div class="fab bg-warning"  > + </div></a>
</div>
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead>
					<tr>
                        <th>Mesa</th>
						<th>Almacén</th>
						<th class='w-20'></th>
						<th class='w-20'></th>
					</tr>
				</thead>
				<tbody>


					<?php


											if($Mesa_list){
												foreach ($Mesa_list->result() as $aux) {
												$ID = encriptar($aux->ID_Mesa);

												$rutaeliminar= base_url('Mesa/eliminar/'.$ID);


												echo "
                                                <tr>
														<td> ". $aux->Mesa ."</td>
														<td>".$aux->Almacen."</td>
														<td class='w-20'><a href='".base_url('Mesa/mesa/'.$ID)."'  ><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
														<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
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
		$('#m_mesa').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-building-o'></em> <span>Lista de Mesa</span>";
	});

	function baja(eliminar) {
		swal({
				title: "¿Desea eliminar este Mesa?",
				text: "Recuerde que no aparecerá en la lista",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Eliminar!",
				closeOnConfirm: false
			},
			function () {
				swal("Eliminar!", "Este Mesa ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
