<form action="<?php echo base_url('Almacen/traspaso') ?>" method="POST" id="frm">

<div class="card">
	<div class="card-body" >

		<div class="row">
			<div class='col-lg-8 offset-lg-2'>
				<div class='col-lg-8 offset-lg-2'>
					<div class="form-group">
						<div class='row'>
							<div class='col-lg-12'>
								<label>Almacen Origen</label>
								<select class="form-control" name='ID_AlmacenOrigen' id='ID_AlmacenOrigen' required>
									<option value='' >-- Seleccione --</option>
									<?php
										if($almacen_list) {
											foreach($almacen_list->result() as $row) {
												echo "<option  value='".$row->ID_Almacen."' >".$row->Almacen."</option>";
											}
										}
									?>
								</select>
								<label>Almacen Destino</label>
								<select class="form-control" name='ID_AlmacenDestino' id='ID_AlmacenDestino' required>
									<option value=''>-- Seleccione --</option>
									<?php
										if($almacen_list) {
											foreach($almacen_list->result() as $row) {
												echo "<option  value='".$row->ID_Almacen."' >".$row->Almacen."</option>";
											}
										}
									?>
								</select>
								<label>Insumo</label>
								<br>
								<span><span>
								<select class="form-control" name='ID_Insumo' id='ID_Insumo' required>
									<option value=''>-- Seleccione --</option>
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


								<label for="cantidad">Cantidad</label>
								<input type="number" name="cantidad" id="cantidad" class="form-control text-right" value="<?php echo $traspaso->Cantidad ?>" step="0.1" required>
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
					<a href='<?php echo  base_url('Almacen'); ?>' class="btn btn-warning"
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

		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-truck'></em> <span>Iniciar un Traspaso</span>";

		$('#ID_AlmacenOrigen').change(function(){
			var almacenOrigen = document.getElementById("ID_AlmacenOrigen").value;
			insumoAlmacen(almacenOrigen);
		});
		$('#m_trapaso').addClass('active');



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
