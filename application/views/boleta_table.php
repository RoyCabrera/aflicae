<div class="">
    <div class="text-center  rounded">
        <img class="img-fluid" src="<?php echo base_url('assets/img/ECOLUNCH.png');?>" width="20%" alt="App Logo">
        <p>www.ecolunch.com.pe</p>
    </div>
    <div>
        <div class="bg-dark text-light">
            <p class="text-center">Restaurante Ecológico</p>
        </div>
        <p><?php echo $config->Direccion; ?></p>
        <p>Telf <?php echo $config->Telefono; ?></p>
        <?php
			date_default_timezone_set('America/Lima');
			$now = new DateTime();
			$fechaHora=$now->format('d/m/Y H:i:s');
			$fecha=substr($fechaHora,0,10);
			$hora = substr($fechaHora,10,10);
		?>
        <p>Fecha: <?php echo $fecha  ?></p>
        <p>Hora: <?php echo $hora  ?></p>
        <p>RUC: <?php echo $config->Ruc; ?></p>
        <?php
			$row = $mesero->row();
			if (isset($row)){
				echo "<p>Atendido por: ".$row->Nombre."</p>";
			}

			if(isset($venta_list)){
				if(!$venta_list->row()){
					$pedido="Sin Ticket aún";
				}else{
					$row = $venta_list->row();
					$pedido=$row->ID_Pedido;
				}
			}

		?>

    </div>
    <div class="text-center">
        <h2>Ticket N° <span class="text-bold"><?php echo $pedido;?></span></h2>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12 col-md-12">
            <table class="table table-borderless">
                <thead class=" table-bordered text-bold">
                    <tr>
                        <th>Plato</th>
                        <th class="text-right">Cantidad</th>
                        <th class="text-right">Precio</th>
                    </tr>
                </thead>
                <hr>
                <tbody>

		<?php
			$total=0;
			$ID_Almacen = desencriptar($_SESSION['ID_Almacen']);
			$ID_Perfil = desencriptar($_SESSION['ID_Perfil']);
		if($venta_list){
			foreach ($venta_list->result() as $aux){

				if($aux->ID_Almacen == 1){
						if(($aux->EsMenu==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu==0)){
					?>
					<tr>
						<td>
							<?php
						if($aux->EsMenu==1){
							echo "Menu";
						}else{
							echo $aux->Menu;
						}
					?>
						</td>
						<td class='text-right'><?php echo $aux->Cantidad?></td>
						<td class='text-right'>
							<?php
						if($aux->EsMenu==1)
						{
							//precio menu guardado en bd
							echo $aux->Precio;//13
							$total = $total + $aux->Precio * $aux->Cantidad;
						}else{
							//precio carta guardado en TLPedido 
							echo $aux->Precio;
							$total = $total + $aux->Precio * $aux->Cantidad;
						}
					?>
						</td>
					</tr>
					<?php
							}
				}
				if($aux->ID_Almacen == 2){
					if(($aux->EsMenu2==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu2==0)){
					?>
					<tr>
						<td>
							<?php
								if($aux->EsMenu2==1){
									echo "Menu";
								}else{
									echo $aux->Menu;
								}

							?>

						</td>
						<td class='text-right'><?php echo $aux->Cantidad?></td>
						<td class='text-right'>
							<?php
							if($aux->EsMenu2==1)
							{
								echo $preciomenu;
								$total = $total + $preciomenu * $aux->Cantidad;
							}else{
								echo $aux->Precio;
								$total = $total + $aux->Precio * $aux->Cantidad;}
							?>
						</td>
					</tr>

					<?php
						}
				}
				if($aux->ID_Almacen == 3){
						if(($aux->EsMenu3==1 && $aux->ID_Familia==2 )|| ($aux->EsMenu3==0)){
					?>
					<tr>
						<td>
					<?php
						if($aux->EsMenu3==1){
							echo "Menu";
						}else {
							echo $aux->Menu;
						}
					?>

						</td>
						<td class='text-right'><?php echo $aux->Cantidad?></td>
						<td class='text-right'>
							<?php
						if($aux->EsMenu3==1)
						{
							echo $preciomenu;
							$total = $total + $preciomenu * $aux->Cantidad;
						}else{
							echo $aux->Precio;
							$total = $total + $aux->Precio * $aux->Cantidad;}
					?>
						</td>
					</tr>

					<?php
							}
				}
			}
		}


		?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class='row'>
            <div class='col-lg-12 col-xs-12 text-right'>
                <p><span class="text-bold">
                        <h3>Total:S/
                    </span> <?php echo number_format($total,2) ?></h3>
                </p>
            </div>
        </div>
    </div>
</div><br><br><br>
