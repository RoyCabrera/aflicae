<!-- <div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php echo base_url('Compra/nuevo') ;?>'><div class="fab bg-warning"> + </div></a>
</div> -->
<div class="row">
	<div class="col-md-12">
	<div class="card" role="tabpanel">
			<ul class="nav nav-tabs nav-fill" role="tablist">
				<li class="nav-item" role="presentation"><a class="nav-link active" href="#compra" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true"><em class="fa fa-book"></em> Compras</a></li>
				<li class="nav-item" role="presentation"><a class="nav-link" href="#compradirecta" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false"><em class="fa fa-book"></em>Compras directas</a></li>
			</ul>
			<div class="tab-content p-0">
				<div class="tab-pane active m-3" id="compra" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-hover maestra">
							<thead class="">
								<tr>
									<th width='20'>Fecha Hora</th>
									<th>Usuario</th>
									<th>Producto</th>
									<th>Familia</th>
									<th>Atributo 1</th>
									<th>Atributo 2</th>
									<th>Almacen</th>
									<th>Precio</th>
									<th class="text-right">Cantidad</th>
								</tr>
							</thead>
							<tbody>


							<?php
									if($compra_list){
										foreach ($compra_list->result() as $aux) {
										$ID = encriptar($aux->ID_Compra);

										$rutaeliminar= base_url('Compra/eliminar/' . $ID);

										echo "
										<tr>
										<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
										<td>$aux->Nombre $aux->ApellidoPaterno $aux->ApellidoMaterno</td>
										<td class = ''>".  $aux->Insumo ."</td>
										<td class=''>".  $aux->Familia ."</td>
										<td class=''>".  $aux->Atributo1 ."</td>
										<td class=''>".  $aux->Atributo2 ."</td>
										<td class=''>".  $aux->Almacen ."</td>
										<td>S/ $aux->Precio</td>
										<td class='text-right'>".  $aux->Cantidad."$aux->Abreviatura</td>
										</tr>
										";

										}
									}
									/*
									<td class='w-20'><a href='".base_url('Compra/compra/'.$ID)."'><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
										<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  ."')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>
									*/
							?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane m-3" id="compradirecta" role="tabpanel">
					<div class="table-responsive">
						<table class="table table-hover maestra">
							<thead>
								<th>Fecha</th>
								<th>Producto o servicio</th>
								<th>Proveedor</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</thead>
							<tbody>
								<?php 
								if(isset($compra_directa)){
									foreach($compra_directa->result() as $row){
										echo "
										<tr>
										<td>$row->FechaHora</td>
										<td>$row->Producto</td>
										<td>$row->Proveedor</td>
										<td align='right'>$row->Cantidad</td>
										<td align='right'>S/ $row->Precio</td>
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
		
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#t_compras').addClass('show').addClass('active');
		$('#t_compra').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-cart-plus'></em> <span>Lista de Compras</span>";
	});

	function baja(eliminar) {
		swal({
				title: "¿Desea eliminar este Menu?",
				text: "Recuerde que no aparecerá en la lista",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Eliminar!",
				closeOnConfirm: false
			},
			function () {
				swal("Eliminar!", "Este Menu ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
