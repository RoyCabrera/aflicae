<style>
#stockmin,#stock,#costo{
	text-align: right;

}
.vl {
  border-left: 2px solid green;
  height: 100px;
}
</style>
<!-- <div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
<a href='<?php //echo base_url('Insumo/nuevo') ;?>'><div class="fab fondo-tema"  > + </div></a>
</div> -->
<?php
$totalventadia = $totaldia->num_rows();
$totalmes = $totalVentasMes->num_rows();


?>



<div class="row mt-5">

	<div class="col-md-6">
        <h3 class="text-center text-uppercase">Productos por  agotarse</h3>
		<div class="table-responsive ">
			<table class="table maestra table-bordered">
				<thead>
					<tr>
                        <th class="text-left">Insumos</th>
                        <th class="text-right">Costo</th>
                        <th class="text-right">Stock</th>
                        <th class="text-right">Stock Minimo</th>
					</tr>
				</thead>
				<tbody>
					<?php

						if($Insumo_list){
							foreach ($Insumo_list as $aux) {
							$ID = encriptar($aux['ID_Insumo']);
							$rutaeliminar= base_url('Insumo/eliminar/' . $ID);
							echo "
							<tr>
									<td > ". $aux['Insumo'] ."</td>

									<td id='costo'>S/ ".  $aux['Costo'] ."</td>
									<td id='stock'>".  $aux['Stock'] ." Kg</td>
																																	<td id=td>

							</tr>
							";

							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-md-6">
        <h3 class="text-center text-uppercase">Ventas Pendientes</h3>
		<div class="table-responsive ">
			<table class="table maestra table-bordered">
				<thead>
					<tr>
                        <th class="text-left">Fecha Hora</th>
                        <th class="">Mesa</th>
                        <th class="">Mesero</th>
					</tr>
				</thead>
				<tbody>
					<?php

						if($pedidoPendientes){
							$pedido = $pedidoPendientes->result();
							foreach ($pedido as $aux) {

							echo "
							<tr>
								<td>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
								<td>$aux->Mesa</td>
								<td>$aux->Nombre</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>



<script>
	$(document).ready(function () {
		
		$('#t_admin').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='icon-speedometer'></em> <span>Menu Principal</span>";
	});
	var anio = (new Date).getFullYear();

	function estadisticosVentaAlmacen(){
		var ruta2 ="<?php echo base_url('Venta/ventaAlmacen');?>"
		var ctx2 = document.getElementById('myChart2').getContext('2d');

		$.ajax({
			type:"POST",
			url:ruta2,
			success:function(data){
				var valores2 = eval(data);

				var a = valores2[0];
				var b = valores2[1];
				var c = valores2[2];
				
				var myChart2 = new Chart(ctx2, {

					type: 'line',
					data: {
						//los nombres de almacen vendran de la base de datos
						labels: ['Almacen 1','Almacen 2','Almacen 3'],
						datasets: [{
							label: 'S/',
							data: [a,b,c],
							backgroundColor: [
								
								'rgba(54, 162, 235, 0.2)'
								
							],
							borderColor: [
								
								'rgba(54, 162, 235, 1)'
								
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
			}
		});

		
	}

	
	$(document).ready(mostrarResultados(anio),estadisticosVentaAlmacen());
	$(document).ready(function () {
		
		$('#t_admin').addClass('active');
		var d = document.getElementById("titulomodulo");
		d.innerHTML = "<em class='icon-speedometer'></em> <span>Panel de Inicio</span>";
	});

	function mostrarResultados(year){
		var ruta ="<?php echo base_url('Venta/filtraryear');?>"
		$.ajax({
			type:"POST",
			url:ruta,
			data:"anio="+year,
			success:function(data){
				var valores = eval(data);

				var e = valores[0];
				var f = valores[1];
				var m = valores[2];
				var a = valores[3];
				var ma = valores[4];
				var j = valores[5];
				var jl = valores[6];
				var ag = valores[7];
				var s = valores[8];
				var o = valores[9];
				var n = valores[10];
				var d = valores[11];


				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
						datasets: [{
							label: 'S/',
							
							data: [e,f,m,a,ma,j,jl,ag,s,o,n,d],
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)',
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)',
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});

			}
		})
	}

	function baja(eliminar) {
		swal({
				title: "¿Desea eliminar este Insumo?",
				text: "Recuerde que no aparecerá en la lista",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, ¡Eliminar!",
				closeOnConfirm: false
			},
			function () {
				swal("Eliminar!", "Este Insumo ha sido eliminado", "success");
				window.location.href = eliminar;
			});
	}

	<?php maestra(); ?>
</script>

</html>
