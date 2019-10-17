<?php if (desencriptar($_SESSION['ID_Perfil']) == 1) {
	?>
<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
    <a href='<?php echo base_url('Menu/nuevo'); ?>'>
        <div class="fab bg-warning"> + </div>
    </a>
</div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover maestra">
                <thead>
                    <tr>
                        <?php if (desencriptar($_SESSION['ID_Perfil']) == 1) {
							echo "<th>Menú</th>
						<th>Menú2</th>
						<th>Menú3</th>
						<th>Carta Delivery</th>
						<th>M.Delivery 1</th>
						<th>M.Delivery 2</th>";
						} ?>
                        <th>Familia</th>
                        <th>Nombre</th>
                        <th class='text-right'>Precio</th>
                        <th class='text-right'>Delivery</th>
                        <th class='text-right'>Costo</th>
                        <th class='w-20'></th>
                        <?php if (desencriptar($_SESSION['ID_Perfil']) == 1) {
							echo "<th class='w-20'></th>
						<th></th>";
						} ?>

                    </tr>
                </thead>
                <tbody>
                    <?php

					if ($Menu_list) {
						foreach ($Menu_list->result() as $aux) {
							$ID = encriptar($aux->ID_Menu);

							$rutaeliminar = base_url('Menu/eliminar/' . $ID);
							$Imagen = base_url('assets/img/nofoto.png');
							//echo URL_RAIZ.$aux->ImagenThumbnail."<br>";

							if ($aux->ImagenThumbnail && file_exists(URL_RAIZ . $aux->ImagenThumbnail)) {
								$Imagen = base_url($aux->ImagenThumbnail);
							}

							$ImagenEdificio = base_url('assets/img/edificio.png');
							//echo URL_RAIZ.$aux->ImagenThumbnail."<br>";
							if ($aux->ImagenMenu && file_exists(URL_RAIZ . $aux->ImagenMenu)) {
								$ImagenEdificio = base_url($aux->ImagenMenu);
							}

							if ($aux->MenuHoy == 1) {
								$auxiliar = "fa fa-star";
							} else {
								$auxiliar = "icon-star";
							}
							/**************************************************************** */
							if ($aux->MenuHoy2 == 1) {
								$auxiliar2 = "fa fa-star";
							} else {
								$auxiliar2 = "icon-star";
							}
							/**************************************************************** */
							if ($aux->MenuHoy3 == 1) {
								$auxiliar3 = "fa fa-star";
							} else {
								$auxiliar3 = "icon-star";
							}
							/**************************************************************** */
							if ($aux->MenuDelivery1 == 1) {
								$auxiliarD1 = "fa fa-star";
							} else {
								$auxiliarD1 = "icon-star";
							}
							/**************************************************************** */
							if ($aux->MenuDelivery2 == 1) {
								$auxiliarD2 = "fa fa-star";
							} else {
								$auxiliarD2 = "icon-star";
							}
							/**************************************************************** */
							if ($aux->Delivery == 1) {
								$auxiliarD = "fa fa-star";
							} else {
								$auxiliarD = "icon-star";
							}
							if (desencriptar($_SESSION['ID_Perfil']) == 1) {
								$soloAdmin = "<td class='w-20' id='star'>
							<em class='$auxiliar  color-tema' onClick='cambioMenu(this.id)'  style='padding-right:5px' id='menu" . $aux->ID_Menu . "'></em>
							</td>

							<td class='w-20' id='star2'>
							<em class='$auxiliar2   color-tema' onClick='cambioMenu2(this.id)'  style='padding-right:5px' id='menu2" . $aux->ID_Menu . "'></em>
							</td>

							<td class='w-20' id='star3'>
							<em class='$auxiliar3  color-tema' onClick='cambioMenu3(this.id)'  style='padding-right:5px' id='menu3" . $aux->ID_Menu . "'></em>
							</td>

							<td class='w-20' id='star4'>
							<em class='$auxiliarD  color-tema' onClick='EsDelivery(this.id)'  style='padding-right:5px' id='Esdelivery" . $aux->ID_Menu . "'></em>
							</td>

							<td class='w-20' id='star4'>
							<em class='$auxiliarD1  color-tema' onClick='EsMenuDelivery(this.id)'  style='padding-right:5px' id='delivery" . $aux->ID_Menu . "'></em>
							</td>

							<td class='w-20' id='star5'>
							<em class='$auxiliarD2  color-tema' onClick='EsMenuDelivery2(this.id)'  style='padding-right:5px' id='delivery2" . $aux->ID_Menu . "'></em>
							</td>";
								$opciones = "<td class='w-20'><a href='" . base_url('Menu/menu/' . $ID) . "'  ><em class='icon-pencil color-tema' style='padding-right:5px'></em> </a></td>
							<td class='w-20'><a href='#'  onclick=\"return baja('" . $rutaeliminar  . "')\" ><em class='icon-trash color-tema' style='padding-right:5px'></em> </a></td>";
							} else {
								$soloAdmin = "";
								$opciones = "";
							}

							echo "
					<tr id='listaClass'>

						$soloAdmin
						<td>" .  $aux->Familia . "</td>
						<td><img src='" . $Imagen . "' class='rounded-circle' width='40px' height='40px' style='margin-right:10px' /> " . $aux->Menu . "</td>
						<td class='text-right'>S/ " . $aux->Precio . "</td>
						<td class='text-right'>S/ " . $aux->PrecioDelivery . "</td>
						<td class='text-right'>S/ " . $aux->Costo . "</td>
						<td class='w-20'><a href='" . base_url('Receta/Insumo/' . $ID) . "'  ><em class='icon-list color-tema' style='padding-right:5px'></em> </a></td>
						$opciones
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
<script>
function cambioMenu(clicked_id) {
    var a = "#" + clicked_id;

    var id = a.replace("#menu", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var menuhoy = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var menuhoy = 0;
    }

    var ruta = "<?php echo base_url('Menu/MenuHoy'); ?>" + "/" + id + "/" + menuhoy;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })

}

function cambioMenu2(clicked_id2) {
    var a = "#" + clicked_id2;
    var id = a.replace("#menu2", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var menuhoy = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var menuhoy = 0;
    }

    var ruta = "<?php echo base_url('Menu/MenuHoy2'); ?>" + "/" + id + "/" + menuhoy;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })


}

function cambioMenu3(clicked_id) {

    var a = "#" + clicked_id;

    var id = a.replace("#menu3", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var menuhoy = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var menuhoy = 0;
    }

    var ruta = "<?php echo base_url('Menu/MenuHoy3'); ?>" + "/" + id + "/" + menuhoy;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })


}

function EsMenuDelivery(clicked_id) {

    var a = "#" + clicked_id;

    var id = a.replace("#delivery", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var EsMenuDelivery = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var EsMenuDelivery = 0;
    }

    var ruta = "<?php echo base_url('Menu/EsMenuDelivery'); ?>" + "/" + id + "/" + EsMenuDelivery;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })


}

function EsMenuDelivery2(clicked_id) {
    var a = "#" + clicked_id;

    var id = a.replace("#delivery2", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var EsMenuDelivery2 = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var EsMenuDelivery2 = 0;
    }

    var ruta = "<?php echo base_url('Menu/EsMenuDelivery2'); ?>" + "/" + id + "/" + EsMenuDelivery2;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })
}

function EsDelivery(clicked_id) {
    var a = "#" + clicked_id;

    var id = a.replace("#Esdelivery", "");

    if ($(a).hasClass("icon-star")) {
        $(a).removeClass("icon-star");
        $(a).addClass("fa fa-star");
        var EsDelivery = 1;
    } else {
        $(a).removeClass("fa fa-star");
        $(a).addClass("icon-star");
        var EsDelivery = 0;
    }

    var ruta = "<?php echo base_url('Menu/EsDelivery'); ?>" + "/" + id + "/" + EsDelivery;

    $.ajax({
        method: "POST",
        url: ruta,
        //data:parametros,
        success: function() {
            //	window.location.replace("Menu/MenuHoy/");

        }
    })
}

$('#m_maestros').addClass('show').addClass('active');
$('#m_menu').addClass('active');


var d = document.getElementById("titulomodulo");
d.innerHTML = "<em class='fa fa-cutlery'></em> <span>Lista de Platos</span>";


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
        function() {
            swal("Eliminar!", "Este Menu ha sido eliminado", "success");
            window.location.href = eliminar;
        });
}

<?php maestra(); ?>
</script>

</html>

