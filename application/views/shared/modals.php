

<!-- modal nuevo pedido -->
<div class="modal fade" id="modalMesaVacia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mesa Disponible</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		Esta mesa está disponible ¿Desea abrir un nuevo pedido?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
		<div id="nuevoPedido"></div>
      </div>
    </div>
  </div>
</div>

<!--MODAL PARA EL DETALLE DE LA MESA-->

<div class="modal fade bd-example-modal-lg" id="modaldetalle" tabindex="-1" role="dialog" aria-labelledby="modaldetalle" aria-hidden="true" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="titledetalle" >La mesa tiene la siguiente orden:</h4>

					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">
			<table class="table table-hover">
                <thead>
                    <tr>
                        <th>Plato</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Observación</th>
                        <th>Almacen</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody id="detalle">
				</tbody>
            </table>
			</div>
			<div class="modal-footer">
				<!-- <button class="btn btn-warning" type="button" data-dismiss="modal">Cerrar</button> -->
				<button class="btn btn-secondary" type="button" >Boleta</button>
				<div id="verMesa"></div>
				
				<!-- <div id="nuevo"></div> -->
			</div>
		</div>
	</div>
</div>

<!--MODAL PARA EL DETALLE DEL PEDIDO DELIVERY-->

<div class="modal fade bd-example-modal-lg" id="modalmotorizado" tabindex="-1" role="dialog" aria-labelledby="modaldetalle" aria-hidden="true" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="titledetalle" >Platos del pedido</h4>

					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">
			<table class="table table-hover table-bordered">
                <thead class="bg-green">
                    <tr>
                        <th class="text-light font-weight-bold">Plato</th>
                        <th class="text-light font-weight-bold text-center">Estado</th>



                    </tr>
                </thead>
                <tbody id="detalleDelivery">
				</tbody>
            </table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" type="button" data-dismiss="modal">Cerrar</button>
				<div id="nuevo"></div>
			</div>
		</div>
	</div>
</div>

<!--MODAL PARA ASIGNAR MOTORIZADO-->

<div class="modal fade bd-example-modal-lg" id="modalasignarmotorizado" tabindex="-1" role="dialog" aria-labelledby="modaldetalle" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="titledetalle" >Asginar Motorizado</h4>

					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">

				<div class="col-lg-12">
				<!-- <div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong id="numeroPedidosSeleccionados"></strong> pedidos seleccionados
  
	</div> -->
	<form action="<?php echo base_url('Repartidor/AsignarPedidoDelivery') ?>" method="POST">
					<div class="form-group">
						<label>Motorizado disponible</label>
						<select class="form-control" name='ID_Perfil' required id='ID_Perfil'>
								<option value=''>-- Seleccione --</option>
						<?php if(isset($repartidores)){
							foreach($repartidores->result() as $row){
								echo "<option value='".$row->Correo."' >".$row->Nombre." ".$row->ApellidoPaterno." ".$row->ApellidoMaterno."</option>";
							}
							}

						 ?>
						
						</select>
					</div>
					<div class="form-group">
						<label>Asignar Zona</label>
						<select class="form-control" name='ID_Zona' required id='ID_Zona'>
								<option value=''>-- Seleccione --</option>
						<?php if(isset($zonas)){
							foreach($zonas->result() as $row){
								echo "<option value='".$row->ID_Zona."' >".$row->Zona."</option>";
							}
							}

						 ?>
						
						</select>
					</div>
					<hr>
					<label>Billetes</label>
							<input type="hidden" name="ID" id="ID_P">
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 100.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='100'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon3">S/ 50.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='50'>
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 20.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='20'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 10.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='10'>
						</div>
					</div>
					<hr>
					<label>Monedas</label>
					
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 5.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='5'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 2.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='2'>
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 1.00</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='1'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.50</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='050'>
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.20</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='020'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.10</span>
								</div>
								<input class="form-control text-right" id="basic-url" type="number" aria-describedby="basic-addon3" name='010'>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-success" id='botonasignar'  type="submit" >Asignar</button>
				<div id="nuevo"></div>
			</div>
			</form>
		</div>
	</div>
</div>

<!--MODAL PARA LONCHERAS-->


<form action="<?php echo base_url('Pedido/estadoPedidoDelivery') ?>" method='POST'>
	<div class='modal fade bd-example-modal-lg' id='modal_lonchera' tabindex='-1' role='dialog'  aria-hidden='true' >
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
				<h4 class='modal-title' id='titledetalle' >Asignar loncheras</h4>

						<button class='close' type='button' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>×</span>
						</button>
				</div>
				
				<div class='modal-body'>
				
					<div id='pe'>
						<!-- input id pedido -->
					</div>
					<label for="Cantidad">Ingrese la cantidad de Loncheras</label>
					<input type='number' class='form-control text-right' name='cantidadLonchera'>
					<label for="Codigo">Ingrese los codigos de loncheras</label>
					<textarea name='codigoLoncheras' class='form-control'></textarea>
					
					
				</div>
				<div class='modal-footer'>
					<input class='btn btn-success'  type='submit' value='Armar pedido'>
				</div>
			</div>
		</div>
	</div>
</form>

<!--- sumar total -->

<?php  
	if(isset($sumar)){
		foreach($sumar->result() as $s){
			$a=$s->cien;
			$b=$s->cincuenta;
			$c=$s->veinte;
			$d=$s->diez;
			$e=$s->cinco;
			$f=$s->dos;
			$g=$s->uno;
			$h=$s->cincuentaC;
			$i=$s->veinteC;
			$j=$s->diezC;

			$totalAsignado=$a+$b+$c+$d+$e+$f+$g+$h+$i+$j;
		}
	}

?>

<!--MODAL PARA VER EL IMPORTE ASIGNADO-->

	<div class='modal fade bd-example-modal-lg' id='modalimporte' tabindex='-1' role='dialog'  aria-hidden='true' >
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
				<h4 class='modal-title' id='titledetalle' >Dinero asignado: <span class='text-primary'>S/<?php echo number_format($totalAsignado, 2, '.', ''); ?></span></h4>

						<button class='close' type='button' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>×</span>
						</button>
				</div>
				
				<div class='modal-body'>
				
				
		<ul class='list-group'>
					<?php if(isset($listImporte)){
						foreach($listImporte->result() as $aux){
				echo "<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 100
						<span class='badge badge-dark badge-pill'>$aux->cien</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 50
						<span class='badge badge-dark badge-pill'>$aux->cincuenta</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 20
						<span class='badge badge-dark badge-pill'>$aux->veinte</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 10
						<span class='badge badge-dark badge-pill'>$aux->diez</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 5
						<span class='badge badge-dark badge-pill'>$aux->cinco</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 2
						<span class='badge badge-dark badge-pill'>$aux->dos</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 1
						<span class='badge badge-dark badge-pill'>$aux->uno</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.50
						<span class='badge badge-dark badge-pill'>$aux->cincuentaC</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.20
						<span class='badge badge-dark badge-pill'>$aux->veinteC</span>
						</li>
						<li class='list-group-item d-flex justify-content-between align-items-center'>S/ 0.10
						<span class='badge badge-dark badge-pill'>$aux->diezC</span>
						</li>";
						
						
						}
					}
					
					?>
			
		</ul>
					
				
				</div>
				
			</div>
		</div>
	</div>
<!--MODAL PARA VER EL IMPORTE ASIGNADO AL MOTORIZADO-->

<div class='modal fade bd-example-modal-lg' id='modalimporteMotorizado' tabindex='-1' role='dialog'  aria-hidden='true' >
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
				<h4 class='modal-title' id='titledetalle' >Dinero asignado</h4>

						<button class='close' type='button' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>×</span>
						</button>
				</div>
				
				<div class='modal-body'>
				
				
		<ul class='list-group' id="ver">
					
			
		</ul>	
				</div>
				
			</div>
		</div>
	</div>
	
<!-- ASIGNAR DINERO DE COMPRAS -->
<div class="modal fade bd-example-modal-lg" id="modalasignardinerocompras" tabindex="-1" role="dialog" aria-labelledby="modaldetalle" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="titledetalle" >Asginar dinero</h4>

					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">

				<div class="col-lg-12">
				
					<form action="<?php echo base_url('Compra/AsginarDineroCompras') ?>" method="POST">
					
				
					<label>Billetes</label>
							<input type="hidden" name="ID_ListaCompra" id="ID_ListaCompra">
							<input type="hidden" name="correo" id="CorreoCompras">
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 100.00</span>
								</div>
								<input class="form-control text-right" id="cien" min="0" pattern="^[0-9]+" type="number" aria-describedby="basic-addon3" name='100' >
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text " id="basic-addon3">S/ 50.00</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="cincuenta" type="number" aria-describedby="basic-addon3" name='50' >
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 20.00</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="veinte" type="number" aria-describedby="basic-addon3" name='20'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 10.00</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+" id="diez" type="number" aria-describedby="basic-addon3" name='10'>
						</div>
					</div>
					<hr>
					<label>Monedas</label>
					
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 5.00</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='5'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 2.00</span>
								</div>
								<input class="form-control text-right"  min="0" pattern="^[0-9]+" id="basic-url" type="number" aria-describedby="basic-addon3" name='2'>
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 1.00</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='1'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.50</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='050'>
						</div>
					</div>
					<div class="row">
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.20</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='020'>
						</div>
						<div class="input-group mb-3 col-lg-6">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon3">S/ 0.10</span>
								</div>
								<input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='010'>
						</div>
						
					</div>
				
					
				
						<div class="modal-footer">
							<button class="btn btn-success" id='botonasignar'  type="submit" >Asignar</button>
							<div id="nuevo"></div>
						</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- EDITAR DINERO DE COMPRAS -->
<div class="modal fade bd-example-modal-lg" id="modalEditarDinero" tabindex="-1" role="dialog" aria-labelledby="modalEditarDinero" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="titleDinero" >Dinero asignado</h4>

					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">

				<div class="col-lg-12" id="formularioEditarDinero">
				
					
				</div>
			</div>
		</div>
	</div>
</div>