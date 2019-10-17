<form action="<?php echo base_url('Compra/actualizarCompraInsumo') ?>" method="POST" id="frm">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<input type='hidden' name='ID_ListaCompra' id="ID_ListaCompra" value="<?php echo  $ID_ListaCompra; ?>">
			<input type='hidden' name='CodUsuario' id="CodUsuario" value="<?php echo  $CodUsuario; ?>">
			<div class="row">

			<div class='col-lg-8 offset-lg-2'>

				<div class='col-lg-8 offset-lg-2'>
					<div class="form-group">
						<div class='row'>
							<div class='col-lg-12'>
								<br>
								<input type="hidden" class='form-control' name='ID_Lista'  value="<?php echo $ID_Lista?>">
								<label for="cantidad">Insumo</label>
                                <select class="form-control" required name='ID_Insumo' id='ID_Insumo'>
									<option value=''>-- Seleccione --</option>
									<?php
										if($Insumo_list){
											foreach($Insumo_list->result() as $row){

												if($row->ID_Insumo == $ID_Insumo){
													echo "<option selected value='".$row->ID_Insumo."'>".$row->Insumo.
												"</option>";
												}else{
													echo "<option value='".$row->ID_Insumo."'>".$row->Insumo.
												"</option>";
												}	
										}
									}
										?>
								</select>

								<label for="cantidad">Cantidad requerida</label>
                                <input type="number" name="cantidad" id="cantidad" disabled required class="form-control text-right "  value="<?php echo $Cantidad ?>" >
                                
                                <label for="cantidad">Unidad de medida de Almacen</label>
								
								
								<input type="text" class='form-control' name='Abreviatura' id="Abreviatura" disabled value="<?php echo $Abreviatura?>">
								
								<label for="cantidadCompra">Cantidad a comprar</label>
								<input type="number" name="cantidadCompra" id="cantidadCompra"  required class="form-control text-right" value="<?php echo $Cantidad ?>" >

								<label for="precio">Precio (PEN)</label>
								<input type="number" name="precio" id="precio" step="0.01" required class="form-control text-right" >
								<div class="" id="UnidadMedida2"></div>
						<!-- 		<br>
								<p class="text-warning">Conversión</p>
								<hr>
								<label for="cantidad">Unidad de medida de Compra</label>
                                <select class="form-control" name='ID_UnidadMedidaCompra' id='ID_UnidadMedidaCompra'>
									<option value=''>-- Seleccione --</option>
									<?php
										if($Unidad_Medida){
											foreach($Unidad_Medida->result() as $row){
												echo "<option value='".$row->ID_UnidadMedida."'>".$row->UnidadMedida.
												"</option>";
											}
										}
										?>
								</select>
                                <label for="UnidadConversion">Cantidad a Conversion</label>
								<input type="number" class='form-control text-right ' name='UnidadConversion' id="UnidadConversion" value=""> -->
								<!-- <label for="UnidadConversion">Cantidad almacenar</label>
								<input id="target" name="CantidadConvertida" class="form-control" disabled type="text"> -->

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
							<a href='<?php echo  base_url('Compra/selectDetalleListaCompra/'.$ID_ListaCompra.'/'.$CodUsuario); ?>' class="btn btn-warning"
								style="-webkit-appearance: button-bevel;">Cancelar</a>
							<button class="btn btn-success" type="submit" >Guardar</button>
						</div>
					</div>
				</div>
			</div>


	</div>
</form>


<script>
	$(document).ready(function () {
      
	  $('#t_compras').addClass('show').addClass('active');
	  $('#t_lista').addClass('active');
	  $('#m_compra_asigna').addClass('active');
	  var d = document.getElementById("titulomodulo");
	  d.innerHTML = "<em class='fa fa-cart-plus''></em> <span>Comprar Insumo</span>";

  });

	$("#UnidadConversion").keyup(function() {
		var unidad = $("#cantidad").val();
		var a = $("#UnidadConversion").val();
		$("#target").val(parseInt(unidad)*parseInt(a));
	});

	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
	});

	function UnidadMedida(ID_Insumo){
		var ruta ="<?php echo base_url('Compra/UnidadMedidaInsumos');?>"+"/"+ID_Insumo ;
		$.ajax({
			type:"POST",
			url:ruta,
			success:function(data){
				
				$("#Abreviatura").val(data);
				
			}
		})

	}

	$('#ID_Insumo').change(function(){
			var ID_Insumo = document.getElementById("ID_Insumo").value;
			UnidadMedida(ID_Insumo);
		});


</script>
