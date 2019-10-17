<form action="<?php echo base_url('Insumo/actualizar') ?>" method="POST" id="frm">
<div class="col-md-8 offset-md-2 mt-4">

	<div class="card">
		<div class="card-body" >
			<!-- START card tab-->
			<?php
			if(isset($insumo->ID_Insumo)){

				$ID_Insumo=$insumo->ID_Insumo;
			}
			else{
				$ID_Insumo="";
			}

			$Perfil=desencriptar($_SESSION['ID_Perfil']);
			if($Perfil == 1 || $Perfil ==2){
				$mostrar="";
			}else{
				$mostrar ="disabled";
			}

			?>
			<input type='hidden' name='ID_Insumo' id="ID_Insumo" value="<?php echo  $ID_Insumo; ?>">

			<div class="row">
				<div class='col-lg-12 offset-lg-2'>
					<div class="form-group">
						<div class='row'>
							<div class='col-lg-4'>
								<label>Producto</label>
								<input required class="form-control" <?= $mostrar ?> type="text" name='Insumo' id='Insumo'
									value="<?php echo $insumo->Insumo; ?>">
							</div>
							<div class='col-lg-4'>
							<label>Unidad de Medida</label>
                            <select class="form-control" <?= $mostrar ?> required name='ID_UnidadMedida' id='ID_UnidadMedida'>
								<option value=''>-- Seleccione --</option>
								<?php
									if($Unidad_Medida){
										foreach($Unidad_Medida->result() as $row){
											if($row->ID_UnidadMedida == $insumo->ID_UnidadMedida) {
												echo "<option selected value='".$row->ID_UnidadMedida."' >".$row->UnidadMedida."</option>";
											}
											echo "<option value='".$row->ID_UnidadMedida."' >".$row->UnidadMedida."</option>";

										}
									}

								?>
							</select>
						</div>

						</div>
						<div class="row pt-4">
						<div class='col-lg-4'>
								<label>Costo</label>
								<input class="form-control text-right" <?= $mostrar ?>  type="text" name='Costo' id='Costo'
									value="<?php echo $insumo->Costo; ?>">
							</div>
							<div class='col-lg-4'>
								<label>Stock Minimo</label>
								<input class="form-control  text-right" type="text" <?= $mostrar ?>  name='stockmin' id='stockmin'
									value="<?php echo $insumo->StockMinimo; ?>" placeholder="Establezca el minimo en Kg">
							</div>
						</div>
						<div class="row pt-4">

						<div class='col-lg-8'>
							<label>Familia Insumo</label>
                            <select class="form-control" <?= $mostrar ?> required name='ID_Familia' id='ID_Familia'>
								<option value=''>-- Seleccione --</option>
								<?php
									if($FamiliaInsumo){
										foreach($FamiliaInsumo->result() as $row){
											if($row->ID_Familia == $insumo->ID_Familia) {
												echo "<option selected value='".$row->ID_Familia."' >".$row->Familia."</option>";
											}
											echo "<option value='".$row->ID_Familia."' >".$row->Familia."</option>";
										}
									}
								?>
							</select>
						</div>
						</div>
						<div class="row pt-4">
						<div class='col-lg-4'>
						<label>Atributo 1</label>
								<input class="form-control" type="text" <?= $mostrar ?>  name='Atributo1' id='Atributo1'
									value="<?php echo $insumo->Atributo1; ?>" placeholder="Atributo 1">
						</div>
							<div class='col-lg-4'>
								<label>Atributo 2</label>
								<input class="form-control" type="text" <?= $mostrar ?>  name='Atributo2' id='Atributo2'
									value="<?php echo $insumo->Atributo2; ?>" placeholder="Atributo 2">
							</div>
						</div>


					</div>
                    <br>
				</div>
            </div>

			<?php
			if(isset($insumo_almacen)){
				foreach($insumo_almacen->result() as $row){
					echo "<ul class='list-group'>
							<li class='list-group-item d-flex justify-content-between align-items-center'>".$row->Almacen."
								<span class='badge badge-dark badge-pill'>".$row->Stock." ".$row->Abreviatura."</span>
							</li>
						</ul>";
				}
			}


			?>

			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-6 col-xs-12">
					</div>
					<div class="col-lg-6 col-xs-12">
						<div class='text-right'>
							<a href='<?php echo  base_url('Insumo'); ?>' class="btn btn-warning"
								style="-webkit-appearance: button-bevel;">Volver</a>
								<?php 	if($Perfil == 1 || $Perfil==2):

								echo "<button class='btn btn-success'  type='submit'>Guardar</button>";
										endif;
								?>

						</div>
					</div>
				</div>
			</div>
	</div>

</div>


</form>

<?php
	$ID_Perfil=desencriptar($_SESSION['ID_Perfil']);
	if($ID_Perfil == 1 ||$ID_Perfil==2 ){
		$ver = "";
	}
	else{
		$ver = "style='display:none';";
	}
?>
<div class="col-lg-6" <?= $ver ?> >
		<button id="detalles" class="btn btn-green">Ver detalles</button>
</div>
<hr>
<div id="tabladetalles">
</div>

<script>
	$(document).ready(function () {

		$('#m_maestros').addClass('show').addClass('active');
		$('#m_insumo').addClass('active');
		var d = document.getElementById("titulomodulo");
		var id = "<?php echo  $insumo->ID_Insumo; ?>";
		var Nombre = "<?php echo $insumo->Insumo; ?>";

		if (id) {
			d.innerHTML = "<em class='fa fa-lemon-o'></em><span>  Editar Insumo - " + Nombre + "</span>";
		} else {
			d.innerHTML = "<em class='fa fa-lemon-o'></em><span>  Nuevo Insumo</span>";
		}

		$("#detalles").click(function(){
			var ID_Insumo = <?php echo  $ID_Insumo; ?> ;
			var ruta ="<?php echo base_url('Insumo/verDetalles');?>"+"/"+ID_Insumo;


			$.ajax({
				method: "POST",
				url: ruta,
				success:function(data){
					$("#tabladetalles").html(data);
				}


			})

		});

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
