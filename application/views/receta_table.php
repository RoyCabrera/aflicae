<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Receta/nuevo/'.$ID_Menu) ;?>'><div class="fab bg-warning"  > + </div></a>
</div>
<div class="row">
	<div class="col-md-8 offset-md-2">

	<div class="card">
		<div class="card-body" >




			<table class="table table-hover maestra">
				<thead class="text-center">
					<tr>
                        <th  class='text-left' >Insumo</th>

                        <th class='text-right'>Cantidad</th>
						<th class='w-20' ></th>
						<th class='w-20'></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if($Receta_list){
							foreach ($Receta_list->result() as $aux) {
							$ID = encriptar($aux->ID_Insumo);

							$rutaeliminar= base_url('Receta/eliminar/' . $ID_Menu."/".$ID);
							echo "
							<tr>
								<td> ". $aux->Insumo ."</td>

								<td class='text-right'>".  $aux->Cantidad ." ".$aux->Abreviatura. "</td>
								<td colspan='5' class='text-right'><a href='".base_url('Receta/receta/'.$ID.'/'.$ID_Menu)."'  ><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
								<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
							</tr>
							";

							}
						}
					?>
				</tbody>
			</table>


</div>

<div class="card-footer">
	<div class="row">


			<div class='text-right'>
				<a href='<?php echo  base_url('Menu'); ?>' class="btn btn-warning"
					style="-webkit-appearance: button-bevel;">Volver</a>
			</div>

	</div>
</div>


</div>



	</div>
</div>


<script>
	$(document).ready(function () {
		$('#m_maestros').addClass('show').addClass('active');
		$('#m_menu').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-building-o'></em> <span><?php echo $NombreMenu;?></span>";
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
