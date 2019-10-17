<form action="<?php echo base_url('Mesa/actualizar') ?>" method="POST" id="frm">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-body" >
				<!-- START card tab-->
				<input type='hidden' name='ID_Mesa' id="ID_Mesa" value="<?php echo  encriptar($mesa->ID_Mesa); ?>">

				<div class="row">
					<div class='col-lg-8 offset-lg-2'>
						<div class="form-group">
							<div class='row'>
								<div class='col-lg-6'>
									<label>Mesa</label>
									<input required class="form-control" type="text" name='Mesa' id='Mesa'
										value="<?php echo $mesa->Mesa; ?>">
								</div>
								<div class='col-lg-6'>
								<label>Almacen</label>
								<select required class="form-control" name='ID_Almacen' id='ID_Almacen'>
									<option value=''>-- Seleccione --</option>
									<?php

										if($almacen_list){
												foreach($almacen_list->result() as $row){
													if($row->ID_Almacen == $mesa->ID_Almacen){
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
						<br>
					</div>
				</div>
			</div>
			<div class="card-footer">
					<div class="row">
						<div class="col-lg-6 col-xs-12">
						</div>
						<div class="col-lg-6 col-xs-12">
							<div class='text-right'>
								<a href='<?php echo  base_url('Mesa'); ?>' class="btn btn-warning"
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

	$(document).ready(function(){
		var d = document.getElementById("titulomodulo");
		$('#m_maestros').addClass('show').addClass('active');
		$('#m_mesa').addClass('active');
		var id = "<?php echo $mesa->ID_Mesa; ?>"
		if(id){
			d.innerHTML="<em class='fa fa-lemon-o'></em><span>  Editar Mesa</span>";
		}
		else{
			d.innerHTML="<em class='fa fa-lemon-o'></em><span>  Nueva Mesa</span>";
		}

	});
</script>
