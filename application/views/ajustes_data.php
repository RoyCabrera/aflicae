<form action="<?php echo base_url('Almacen/Ajuste') ?>" method="POST" id="frm">

<div class="row mt-3">
	<div class="col-xs-12 offset-xs-0 col-lg-6 offset-lg-3 col-md-6 offset-md-3">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
				<div class="mb-3">
						<label>Tipo</label>
						<select class="form-control" name='Tipo' id='Tipo' required>
							<option value=''>-- Seleccione --</option>
							<option value='Entrada' >Entrada</option>
							<option value='Salida' >Salida</option>;
						</select>
					</div>
					<div class="mb-3">
						<label>Local</label>
						<select class="form-control" name='ID_AlmacenOrigen' id='ID_AlmacenOrigen' required>
							<option value=''>-- Seleccione --</option>
							<?php
								if($almacen_list) {
									foreach($almacen_list->result() as $row) {
										echo "<option  value='".$row->ID_Almacen."' >".$row->Almacen."</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label>Insumo</label>
						<select class="form-control" name='ID_Insumo' id='ID_Insumo' required>
							<option value=''>-- Seleccione Local --</option>
							<?php
								if(isset($insumoAlmacen)){
									foreach($insumoAlmacen->result() as $row){

										echo
										"<option value='".$row->ID_Insumo."'>".$row->Insumo.
										"</option>";
									}
								}
								?>
						</select>
					</div>
					<label for="cantidad">Cantidad a quitar del almacen</label>
					<input type="number" name="cantidad" id="cantidad" class="form-control text-right" value="<?php echo $ajustes->Cantidad ?>" step="0.1" required>
				</div>
			</div>
			<div class="card-footer">

				<div class='text-right'>
					<!-- <a href='<?php //echo  base_url('Insumo/ajustes'); ?>' class="btn btn-warning"
						style="-webkit-appearance: button-bevel;" type="button">Cancelar</a> -->
					<button class="btn btn-success" type="submit">Guardar</button>
				</div>

			</div>
		</div>
	</div>
</div>
</form>
<script>
	$(document).ready(function () {

		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-wrench'></em> <span>Ajustes de stock para los insumos</span>";

		$('#ID_AlmacenOrigen').change(function(){
			var almacenOrigen = document.getElementById("ID_AlmacenOrigen").value;
			insumoAlmacen(almacenOrigen);
		});
		$('#m_ajustes').addClass('active');



	});

	function insumoAlmacen(almacen){
		var ruta ="<?php echo base_url('Almacen/insumoAlmacen');?>"+"/"+almacen ;
		$.ajax({
			type:"POST",
			url:ruta,
			success:function(data){
				//data="<option>insumos</option>"
				$("#ID_Insumo").html(data);
				$("#Stock").html("<label>Stock Actual</label><input class='form-control' type='number' disabled>");
			}
		})

	}
	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
	});

	$('#ID_Insumo').change(function(){
			var almacenOrigen = $('#ID_Insumo').text();

		});


</script>
