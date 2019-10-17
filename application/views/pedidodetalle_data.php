
<form action="<?php echo base_url('Pedido/actualizardetalle') ?>" method="POST" id="frm">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<input type='hidden' name='ID_Pedido' id="ID_Pedido" value="<?php echo  encriptar($pedidodetalle->ID_Pedido); ?>">
			<input type='hidden' name='ID_LPedido' id="ID_LPedido" value="<?php echo  encriptar($pedidodetalle->ID_LPedido); ?>">
			<input type='hidden' name='ID_Estado' id="ID_Estado" value="<?php echo  encriptar($pedidodetalle->ID_Estado); ?>">

			<div class="row">
				<div class='col-lg-8 offset-lg-2'>
					<div class='col-lg-8 offset-lg-2'>
						<div class="form-group">

							<div class='row'>

								<div class='col-lg-6'>
								<label>Entrada</label>
								<select class="form-control"  name='ID_Entrada' id='ID_Entrada'>
									<option value=''>-- Seleccione --</option>
									<?php
									$ID_Almacen= desencriptar($_SESSION['ID_Almacen']);
										if($menu_list){
											foreach($menu_list->result() as $row){

												if($row->MenuHoy == 1 && $ID_Almacen == 1){
													$hoy="---Menú";
												}
												elseif(($row->MenuHoy2 == 1 && $ID_Almacen == 2)){
													$hoy="---Menú";
												}
												elseif($row->MenuHoy3 == 1 && $ID_Almacen == 3){
													$hoy="---Menú";
												}
												else {
													$hoy="---Carta";
												}

												if($row->ID_Familia == 3) {
													if($row->ID_Menu== $pedidodetalle->ID_Menu)
													{
														echo "<option selected value='".$row->ID_Menu."' >".$row->Menu."---".$hoy."</option>";
													}
													else {
														echo "<option  value='".$row->ID_Menu."' >".$row->Menu."---".$hoy."</option>";
													}
												}

											}
										}
										?>
								</select>
								</div>


								<div class='col-lg-6'>
										<label>Segundo</label>
										<select class="form-control"  name='ID_Segundo' id='ID_Segundo'>
											<option value=''>-- Seleccione --</option>
											<?php
												if($menu_list){
													foreach($menu_list->result() as $row){
														if($row->MenuHoy == 1 && $ID_Almacen == 1){
															$hoy="---Menú";
														}
														elseif(($row->MenuHoy2 == 1 && $ID_Almacen == 2)){
															$hoy="---Menú";
														}
														elseif($row->MenuHoy3 == 1 && $ID_Almacen == 3){
															$hoy="---Menú";
														}
														else {
															$hoy="---Carta";
														}
														if($row->ID_Familia == 2){
															if($row->ID_Menu== $pedidodetalle->ID_Menu){
																echo "<option selected id=".$hoy." value='".$row->ID_Menu."' >".$row->Menu."---".$hoy." </option>";
															}
															else {
																echo "<option id=".$hoy." value='".$row->ID_Menu."' >".$row->Menu."---".$hoy." </option>";
															}
														}

													}
												}
												?>
										</select>
								</div>

							</div>
							<div class='row'>
								<div class='col-lg-6'>
									<label>Bebida</label>
									<select class="form-control" name='ID_Postre' id='ID_Postre'>
									<option value=''>-- Seleccione --</option>
										<?php
											if($menu_list){
												foreach($menu_list->result() as $row){
													if($row->MenuHoy == 1 && $ID_Almacen == 1){
														$hoy="Menú";
														$selected = "selected";
													}
													elseif(($row->MenuHoy2 == 1 && $ID_Almacen == 2)){
														$hoy="Menú";
														$selected = "selected";
													}
													elseif($row->MenuHoy3 == 1 && $ID_Almacen == 3){
														$hoy="Menú";
														$selected = "selected";
													}
													else {
														$hoy="Carta";
														$selected = "";
													}

													if($row->ID_Familia == 4){



														if($row->ID_Menu== $pedidodetalle->ID_Menu){
															echo "<option $selected selected value='".$row->ID_Menu."' >".$row->Menu."---".$hoy."</option>";
														}
														else {

															echo "<option $selected value='".$row->ID_Menu."' >".$row->Menu."---".$hoy."</option>";
														}
													}

												}
											}
											?>
									</select>
								</div>
								<div class='col-lg-6'>
									<label>Almacen</label>
									<select class="form-control" name='ID_Almacen' id='ID_Almacen'>
										<option value=''>-- Seleccione --</option>
										<?php
										$ID_Almacen= desencriptar($_SESSION['ID_Almacen']);
											if($almacen_list){
												foreach($almacen_list->result() as $row){
													if($row->ID_Almacen == $pedidodetalle->ID_Almacen || $row->ID_Almacen == $ID_Almacen)
													{

															echo "<option selected value='".$row->ID_Almacen."' >".$row->Almacen."</option>";


													}
													else {
															echo "<option value='".$row->ID_Almacen."' >".$row->Almacen."</option>";}
												}

											}

											?>
									</select>

								</div>
							</div>
							<hr>
								<input type='hidden' name='Cantidad' id="Cantidad" class="form-control text-right" value="<?php echo  $pedidodetalle->Cantidad; ?>">
							<div class='row'>
								<div class="col-lg-12">
								<label>Observación</label>
								<textarea  class="col-md-12 form-control" id="Observacion" name="Observacion"  rows="4" cols="50"><?php echo $pedidodetalle->Observacion; ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-lg-6 col-xs-12">

				</div>
				<div class="col-lg-6 col-xs-12">
					<div class='text-right'>
						<?php $ID = $pedidodetalle->ID_Pedido ?>

							<a href='<?php echo  base_url('Pedido'); ?>' class="btn btn-warning" style="-webkit-appearance: button-bevel;">Cancelar</a>

							<!-- <a href='<?php echo  base_url('Pedido/detalle/'.encriptar($ID)); ?>' class="btn btn-info"
								style="-webkit-appearance: button-bevel;">Ver orden</a>
								 -->
							<!-- <a href='<?php //echo  base_url('Pedido/posicionMesa/'.$ID); ?>' class="btn btn-info"
							style="-webkit-appearance: button-bevel;">volver Mesa</a> -->


						<button class="btn btn-success" type="submit">Guardar</button>

					</div>
				</div>
			</div>
		</div>
	</div>

</form>


<script>
	$(document).ready(function () {
		/*$('#ID_Almacen').change(function(){
			var almacen = document.getElementById("ID_Almacen").value;
			alert(almacen);
		});*/

		$('#m_pedido').addClass('active');
		var d = document.getElementById("titulomodulo");
		var ID = "<?php echo  $pedidodetalle->ID_LPedido; ?>";

		if (ID) {
			d.innerHTML = "<em class='fa fa-cutlery'></em><span>  Editar orden</span>";
		} else {
			d.innerHTML = "<em class='fa fa-cutlery'></em><span>  Nueva orden</span>";
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
