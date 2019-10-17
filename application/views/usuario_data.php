<form action="<?php echo base_url('Usuario/actualizar') ?>" method="POST" id="frm" enctype="multipart/form-data">

<div class="card">
	<div class="card-body">
	<!-- START card tab-->

		<br>

        <input type='hidden' name='Insertar' value="<?php echo $Insertar; ?>" >
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
							<label>Correo</label>
							<input class="form-control" type="email" name='Correo' value="<?php echo $usuario->Correo; ?>" id='Correo' <?php if($usuario->Correo){ echo " readonly "; } ?> >
						</div>
						<div class='col-lg-6'>
							<label>Nombre</label>
							<input class="form-control" type="text" id='Nombre' value="<?php echo $usuario->Nombre; ?>" name='Nombre'>
						</div>
					</div>
                </div>

                <div class="form-group">
					<div class='row'>
                        <div class='col-lg-6'>
							<label>Apellido Paterno</label>
							<input class="form-control" type="text" id='ApellidoPaterno' value="<?php echo $usuario->ApellidoPaterno; ?>" name='ApellidoPaterno'>
						</div>
						<div class='col-lg-6'>
							<label>Apellido Materno</label>
							<input class="form-control" type="text" id='ApellidoMaterno' value="<?php echo $usuario->ApellidoMaterno; ?>" name='ApellidoMaterno'>
                        </div>

					</div>
                </div>
                <div class="form-group">
					<div class='row'>
                        <div class='col-lg-6'>
							<label>Perfil</label>
                            <select class="form-control" name='ID_Perfil' required id='ID_Perfil'>
								<option value=''>-- Seleccione --</option>
								<?php
												if($tipoperfil_list){
													foreach($tipoperfil_list->result() as $row){
														if($row->ID_Perfil == $usuario->ID_Perfil){
															echo "<option selected value='".$row->ID_Perfil."' >".$row->Perfil."</option>";
														}else{
															echo "<option value='".$row->ID_Perfil."' >".$row->Perfil."</option>";
														}
														
													}
												}

											?>
							</select>
						</div>
                        <div class='col-lg-6'>
							<label>Tipo Documento</label>
                            <select class="form-control" name='ID_TipoDocumento' id='ID_TipoDocumento'>
								<option value=''>-- Seleccione --</option>
								<?php
												if($tipodocumento_list){
													foreach($tipodocumento_list->result() as $row){
														echo "<option value='".$row->ID_TipoDocumento."' >".$row->TipoDocumento."</option>";
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
							<label>Documento</label>
							<input class="form-control" type="text" id='Documento' value="<?php echo $usuario->Documento; ?>" name='Documento'>
                        </div>
                        <div class='col-lg-6'>
							<label>Teléfono</label>
							<input class="form-control" type="text" id='Telefono' value="<?php echo $usuario->Telefono; ?>" name='Telefono'>
                        </div>
					</div>
                </div>
                <div class="form-group">
					<div class='row'>
                        <div class='col-lg-6'>
							<label>Clave</label>
							<input class="form-control" type="text" id='Clave' value="<?php echo $usuario->Clave; ?>" name='Clave'>
                        </div>

                        <div class='col-lg-6'>
								<label>Almacen</label>
								<select class="form-control" required name='ID_Almacen' id='ID_Almacen'>
									<option value=''>-- Seleccione --</option>
									<?php

										if($almacen_list){
												foreach($almacen_list->result() as $row){
													if($row->ID_Almacen == $usuario->ID_Almacen){
														echo "<option selected value='".$row->ID_Almacen."' >".$row->Almacen."</option>";
													}
													else{
														echo "<option value='".$row->ID_Almacen."' >".$row->Almacen."</option>";
													}

													}


										}

										?>
								</select>
							</div>
					</div>

                </div>
			</div>
		</div>
		</div>

		<div class="card-footer">
		  <div class="row">
				<div class="col-lg-6 col-xs-12">
					<?php
					date_default_timezone_set('America/Lima');
					if($usuario->Correo) echo devolverUAFAUMFM($usuario->UsuarioAlta,$usuario->FechaAlta,$usuario->UsuarioMod,$usuario->FechaMod); ?>
				</div>
				<div class="col-lg-6 col-xs-12">
					<div class='text-right'>
							<a href='<?php echo  base_url('Usuario'); ?>' class="btn btn-warning" style="-webkit-appearance: button-bevel;">Cancelar</a>
							<button class="btn btn-success" type="submit">Guardar</button>
					</div>
				</div>
			</div>
		</div>
</div>
</div></form>
<script>

	$(document).ready(function () {

		$('#<?php echo $tab; ?>1').addClass('active');
		$('#<?php echo $tab; ?>2').addClass('active');

		$('#frm').bootstrapValidator({
			feedbackIcons: {
				valid: 'fa fa-check-circle-o',
				invalid: 'fa fa-remove',
				validating: 'fa fa-refresh'
			},
			excluded: [':disabled'],
			fields: {
                Correo: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el correo'
						}
					}
				},
				Nombre: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el nombre'
						}
					}
				},
				Clave: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese la clave'
						}
					}
				},

                ApellidoPaterno: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el apellido paterno'
						}
					}
				},
				ID_TipoPerfil: {
					validators: {
						notEmpty: {
							message: 'Por favor, seleccione el tipo de perfil'
						}
					}
				}
			}
		});

		$('#imageview').attr('src', "<?php echo base_url($usuario->Imagen); ?>");
        $('#ID_Perfil').val(<?php echo $usuario->ID_Perfil; ?>);
        $('#ID_TipoDocumento').val(<?php echo $usuario->ID_TipoDocumento; ?>);
		$('#m_maestros').addClass('show').addClass('active');
		$('#m_usuario').addClass('active');
		var d = document.getElementById("titulomodulo");
		var ID = "<?php echo  $usuario->Correo; ?>";
		var Nombre = "<?php echo $usuario->Nombre." ".$usuario->ApellidoPaterno ." ".$usuario->ApellidoMaterno; ?>";
		if (ID) {
			d.innerHTML = "<em class='icon-people'></em><span>  Editar Usuario - " + Nombre + "</span>";
		} else {
			d.innerHTML = "<em class='icon-people'></em><span>  Nuevo Usuario</span>";
		}

		<?php

		if($usuario->Correo == "" || !$usuario->Imagen){
			echo " $('#imageview').attr('src','".base_url('assets/img/nofoto.png')."');";
		}

	?>

	});


	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
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
