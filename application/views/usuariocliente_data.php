<form action="<?php echo base_url('Usuario/actualizarCliente') ?>" method="POST" id="frm" enctype="multipart/form-data">

<div class="card">
	<div class="card-body">
	<!-- START card tab-->

		<br>

		<input type ="hidden" class="form-control" name='Perfil' id='Perfil' disabled value="<?php echo $usuario->ID_Perfil ?>">


	<input type="hidden" class="form-control" name='Almacen' id='Almacen' disabled value="<?php echo $usuario->ID_Almacen; ?>">


        <input type='hidden' name='Insertar' value="<?php echo $Insertar; ?>" >
		<div class="row">
			<div class="col-lg-3"></div>
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
						<div class='col-lg-6'>
							<label>Documento</label>
							<input class="form-control" type="text" id='Documento' value="<?php echo $usuario->Documento; ?>" name='Documento'>
                        </div>
					</div>
                </div>
                <div class="form-group">
					<div class='row'>
                        <div class='col-lg-6'>
							<label>Teléfono</label>
							<input class="form-control" type="text" id='Telefono' value="<?php echo $usuario->Telefono; ?>" name='Telefono' required>
                        </div>
					</div>
                </div>

				<div class="form-group">
					<div class="row">
						<div class='col-lg-6'>
							<label>Dirección</label>
							<input type="text" class="form-control" name='Direccion' value="<?php echo $usuario->Direccion; ?>"" id='Direccion' required>
						</div>
						<div class='col-lg-6'>
								<label>Distrito</label>
								<select class="form-control" name='Distrito' id='Distrito' required>
									<option value=''>-- Seleccione --</option>
									<?php
										if($distrito_list){
											foreach($distrito_list->result() as $row){
												echo "<option value='".$row->Distrito."' >".$row->Distrito."</option>";
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
							<label>Clave</label>
							<input class="form-control" type="password" id='Clave' value="<?php echo $usuario->Clave; ?>" name='Clave' >
                        </div>
						<div class='col-lg-6'>
							<label>Confirmar Clave</label>
							<input class="form-control" type="password" name="ClaveConfirm" id='ClaveConfirm' value="" >
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
										<a href='<?php echo  base_url('Usuario'); ?>' class="btn btn-warning" style="-webkit-appearance: button-bevel;"
											type="button">Cancelar</a>
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
                ApellidoPaterno: {
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el apellido paterno'
						}
					}
				},
				ApellidoMaterno:{
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el apellido materno'
						}
					}
				},
				Documento:{
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el documento'
						}
					}
				},
				direccion:{
					validators: {
						notEmpty: {
							message: 'Por favor, ingrese el documento'
						}
					}
				},

				ID_TipoPerfil: {
					validators: {
						notEmpty: {
							message: 'Por favor, seleccione el tipo de perfil'
						}
					}
				},
				Clave: {
                validators: {
                    identical: {
                        field: 'ClaveConfirm',
                        message: 'Confirme la clave'
                    }
                }
				},
				ClaveConfirm: {
					validators: {
						identical: {
							field: 'Clave',
							message: 'La clave y su confirmación no son las mismas.'
						}
					}
				}
			}
		});

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

