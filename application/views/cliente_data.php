<div class="row">
    <div class="col col-lg-2 col-md-12 col-xs-12"></div>
    <div class="col col-lg-8 col-12">
        <form action="<?= base_url('Venta/cobrar/'.$ID."/".$ID_Mesa) ?>" method="POST">
			<div class = "card">
				<div class ="card-body">
				<input type="hidden" name="ID_Cliente" value="" id="ID_Cliente">
            <input type="hidden" name="ID_Pedido" value="<?= $ID ?>">
			<input type="hidden" name="tipo_comprobante" value="<?= $tipo_comprobante ?>">

            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="documento">Tipo de documento</label>
                    <select class="form-control" name="documento" id="documento" >
                        <option value=''>-- Seleccione --</option>
                        <?php
					if($documento_list){
						foreach($documento_list->result() as $row){

							echo "<option value='".$row->ID_Documento."' >".$row->Documento."</option>";

						}
					}
					?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="dni">N° de documento</label>
                    <input type="text" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Número de documento"
                        >
                </div>
            </div>
            <div class="form-row" id="test">
                <div class="form-group col-md-12">
                    <label for="razonsocial">Nombre o Razon Social</label>
                    <input type="text" class="form-control" id="razonsocial" name="razonsocial"
                        placeholder="Nombre del cliente" >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        placeholder="dirección del cliente" >
                </div>
                <div class="form-group col-md-6">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control"  id="correo" name="correo"
                        placeholder="correo electrónico">
                </div>
                <label for="tipo_cobro">Tipo de cobro</label>
                <select class="form-control" name="tipo_cobro" id="tipo_cobro" required>
                        <option value=''>-- Seleccione --</option>
                        <option value='Visa'>Visa</option>
                        <option value='MasterCard'>MasterCard</option>
                        <option value='Efectivo'>Efectivo</option>
                        <option value='Porcobrar'>Por cobrar</option>
                </select>

            </div>
				</div>
				<div class="card-footer">
                    <div class="form-row">
                        <div class="col-md-3  col-lg-3  col-xs-12 ">
                            <input type="submit" id="btnComprobante" class="btn btn-info btn-block" value="Cobrar">
                        </div>
                        <!-- <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xs-12 offset-xs-0">
                            <input type="submit" id="btnComprobante" class="btn btn-info btn-block" value="Emitir Comprobante electrónico">
                        </div> -->
                    </div>
				</div>
			</div>



        </form>
    </div>
</div>

<script>
$(document).ready(function() {

    $('#m_pedido').addClass('active');
		var d = document.getElementById("titulomodulo");
        d.innerHTML = "<em class='fa fa-pencil-square-o''></em> <span>Cobrar pedido</span>";
        
        $("#tipo_cobro").change(function(){
            if($('select[id=tipo_cobro]').val() == "Porcobrar"){
                console.log("Por cobrar");
            }
           
          
	});


 /*    $("#numerodocumento").blur(function(ruc) {
        var numerodocumento = $("#numerodocumento").val();
        var ruta = "<?php echo base_url('Venta/buscarCliente');?>" + "/" + numerodocumento;
        $.ajax({
                type: "POST",
                url: ruta,
                success: function(data) {
                    $("#razonsocial").val(data.RazonSocial);
                    $("#direccion").val(data.direccion);
                    $("#correo").val(data.correo);
                    $("#ID_Cliente").val(data.ID_Cliente);
                }
            })
            .fail(function() {
                $("#razonsocial").val("");
                $("#direccion").val("");
                //$("#documento").val("");
                $("#correo").val("");
                $("#ID_Cliente").val("");
            });

    }); */
});

function justNumbers(e) {

    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;

    return /\d/.test(String.fromCharCode(keynum));

}
</script>

</html>
