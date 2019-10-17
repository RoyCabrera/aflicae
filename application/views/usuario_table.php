<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Usuario/nuevo') ;?>'><div class="fab bg-warning"  > + </div></a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead>
					<tr>
                        <th>Nombre</th>
						<th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Perfil</th>
						<th class='w-20'></th>
						<th class='w-20'></th>
					</tr>
				</thead>
				<tbody>
					<?php
											if($Usuario_list){
												foreach ($Usuario_list->result() as $aux) {
												$ID = encriptar($aux->Correo);
												$rutaeliminar= base_url('Usuario/baja/' . $ID);
												$rutaalta= base_url('Usuario/alta/' . $ID);
												$Imagen = base_url('assets/img/nofoto.png');
												//echo URL_RAIZ.$aux->ImagenThumbnail."<br>";
												if($aux->ImagenThumbnail && file_exists(URL_RAIZ.$aux->ImagenThumbnail)){
													$Imagen = base_url($aux->ImagenThumbnail);
												}

												$color = "";
												if($aux->Baja) $color = " style='background-color:lightgray;' ";

												echo "
                                                <tr ".$color." >
														<td><img src='".$Imagen."' class='rounded-circle' width='40px' height='40px' style='margin-right:10px' /> ". $aux->Nombre ."</td>
                                                        <td>".  $aux->ApellidoPaterno ."</td>
                                                        <td>".  $aux->ApellidoMaterno ."</td>
                                                        <td>".  $aux->Perfil ."</td>
														<td class='w-20'><a href='".base_url('Usuario/usuario/'.$ID)."'  ><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>";
														if($aux->Baja){
															echo "<td class='w-20'><a href='#'  onclick=\"return alta('" . $rutaalta  ."')\" ><em class='icon-arrow-up-circle color-tema' style='padding-right:5px'></em> </a></td>";
														}else{
															echo "<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-arrow-down-circle color-tema' style='padding-right:5px'></em> </a></td>";
														}

												echo "</tr>
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
		$('#m_usuario').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='icon-people'></em> <span>Lista de Usuarios</span>";
	});

	function baja(eliminar) {
		swal({
				title: "¿Desea dar de baja al usuario?",
				text: "Recuerde que no aparecerá en la lista y no podrá acceder al sistema",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Dar de baja!",
				closeOnConfirm: false
			},
			function () {
				swal("Dado de baja!", "Este usuario ha sido dado de baja", "success");
				window.location.href = eliminar;
			});
	}

	function alta(eliminar) {
		swal({
				title: "¿Desea dar de alta al usuario?",
				text: "Recuerde que aparecerá en la lista y podrá nuevamente acceder al sistema",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Dar de alta!",
				closeOnConfirm: false
			},
			function () {
				swal("Dado de alta!", "Este usuario ha sido dado de alta nuevamente", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
