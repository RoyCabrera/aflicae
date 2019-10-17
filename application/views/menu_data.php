<form action="<?php echo base_url('Menu/actualizar') ?>" method="POST" id="frm" enctype="multipart/form-data">
<div class="card">
	<div class="card-body">
	<!-- START card tab-->

		<br>

        <input type='hidden' name='ID_Menu' id="ID_Menu" value="<?php echo  encriptar($menu->ID_Menu); ?>">
		<div class="row">

			<div class='col-lg-6'>

				<input type='hidden' name='Imagen' id='image'>
				<div class="row" style="text-align: -webkit-center;display: block;">
					<img id='imageview' src="" alt="Imagen" width="300px" height="200px">
				</div>
				<br>
				<div class='col-lg-4 offset-lg-4'>
					<div class="form-group">
						<input class="form-control filestyle" style="width:100%" id="file" name="file" type="file" data-input="false"
						data-classbutton="btn btn-secondary" data-classinput="form-control inline" data-text="Subir Imagen" data-icon="&lt;span class='fa fa-upload mr-2'&gt;&lt;/span&gt;">
					</div>
				</div>
			</div>


            <div class='col-lg-6'>

				<div class="form-group">
					<div class='row'>
						<div class='col-lg-6'>
							<label>Menu</label>
							<input class="form-control" type="text" name='Menu' id='Menu'
									value="<?php echo $menu->Menu; ?>" required>
						</div>
						<div class='col-lg-6'>
						<label>Familia</label>
								<select required class="form-control" name='ID_Familia' id='ID_Familia'>
									<option value=''>-- Seleccione --</option>
									<?php
										if($familia_list){
											foreach($familia_list->result() as $row){
												if($row->ID_Familia== $menu->ID_Familia)
												{
													echo "<option selected value='".$row->ID_Familia."' >".$row->Familia."</option>";}
													else
															{
													echo "<option value='".$row->ID_Familia."' >".$row->Familia."</option>";}
												}

										}

										?>
								</select>
                        </div>

					</div>
                </div>
				<div class="form-group">
					<div class='row'>
					<div class='col-lg-6'>
							<label>Precio</label>
							<input required class="form-control text-right" type="text" name='Precio' id='Precio'
									value="<?php echo $menu->Precio; ?>">
						</div>
                        <div class='col-lg-6'>
							<label>Precio Delivery</label>
							<input required class="form-control text-right" type="text" name='PrecioDelivery' id='CoPrecioDeliverysto' required
									value="<?php echo $menu->PrecioDelivery; ?>">
						</div>
					</div>
                </div>

                <div class="form-group">
					<div class='row'>
                        <div class='col-lg-6'>
							<label>Costo</label>
							<input required class="form-control text-right" type="text" name='Costo' id='Costo'
									value="<?php echo $menu->Costo; ?>">
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
							<a href='<?php echo  base_url('Menu'); ?>' class="btn btn-warning"
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
		var id = "<?php echo $menu->ID_Menu; ?>";

		if(id){
			d.innerHTML = "<em class='fa fa-cutlery'></em> <span>Editar Plato</span>";
		}else{
			d.innerHTML = "<em class='fa fa-cutlery'></em> <span>Nuevo Plato</span>";
		}


		$('#imageview').attr('src', "<?php echo base_url($menu->ImagenMenu); ?>");


		<?php
		if($menu->Menu == "" || !$menu->ImagenMenu){

			echo " $('#imageview').attr('src','".base_url('assets/img/nofoto.png')."');";

		}
		?>

	});


	$('#file').change(function () {
		var file = document.querySelector('input[name=file]').files[0];

		var reader = new FileReader();
		reader.onloadend = function () {
			$('#imageview').attr("src", reader.result);
			if($('#imageview').attr("src")){
				$('#image').val($('#imageview').attr("src"));
			}
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	});


</script>
