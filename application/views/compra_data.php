<form action="<?php echo base_url('Compra/actualizar') ?>" method="POST" id="frm">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
		

			<div class="row">

				<div class='col-lg-8 offset-lg-2'>

				<div class='col-lg-8 offset-lg-2'>
					<div class="form-group">
						<div class='row'>
							<div class='col-lg-12'>
								<label>Proveedor</label>
								<select class="form-control" name='ID_Proveedor' id='ID_Proveedor' required>
									<option value=''>-- Seleccione --</option>
									<?php
										if($lista_proveedores){
											foreach($lista_proveedores->result() as $row){
												
													echo
													"<option value='".$row->ID_Proveedor."'>".$row->Proveedor.
													"</option>";
												
											
											}
										}
										?>
								</select>
								<label>Producto o servicio</label>
								<input type="text" name="producto" class="form-control" id="producto">
								<label>Cantidad</label>
								<input type="number" name="cantidad" id="cantidad"  class="form-control text-right" value="" step="0.1">
								<label>Precio</label>
								<input type="text" name="precio" class="form-control" id="precio">
								
								

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
							
							<button class="btn btn-success" type="submit">Guardar</button>
						</div>
					</div>
				</div>
			</div>


	</div>
</form>


<script>
	$(document).ready(function () {

		$('#t_compras').addClass('show').addClass('active');
        $('#t_compradirecta').addClass('active');
		var d = document.getElementById("titulomodulo");
	  d.innerHTML = "<em class='far fa-arrow-alt-circle-right'></em> <span>Compra directa</span>";
		


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
