<!-- <div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php //echo base_url('Compra/nuevo') ;?>'><div class="fab fondo-tema"> + </div></a>
</div> -->

<div class="row">
	<div class="col-md-2">
	<label for="start_date">Desde</label>
		<input type="date" name="start_date" id="start_date" class="form-control">
	</div>
	<div class="col-md-2">
	<label for="end_date">Hasta</label>
		<input type="date" name="end_date" id="end_date" class="form-control">
	</div>
	<div class="col-md-2">
	<label for="ID_Almacen">Almacén</label>
	<select class="form-control" name='ID_Almacen' id='ID_Almacen'>
										<option value='4'>Todos</option>
									<?php
										if($almacen_list) {
											foreach($almacen_list->result() as $row) {
												if($row->ID_Almacen == $compra->ID_Almacen)
													{
														echo "<option selected value='".$row->ID_Almacen."' >".$row->Almacen."</option>";}
													else
													{
													echo
													"<option value='".$row->ID_Almacen."'>".$row->Almacen.
													"</option>";
													}
											}
										}
									?>

								</select>
	</div>
	<div class="col-md-2">
		<div class="pt-4 mt-1"></div>
		<input  type="button" class="btn btn-green" id="buscar" value="Buscar">
	</div>

</div>

<hr>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-hover maestra">
				<thead class="">
					<tr>
					 	<th>Fecha Hora</th>
						<th>Almacen</th>
						<th>Menú</th>

						<th class="text-right">Precio</th>
						<th class="text-right">Cantidad</th>
						<th>Mesero</th>
						<th class="text-right">Total<th>

					</tr>
				</thead>
				<tbody id="ventas">


			<?php
					if($venta_list){
						foreach ($venta_list->result() as $aux) {
						$ID = encriptar($aux->ID_Pedido);


							if($aux->ID_Familia==2 ){
								$total=0;
								if($aux->EsMenu==1 && $aux->ID_Almacen==1)
								{
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}
								elseif($aux->EsMenu2==1 && $aux->ID_Almacen==2){
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}
								elseif($aux->EsMenu3==1 && $aux->ID_Almacen==3){
									$NombrePlato="Menú";
									$total=$total+$preciomenu*$aux->Cantidad;
									$precio=$preciomenu;
								}else {
									$NombrePlato=$aux->Menu;
									$total=$total+ $aux->Precio*$aux->Cantidad;
									$precio=$aux->Precio;
								}

									echo "
									<tr>
									<td>".  date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
									<td>".$aux->Almacen."</td>
									<td>".$NombrePlato."</td>

									<td class='text-right'>S/ ".$precio."</td>
									<td class='text-right'>".$aux->Cantidad."</td>
									<td>".$aux->Nombre." ".$aux->ApellidoPaterno."</td>
									<td class='text-right'>S/ ".$total."</td>
									<td></td>
									</tr>
									";

							}


						}
					}

			?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>

	$(document).ready(function () {

		$('#m_ventas').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-pencil'></em> <span>Lista de Ventas</span>";


		var date = document.getElementById("start_date").value;


		$("#buscar").click(function(){

			var start_date = $("#start_date").val();
			var end_date = $("#end_date").val();


			if(start_date == ""){
				start_date = "vacio";
			}
			if(end_date == ""){
				end_date = "vacio";
			}
			var id_almacen = $("#ID_Almacen").val();

			filtro(start_date,end_date,id_almacen);

		});
		function filtro(start_date,end_date,id_almacen){
			var ruta ="<?php echo base_url('Venta/filtro');?>"+"/"+start_date+"/"+end_date+"/"+id_almacen;
			$.ajax({
				type:"POST",
				url:ruta,
				success:function(data){
					$("#ventas").html(data);
					$(".pagination").hide();
					$(".dataTables_info").hide();
				}
			})
		}

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
