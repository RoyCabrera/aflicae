<form action="<?php echo base_url('Configuracion/actualizar') ?>" method="POST" id="frm" enctype="multipart/form-data">

    <div class="card">
        <div class="card-body">
            <!-- START card tab-->

            <br>


            <div class="row">

                <div class='col-lg-6'>
                    <input type="hidden" value="<?php echo encriptar($configuracion->ID_Empresa) ?>" name="ID_Empresa">
					<input type='hidden' name='Imagen' id='image'>
				<div class="row" style="text-align: -webkit-center;display: block;">
					<img id='imageview' src="" alt="Imagen" width="350px" height="350px">
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
				<strong class="text-info">Información de la Empresa</strong>
					<hr>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                <label>Nombre</label>
                                <input class="form-control" type="text" name='Empresa'
                                    value="<?php echo $configuracion->Empresa; ?>" id='Empresa'>
                            </div>
                            <div class='col-lg-6'>
                                <label>RUC</label>
                                <input class="form-control" type="text" id='Ruc'
                                    value="<?php echo $configuracion->Ruc; ?>" name='Ruc'>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-12'>
                                <label>Dirección</label>
                                <input class="form-control" type="text" id='Direccion'
                                    value="<?php echo $configuracion->Direccion; ?>" name='Direccion'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                <label>Correo</label>
                                <input class="form-control" type="email" id='Correo'
                                    value="<?php echo $configuracion->Correo; ?>" name='Correo'>
                            </div>
                            <div class='col-lg-6'>
                                <label>Teléfono</label>
                                <input class="form-control" type="text" id='Telefono'
                                    value="<?php echo $configuracion->Telefono; ?>" name='Telefono'>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                <label>Ancho de Mesa (En pixeles)</label>
                                <input class="form-control" type="text" id='AnchoMesa'
                                    value="<?php echo $configuracion->AnchoMesa; ?>" name='AnchoMesa'>
                            </div>
                        </div>
                    </div>

					<strong class="text-info">Menú</strong>
					<hr>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                <label>Precio de menú del día</label>
                                <input class="form-control text-right" type="text" id='PrecioMenu'
                                    value="<?php echo $configuracion->PrecioMenu; ?>" name='PrecioMenu'>
                            </div>
                            <div class='col-lg-6'>
                                <label>Precio del menú delivery del día</label>
                                <input class="form-control text-right" type="text" id='PrecioDelivery1'
                                    value="<?php echo $configuracion->PrecioDelivery1; ?>" name='PrecioDelivery1'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-lg-6'>
                                <label>Precio del menú delivery light</label>
                                <input class="form-control text-right" type="text" id='PrecioDelivery2'
                                    value="<?php echo $configuracion->PrecioDelivery2; ?>" name='PrecioDelivery2'>
                            </div>
                            <div class='col-lg-6'>
                                <label>IGV</label>
                                <input class="form-control text-right" type="text" id='Igv'
                                    value="<?php echo $configuracion->Igv; ?>" name='Igv'>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

			<strong class="text-info">Datos de Facturación Electrónica</strong>
					<hr>
			<div class="form-group">
                        <div class="row">
                            <div class='col-lg-6'>
                                <label>Serie Factura</label>
                                <input class="form-control" type="text" id='SerieFactura'
                                    value="<?php echo $configuracion->SerieFactura; ?>" name='SerieFactura'>
                            </div>
                            <div class='col-lg-6'>
                                <label>Número Factura</label>
                                <input class="form-control text-right" type="text" id='NumeroFactura'
                                    value="<?php echo $configuracion->NumeroFactura; ?>" name='NumeroFactura'>
                            </div>
                        </div>
                    </div>

					<div class="form-group">
                        <div class="row">
                            <div class='col-lg-6'>
                                <label>Serie Boleta</label>
                                <input class="form-control" type="text" id='SerieFactura'
                                    value="<?php echo $configuracion->SerieBoleta; ?>" name='SerieBoleta'>
                            </div>
                            <div class='col-lg-6'>
                                <label>Número Boleta</label>
                                <input class="form-control text-right" type="text" id='NumeroFactura'
                                    value="<?php echo $configuracion->NumeroBoleta; ?>" name='NumeroBoleta'>
                            </div>
                        </div>
                    </div>

					<strong class="text-info">Credenciales de Nubefact</strong>
					<hr>


					<div class="form-group">
						<div class="row">
							<div class='col-lg-6'>
								<label>Ruta API de NubeFact</label>
								<input class="form-control" type="text" id='api'
									value="<?php echo $configuracion->RutaApi; ?>" name='api'>
							</div>
							<div class='col-lg-6'>
								<label>Token</label>
								<input class="form-control" type="text" id='tokenNubefact'
									value="<?php echo $configuracion->TokenNubefact; ?>" name='tokenNubefact'>
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

                        <button class="btn btn-success"  type="submit">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
<script>
$(document).ready(function() {

    $('#m_configuracion').addClass('active');

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
            ID_TipoPerfil: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione el tipo de perfil'
                    }
                }
            }
        }
	});

	$("#api").focus(function(){
	this.select();
	});
	$("#tokenNubefact").focus(function(){
	this.select();
	});
	$('#imageview').attr('src', "<?php echo base_url($configuracion->Imagen); ?>");


	<?php
	if($configuracion->Imagen == "" || !$configuracion->Imagen){

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
