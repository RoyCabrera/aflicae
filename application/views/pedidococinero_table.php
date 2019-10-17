	 <!-- Nav tabs-->
	 <ul class="nav nav-tabs nav-fill" role="tablist">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#plato" aria-controls="home" role="tab" data-toggle="tab" aria-selected="true"><em class="fa fa-book"></em> Local</a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#delivery" aria-controls="profile" role="tab" data-toggle="tab" aria-selected="false"><em class="fa fa-book"></em> Delivery <span id='notificacion'><span class="badge badge-warning"> <?php echo $numeroFilas; ?> </span></span></a></li>
	</ul><!-- Tab panes-->
	<div class="tab-content p-0">
		<div class="tab-pane active m-3" id="plato" role="tabpanel">

			<div class="row">
				<div class='col-3' id='ent'>

					<?php
						date_default_timezone_set('America/Lima');
						$numerofilasEntradasLocal=$entradascocinero->num_rows();
						if($numerofilasEntradasLocal == 0){
							echo "<div class='col-md-4 text-muted text-center'>
							<h4>No hay entradas pendientes</h4>
							</div>
							";
						}
							if(isset($entradascocinero)){

								$menu="xxx";

								foreach($entradascocinero->result() as $aux){
									if($aux->Menu!=$menu){

										echo "
										<div class='col-12'>
											<div class='card bg-info border-0'>
												<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
												<div class='card-header'>

													<div class='row align-items-center'>

														<div class='col-12'>
															<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span></h1>
														</div>
														<div class='col-12'>
														<div class='list-group'>";

															$total=0;
															foreach($entradascocinero->result() as $aux2){
																if($aux2->Menu==$aux->Menu){

																	echo "<a class='list-group-item' href='#'>
																		<form action='".base_url('Pedido/cocinar/')."' method='POST'>

																			<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
																			<input type='hidden' name='cantidad' value='$aux2->total'>
																			<input type='hidden' name='plato' value='$aux2->ID_Menu'>
																			<input type='submit' value='$aux2->total Entrada' class='btn btn-success btn-xs float-right' >
																		</form>
																		<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

																			$aux2->Mesa
																		</a>";
																		$total=$total+$aux2->total;
																}
															}

															echo "<script> $('#total$aux->ID_Menu').text($total);</script>
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>";
									}
									$menu=$aux->Menu;
								}
							}
						?>

				</div>

				<div class='col-3' id='seg'>

							<?php
							$numerofilasSegundosLocal=$segundoscocinero->num_rows();
							if($numerofilasSegundosLocal == 0){
								echo "<div class='col-md-4 text-muted text-center'>
								<h4>No hay segundos pendientes</h4>
								</div>
								";
							}
									if(isset($segundoscocinero)){

										$menu="xxx";

										foreach($segundoscocinero->result() as $aux){
											if($aux->Menu!=$menu)
											{
											echo "

											<div class='col-12'>

													<div class='card bg-success border-0'>
													<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
													<div class='card-header'>
														<div class='row align-items-center'>

														<div class='col-12'>
															<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
														</div>
														<div class='col-12'>
														<div class='list-group'>";

														$total=0;
														foreach($segundoscocinero->result() as $aux2){
															if($aux2->Menu==$aux->Menu)
															{
																echo "
																	<a class='list-group-item' href='#'>
																	<form action='".base_url('Pedido/cocinar/')."' method='POST'>

																	<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
																	<input type='hidden' name='cantidad' value='$aux2->total'>
																	<input type='hidden' name='plato' value='$aux2->ID_Menu'>
																	<input type='submit' value='$aux2->total Segundo' class='btn btn-success btn-xs float-right' >
																	</form>
																	<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

																		$aux2->Mesa
																	</a>";
																	$total=$total+$aux2->total;
															}
														}
														echo "<script> $('#total$aux->ID_Menu').text($total);</script> ";
															echo "</div>
																</div>
															</div>
															</div>

														</div>

													</div>";
											}
											$menu=$aux->Menu;
										}
									}
							?>

				</div>

				<div class="col-3" id='bebida'>
							<!-- ----------------------------------------------------------- -->

							<?php
							$numerofilasBebidasLocal=$bebidascocinero->num_rows();
							if($numerofilasBebidasLocal == 0){
								echo "<div class='col-md-4 text-muted text-center'>
								<h4>No hay bebidas pendientes</h4>
								</div>
								";
							}
									if(isset($bebidascocinero)){

										$menu="xxx";

										foreach($bebidascocinero->result() as $aux){
											if($aux->Menu!=$menu) {
											echo "

												<div class='col-12'>
												<div class='card bg-purple border-0'>
												<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
												<div class='card-header'>
													<div class='row align-items-center'>

													<div class='col-12'>
														<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
													</div>
													<div class='col-12'>
													<div class='list-group'>";

													$total=0;
													foreach($bebidascocinero->result() as $aux2){
														if($aux2->Menu==$aux->Menu)
														{

															echo "
																<a class='list-group-item' href='#'>

																	<form action='".base_url('Pedido/cocinar/')."' method='POST'>

																	<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
																	<input type='hidden' name='cantidad' value='$aux2->total'>
																	<input type='hidden' name='plato' value='$aux2->ID_Menu'>
																	<input type='submit' value='$aux2->total Bebida' class='btn btn-success btn-xs float-right' >
																	</form>
																	<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

																	$aux2->Mesa
																</a>";
																$total=$total+$aux2->total;
														}
													}
													echo "<script> $('#total$aux->ID_Menu').text($total);</script> ";
														echo "</div>
															</div>
														</div>
														</div>

													</div>
												</div>";
											}
											$menu=$aux->Menu;
										}
									}
							?>
				</div>

				<div class="col-3" id='carta'>
							<?php
							$numerofilasCartaLocal=$cartacocinero->num_rows();
							if($numerofilasCartaLocal == 0){
								echo "<div class='col-md-4 text-muted text-center'>
								<h4>No hay platos carta pendientes</h4>
								</div>
								";
							}
									if(isset($cartacocinero)){

										$menu_carta="xxx";

										foreach($cartacocinero->result() as $aux){
											if($aux->Menu !=$menu_carta) {
											echo "

												<div class='col-12'>
												<div class='card bg-yellow border-0'>
												<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
												<div class='card-header'>
													<div class='row align-items-center'>

													<div class='col-12'>
														<h1 class='text-lg text-center'><span id='total$aux->ID_Menu' > </span>  </h1>
													</div>
													<div class='col-12'>
													<div class='list-group'>";

													$total_cocinero=0;
													foreach($cartacocinero->result() as $aux2){
														if($aux2->Menu==$aux->Menu)
														{

															echo "
																<a class='list-group-item' href='#'>

																	<form action='".base_url('Pedido/cocinar/')."' method='POST'>

																	<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
																	<input type='hidden' name='cantidad' value='$aux2->total'>
																	<input type='hidden' name='plato' value='$aux2->ID_Menu'>
																	<input type='submit' value='$aux2->total Bebida' class='btn btn-success btn-xs float-right' >
																	</form>
																	<div class='text-danger'>".date_format(date_create($aux2->FechaHora), 'H:i:s')."</div>

																	$aux2->Mesa
																</a>";
																$total_cocinero=$total_cocinero+$aux2->total;
														}
													}
													echo "<script> $('#total$aux->ID_Menu').text($total_cocinero);</script> ";
														echo "</div>
															</div>
														</div>
														</div>

													</div>
												</div>";
											}
											$menu_carta=$aux->Menu;
										}
									}
							?>
				</div>

			</div>

		</div>




	<div class="tab-pane m-3" id="delivery" role="tabpanel">
	<!-- --------------------------DELIVERY--------------------------------- -->

	<!-- <div class='row'>
        <div class='col-12'>
        <h3>Carta<span class='fa fa-star ml-2'></span></h3>
        </div>
    </div> -->
    <div class="row">

		<div id='cartaDelivery' class='col-3'>
			<?php
				$numerofilasCarta=$cartaDelivery->num_rows();
				if($numerofilasCarta == 0){
					echo "<div class='col-md-4 text-muted text-center'>
					<h4>No hay platos pendientes</h4>
					</div>
					";
				}
					if(isset($cartaDelivery)){

						$menu="xxx";
						foreach($cartaDelivery->result() as $aux){

							if($aux->Menu!=$menu) {
							echo "<div class='col-md-12'>
									<div class='card bg-yellow border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='totalCD$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>
										";

										$totalCD=0;
										foreach($cartaDelivery->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

												echo "


														<form action='".base_url('Pedido/cocinar/')."' method='POST'>

														<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
														<input type='hidden' name='cantidad' value='' id='totalCDR$aux2->ID_Menu'>
														<input type='hidden' name='plato' value='$aux2->ID_Menu'>
														<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
														</form>

													";
													$totalCD=$totalCD+$aux2->total;
											}
										}
										echo "<script> $('#totalCDR$aux->ID_Menu').val($totalCD);</script> ";
										echo "<script> $('#totalCD$aux->ID_Menu').text($totalCD);</script> ";
											echo "
												</div>
											</div>
											</div>

										</div>
									</div>
									";
							}
							$menu=$aux->Menu;
						}
					}

			?>
		</div>

	<!-- ----------------------------------------------------------- -->
	<!-- <div class='row'>
        <div class='col-12'>
        <h3>Entradas <span class='fa fa-lemon ml-2'></span></h3>
        </div>
    </div> -->

		<div id='entradaDelivery' class='col-3'>
			<?php
			$numerofilasEntradas=$entradasDelivery->num_rows();
			if($numerofilasEntradas == 0){
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay platos pendientes</h4>
				</div>
				";
			}
					if(isset($entradasDelivery)){
						$menu="xxx";
						foreach($entradasDelivery->result() as $aux){
							if($aux->Menu!=$menu) {
							echo "<div class='col-md-12'>
									<div class='card bg-info border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='totalentradaDelivery$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>";

										$totalED=0;
										foreach($entradasDelivery->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

												echo "

														<form action='".base_url('Pedido/cocinar/')."' method='POST'>
														<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
														<input type='hidden' name='cantidad' value='' id='totalentradaDeliveryR$aux2->ID_Menu'>
														<input type='hidden' name='plato' value='$aux2->ID_Menu'>
														<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
														</form>";
													$totalED=$totalED+$aux2->total;
											}
										}
										echo "<script> $('#totalentradaDeliveryR$aux->ID_Menu').val($totalED);</script> ";
										echo "<script> $('#totalentradaDelivery$aux->ID_Menu').text($totalED);</script> ";
											echo "
												</div>
											</div>
											</div>

										</div>
									</div>
									";
							}
							$menu=$aux->Menu;
						}
					}
			?>
		</div>

	<!-- ----------------------------------------------------------- -->
<!-- 	<div class='row'>
        <div class='col-12'>
        <h3>Segundos <span class='fa fa-cutlery ml-2'></span></h3>
        </div>
    </div> -->

		<div id='segundoDelivery' class='col-3'>
			<?php
			$numerofilasSegundos=$segundosDelivery->num_rows();
			if($numerofilasSegundos == 0){
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay platos pendientes</h4>
				</div>
				";
			}
					if(isset($segundosDelivery)){
						$menu="xxx";
						foreach($segundosDelivery->result() as $aux){

							if($aux->Menu!=$menu) {
							echo "<div class='col-md-12'>
									<div class='card bg-inverse border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='totalsegundoDelivery$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>";

										$totalSD=0;
										foreach($segundosDelivery->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

												echo "
														<form action='".base_url('Pedido/cocinar/')."' method='POST'>
														<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
														<input type='hidden' name='cantidad' value='' id='totalsegundoDeliveryR$aux2->ID_Menu'>
														<input type='hidden' name='plato' value='$aux2->ID_Menu'>
														<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
														</form>";
													$totalSD=$totalSD+$aux2->total;
											}
										}
										echo "<script> $('#totalsegundoDeliveryR$aux->ID_Menu').val($totalSD);</script> ";
										echo "<script> $('#totalsegundoDelivery$aux->ID_Menu').text($totalSD);</script> ";
											echo "
												</div>
											</div>
											</div>

										</div>
									</div>
									";
							}
							$menu=$aux->Menu;
						}
					}

			?>
		</div>

	<!-- ----------------------------------------------------------- -->
	<!-- <div class='row'>
        <div class='col-12'>
        <h3>Bebidas <span class='fa fa-bitbucket ml-2'></span></h3>
        </div>
    </div> -->

		<div id='bebidaDelivery' class='col-3'>
			<?php
			$numerofilasBebidas=$bebidasDelivery->num_rows();
			if($numerofilasBebidas == 0){
				echo "<div class='col-md-4 text-muted text-center'>
				<h4>No hay bebidas pendientes</h4>
				</div>
				";
			}
					if(isset($bebidasDelivery)){
						$menu="xxx";
						foreach($bebidasDelivery->result() as $aux){
							if($aux->Menu!=$menu) {
							echo "<div class='col-md-12'>
									<div class='card bg-purple border-0'>
									<div class='card-footer bg-gray-dark bt0 clearfix btn-block d-flex'><h4>$aux->Menu</h4></div>
									<div class='card-header'>
										<div class='row align-items-center'>

										<div class='col-12'>
											<h1 class='text-lg text-center'><span id='totalBebidaDelivery$aux->ID_Menu' > </span>  </h1>
										</div>
										<div class='col-12'>";

										$totalBD=0;
										foreach($bebidasDelivery->result() as $aux2){
											if($aux2->Menu==$aux->Menu)
											{

												echo "

														<form action='".base_url('Pedido/cocinar/')."' method='POST'>
														<input type='hidden' name='ID_Pedido' value='$aux2->ID_Pedido'>
														<input type='hidden' name='cantidad' value='' id='totalBebidaDeliveryR$aux2->ID_Menu'>
														<input type='hidden' name='plato' value='$aux2->ID_Menu'>
														<input type='submit' value='Cocinar' class='btn btn-success btn-block float-right' >
														</form>";
													$totalBD=$totalBD+$aux2->total;
											}
										}
										echo "<script> $('#totalBebidaDeliveryR$aux->ID_Menu').val($totalBD);</script> ";
										echo "<script> $('#totalBebidaDelivery$aux->ID_Menu').text($totalBD);</script> ";
											echo "
												</div>
											</div>
											</div>

										</div>
									</div>
									";
							}
							$menu=$aux->Menu;
						}
					}
			?>
		</div>

	</div>

		</div>
	</div>





<script>
	$(document).ready(function () {

		$('#m_pedido2').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='fa fa-cutlery'></em> <span>Lista de Ordenes</span>";
		setInterval(realTime,5000);

	});

	function realTime(){

		var ruta ="<?php echo base_url('Pedido/realTimeEntrada');?>";
		var ruta2 ="<?php echo base_url('Pedido/realTimeSegundo');?>";
		var ruta3 ="<?php echo base_url('Pedido/realTimeBebida');?>";
		var ruta4 ="<?php echo base_url('Pedido/notificacionDelivery');?>";
		var rutacarta ="<?php echo base_url('Pedido/realTimeCarta');?>";

		var ruta5 ="<?php echo base_url('Pedido/realTimeEntradaDelivery');?>";
		var ruta6 ="<?php echo base_url('Pedido/realTimesegundoDelivery');?>";
		var ruta7 ="<?php echo base_url('Pedido/realTimeBebidaDelivery');?>";
		var ruta8 ="<?php echo base_url('Pedido/realTimeCartaDelivery');?>";
		// entrada
		$.ajax({
			type: "POST",
			url: ruta,
			success: function (data) {
				$("#ent").html(data);
			}
		});
		// segundo
		$.ajax({
			type: "POST",
			url: ruta2,
			success: function (data) {
				$("#seg").html(data);
			}
		});
		// bebida
		$.ajax({
			type: "POST",
			url: ruta3,
			success: function (data) {
				$("#bebida").html(data);
			}
		});
		// Carta
		$.ajax({
			type: "POST",
			url: rutacarta,
			success: function (data) {
				$("#carta").html(data);
			}
		});
		// entrada delivery
		$.ajax({
			type: "POST",
			url: ruta5,
			success: function (data) {
				$("#entradaDelivery").html(data);
			}
		});
		// segundo delivery
		$.ajax({
			type: "POST",
			url: ruta6,
			success: function (data) {
				$("#segundoDelivery").html(data);
			}
		});
		// bebida delivery
		$.ajax({
			type: "POST",
			url: ruta7,
			success: function (data) {
				$("#bebidaDelivery").html(data);
			}
		});
		// carta delivery
		$.ajax({
			type: "POST",
			url: ruta8,
			success: function (data) {
				$("#cartaDelivery").html(data);
			}
		});
		// notificacion
		$.ajax({
			type: "POST",
			url: ruta4,
			success: function (data) {
				$("#notificacion").html(data);
			}
		});
	}

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


</script>

