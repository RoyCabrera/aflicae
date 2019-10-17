<form action="<?php echo base_url('Receta/actualizar') ?>" method="POST" id="frm">
	<div class="col-md-8 offset-md-2 mt-4">
	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<input type='hidden' name='ID_Menu' id="ID_Menu" value="<?php echo  encriptar($receta->ID_Menu); ?>">
			<div class="row">
			<?php

			if(isset($nuevo)){
				$existe=$nuevo;
			}
			else{
				$existe="";
			}
			?>
				<input type="hidden" name="nuevo" value="<?php echo $existe ?>">
				<div class='col-lg-12 offset-lg-2'>
						<div class="form-group">
							<div class='row'>
								<div class='col-lg-4'>
									<label>Insumo</label>
									<select class="form-control" name='ID_Insumo' id='ID_Insumo'>
										<option value=''>-- Seleccione --</option>
										<?php
											if($Insumo_list){
													foreach($Insumo_list->result() as $row){
														if($row->ID_Insumo== $receta->ID_Insumo)
														{
																echo "<option selected value='".$row->ID_Insumo."' >".$row->Insumo."</option>";}
																else
																		{
																echo "<option value='".$row->ID_Insumo."' >".$row->Insumo."</option>";}
														}

											}

											?>
									</select>
								</div>
								<div class='col-lg-4 text-right'>
									<label>Cantidad</label>
									<input class="form-control text-right" type="text" name='Cantidad' id='Cantidad'
										value="<?php echo $receta->Cantidad; ?>">
								</div>

							</div>
						</div>
						<br>


				</div>
            </div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-lg-6 col-xs-12">
				</div>
				<div class="col-lg-6 col-xs-12">
					<div class='text-right'>
						<a href='<?php echo  base_url('Receta/Insumo/'.encriptar($receta->ID_Menu)); ?>' class="btn btn-warning"
							style="-webkit-appearance: button-bevel;">Cancelar</a>
						<button class="btn btn-success" type="submit">Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

</form>






<script>
	$(document).ready(function () {


	 	$('#m_maestros').addClass('show').addClass('active');
		$('#m_menu').addClass('active');
		var d = document.getElementById("titulomodulo");
		var id = "<?php echo  $receta->ID_Insumo; ?>";

		if (id) {
			d.innerHTML = "<em class='fa fa-cutlery'></em><span>  Editar Insumo</span>";
		} else {
			d.innerHTML = "<em class='fa fa-cutlery'></em><span>  Nuevo Insumo</span>";
		}


	});


	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
	});


</script>
