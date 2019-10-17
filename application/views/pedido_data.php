<form action="<?php echo base_url('Pedido/actualizar') ?>" method="POST" id="frm">

<div class="card">
	<div class="card-body" >
	<!-- START card tab-->
		<input type='hidden' name='ID_Pedido' id="ID_Pedido" value="<?php echo  encriptar($pedido->ID_Pedido); ?>">
		<div class="row">
			<div class="col-lg-4 offset-lg-4 offset-xs-0">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
							<input type="hidden" value="<?= desencriptar($_SESSION['ID_Almacen'])?>" name="ID_Almacen">
							<label>Mesa</label>
							<select class="form-control" required name='ID_Mesa' id='ID_Mesa'>
								<option value=''>-- Seleccione --</option>
								<?php
									if($mesa_list){
										foreach($mesa_list->result() as $row){
											if($row->ID_Mesa == $pedido->ID_Mesa)
											{
												echo "<option selected value='".$row->ID_Mesa."' >".$row->Mesa."</option>";
											}
											else{
											echo "<option value='".$row->ID_Mesa."' >".$row->Mesa."</option>";
											}
										}
									}
									?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-12">
						<textarea  class="col-md-12 form-control" id="Observacion" name="Observacion"  rows="4" cols="50"><?php echo $pedido->Observacion; ?></textarea>
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
					<a href='<?php echo  base_url('Pedido'); ?>' class="btn btn-warning"
						style="-webkit-appearance: button-bevel;">Cancelar</a>
					<button class="btn btn-success" type="submit">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
</form>


<script>
	$(document).ready(function () {

		$('#m_pedido').addClass('active');
		var d = document.getElementById("titulomodulo");
		var ID = "<?php echo  $pedido->ID_Pedido ?>";

		if (ID) {
			d.innerHTML = "<em class='fa fa-pencil-square-o''></em><span>  Editar Pedido</span>";
		} else {
			d.innerHTML = "<em class='fa fa-pencil-square-o''></em><span>  Nuevo Pedido</span>";
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
