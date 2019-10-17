<style>
.pagination:{
	display:none;
}
</style>
<form action="<?php echo base_url('Compra/comprar') ?>" method="POST" id="frm">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<input type='hidden' name='ID_Compra' id="ID_Compra" value="">
			<input type='hidden' name='CodUsuario' value="<?php echo $CodUsuario ?>">
			<input type='hidden' name='ID_ListaCompra' value="<?php echo $ID_ListaCompra ?>">
										
				<div class='col-lg-12'>
					<div class='col-lg-12'>
					<div class="form-group">
                        <div class="row pt-2 pb-2">
                        <table  class="table table-responsive-xl table-xs">
							<thead>
								<tr>
									<th>Insumos</th>
									
									<th>Precio Establecido</th>
									<th>Stock</th>
									<th>Stock Minimo</th>
									<th> Cantidad</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									if($Insumo_list){
										
										
										foreach ($Insumo_list as $aux) {
										$ID = encriptar($aux['ID_Insumo']);
										
										
										echo "
										<tr>
											<td height='10'> ". $aux['Insumo'] ."</td>
											
											<td id='costo'>S/ ".  $aux['Costo'] ."</td>
											<td id='stock'>".  $aux['Stock']." ". $aux['Abreviatura'] ."</td>
											<td id='stockmin'>".$aux['StockMinimo']." ". $aux['Abreviatura']."</td>
											<td width='150'><input type='number' class='form-control text-right' id='comprar' name='comprar[". $aux['ID_Insumo'] ."]'/></td>
										</tr>
										";

										}
									}
								?>
							</tbody>
						</table>

						</div>
					</div>
					</div>
            	</div>
			<div class="card-footer">
					<div class="col-lg-12">
						
							<button class="btn btn-success" type="submit">Guardar</button>
						
					</div>
				</div>
			


	</div>
</form>


<script>
	$(document).ready(function () {
        $('#t_compras').addClass('show').addClass('active');
        $('#t_lista').addClass('active');

        var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Armar lista</span>";

	});


	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
	});
	<?php maestra(); ?>

</script>
