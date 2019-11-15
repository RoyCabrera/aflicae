<form action="<?php echo base_url('Pedido/insertar_venta') ?>" method="POST" id="frm">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<input type='hidden' name='ID_Compra' id="ID_Compra" value="<?php echo  encriptar($compra->ID_Compra); ?>">

			<div class="row">

				<div class='col-lg-8 offset-lg-2'>



<div class='col-lg-8 offset-lg-2'>
					<div class="form-group">
						<div class='row'>
							<div class='col-lg-12'>
								<label>Producto </label>
								<select class="form-control" name='ID_Insumo' id='ID_Insumo'>
									<option value=''>-- Seleccione --</option>
									<?php
										if($insumo_list){
												foreach($insumo_list->result() as $row){
													if($row->ID_Insumo == $compra->ID_Insumo)
													{
														echo "<option selected value='".$row->ID_Insumo."' >".$row->Insumo."</option>";}
													else
													{
													echo
													"<option value='".$row->ID_Insumo."'>".$row->Insumo.
													"</option>";
													}
										}
									}
										?>
								</select>
								<label>Almacen</label>
								<select class="form-control" name='ID_Almacen' id='ID_Almacen'>
									<option value=''>-- Seleccione --</option>
									<?php
										if($almacen_list) {
											foreach($almacen_list->result() as $row) {
												if($row->ID_Almacen == $compra->ID_Almacen)
													{
														echo "<option selected value='".$row->ID_Almacen."' >".$row->Almacen."</option>";}
													else
													{
													echo
													"<option value='".$row->ID_Almacen."'>".$row->Almacen.
													"</option>";
													}
											}
										}
									?>
								</select>
								<label for="cantidad">Cantidad</label>
								<input type="number" name="cantidad" id="cantidad" class="form-control text-right" value="<?php echo $compra->Cantidad ?>" step="0.1">

							</div>
						</div>
					</div>
				</div>
			</div>
            </div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-6 col-xs-12">
					<!--	<?php if($menu->ID_Menu) echo devolverUAFAUMFM($menu->UsuarioAlta,$menu->FechaAlta,$menu->UsuarioMod,$menu->FechaMod); ?>-->
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class='text-right'>
							<!-- <a href='<?php echo  base_url('Compra'); ?>' class="btn btn-warning"
								style="-webkit-appearance: button-bevel;" >Cancelar</a> -->
							<button class="btn btn-info" type="submit">Registrar venta</button>
						</div>
					</div>
				</div>
			</div>


	</div>
</form>


<script>
	$(document).ready(function () {
		$('#m_compra').addClass('active');
		var d = document.getElementById("titulomodulo");
		var ID = "<?php echo  $compra->ID_Compra ?>";
		if (ID) {
			d.innerHTML = "<em class='fa fa-cart-plus'></em><span>  Editar Venta </span>";
		} else {
			d.innerHTML = "<em class='fa fa-cart-plus'></em><span> Nueva Venta</span>";
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