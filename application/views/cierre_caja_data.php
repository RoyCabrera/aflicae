
<div class="row">
<div class="col-lg-6">
    <form action="<?php echo base_url('Caja/verificar_cierre') ?>" method="POST" id="formulario">
        <div class="card">
            <div class="card-body">
                <label>Billetes</label>
                <!-- <input type="hidden" name="ID_Apertura" id="ID_Apertura" value="<?= encriptar($caja->ID_Apertura) ?>"> -->
                <input type="hidden" name="ID_Cierre" value="<?= $caja->ID_Cierre?>">
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 200.00</span>
                    </div>
                    <input class="form-control text-right" <?= $disabled ?> id="Q20000" min="0" pattern="^[0-9]+" type="number" aria-describedby="basic-addon3" name='Q20000' value="<?= $caja->Q20000?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 100.00</span>
                        </div>
                        <input class="form-control text-right"  <?= $disabled ?> id="Q10000" min="0" pattern="^[0-9]+" type="number" aria-describedby="basic-addon3" name='Q10000' value="<?= $caja->Q10000?>">
                    </div>

                </div>
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text " id="basic-addon3">S/ 50.00</span>
                        </div>
                        <input class="form-control text-right"  <?= $disabled ?> min="0" pattern="^[0-9]+"  id="Q05000" type="number" aria-describedby="basic-addon3" name='Q05000' value="<?= $caja->Q05000?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 20.00</span>
                        </div>
                        <input class="form-control text-right"  <?= $disabled ?> min="0" pattern="^[0-9]+"  id="Q02000" type="number"  aria-describedby="basic-addon3" name='Q02000' value="<?= $caja->Q02000?>">
                    </div>

                </div>

                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 10.00</span>
                        </div>
                        <input class="form-control text-right" min="0"  <?= $disabled ?> pattern="^[0-9]+" id="Q01000" type="number" aria-describedby="basic-addon3" name='Q01000' value="<?= $caja->Q01000?>">
                    </div>
                </div>
                <hr>
                <label>Monedas</label>
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 5.00</span>
                        </div>
                        <input class="form-control text-right"  <?= $disabled ?> min="0" pattern="^[0-9]+"  id="Q00500" type="number" aria-describedby="basic-addon3" name='Q00500' value="<?= $caja->Q00500?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 2.00</span>
                        </div>
                        <input class="form-control text-right"  min="0"  <?= $disabled ?> pattern="^[0-9]+" id="Q00200" type="number" aria-describedby="basic-addon3" name='Q00200' value="<?= $caja->Q00200?>">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 1.00</span>
                        </div>
                        <input class="form-control text-right" min="0"  <?= $disabled ?> pattern="^[0-9]+"  id="Q00100" type="number" aria-describedby="basic-addon3" name='Q00100' value="<?= $caja->Q00100?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 0.50</span>
                        </div>
                        <input class="form-control text-right" min="0"  <?= $disabled ?> pattern="^[0-9]+"  id="Q00050" type="number" aria-describedby="basic-addon3" name='Q00050' value="<?= $caja->Q00050?>">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 0.20</span>
                        </div>
                        <input class="form-control text-right" min="0"  <?= $disabled ?> pattern="^[0-9]+"  id="Q00020" type="number" aria-describedby="basic-addon3" name='Q00020' value="<?= $caja->Q00020?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">S/ 0.10</span>
                        </div>
                        <input class="form-control text-right" min="0"  <?= $disabled ?> pattern="^[0-9]+"  id="Q00010" type="number" aria-describedby="basic-addon3" name='Q00010' value="<?= $caja->Q00010?>">
                    </div>

                </div>
                
                <hr>
                <div class="row">
                   
                    <div class="col-lg-12" style="display:none" id="error_cuadre">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    no se puede cerrar caja porque no coincide con el total 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </div>
                    
                    <div class="col-lg-12" style="display:none" id="cuadre_correcto">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Los montos coinciden ahora puede cerrar la caja
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    </div>
                </div>
                <!-- <label>Importe tarjeta</label>
                <div class="row">
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Visa</span>
                        </div>
                        <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="ImporteVisa" type="number" aria-describedby="basic-addon3" name='ImporteVisa' value="<?= $caja->ImporteVisa?>">
                    </div>
                    <div class="input-group mb-3 col-lg-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Mastercard</span>
                        </div>
                        <input class="form-control text-right"  min="0" pattern="^[0-9]+" id="ImporteMC" type="number" aria-describedby="basic-addon3" name='ImporteMC' value="<?= $caja->ImporteMC?>">
                    </div>
                </div> -->

            </div>
            <div class="card-footer">
                <input class="btn btn-success" style="display:none"  type="submit" id="btnEnviar" value="Cuadrar ccaja">

            </div>
        </div>
    </form>
</div>
<div class="col-lg-6 ">

    <div class="row border border-dark p-2">
    <div class="col-lg-6">
        <h3>Importe Apertura</h3>
        <h3>Ventas en Efectivo</h3>
        <h3>Ventas con Visa</h3>
        <h3>Ventas con MasterCard</h3>
        <h3>Cobro de deudas</h3>
        <hr>
        <h3>Total en caja</h3>
    </div>
    <div class="col-lg-6 text-right ">
        <h3><?php
        if(isset($importe_apertura)){
            echo "S/".$importe_apertura->total;
        }else{
            echo "S/0.00";
        }
        ?>

        </h3>
        <h3><?php
        if(isset($importe_ventas)){
            $total_ventas_y_cobros_hoy = $importe_ventas->total + $importe_cobros_hoy->total;
           
            echo "S/".number_format($total_ventas_y_cobros_hoy,2);
        }
         ?></h3>
        <h3>
        <?php
            if(isset($importe_visa)){
                echo "S/".number_format($importe_visa->total,2);
            }
        ?>

        </h3>
        <h3>
        <?php
            if(isset($importe_mastercard)){
                echo "S/".number_format($importe_mastercard->total,2);
            }
        ?>
        </h3>
        <h3>
        <h3 id="total"><?php
            if(isset($importe_cobros_hoy)){
                echo "S/".number_format($importe_cobros_hoy->total,2);
            }

        ?></h3>
        </h3>
        <hr>
        <h3 id="total"><?php
            if(isset($importe_apertura)){
                $total = $importe_apertura->total + $importe_ventas->total + $importe_cobros_hoy->total;
                echo "<input type='hidden' value='$total' id='monto_total'>";
                echo "S/".number_format($total,2);
            }

        ?></h3>
    </div>
    </div>
</div>
</div>
<style>

</style>
<script>

$(document).ready(function(){
    $('#caja').addClass('show').addClass('active');
    $('#cuadre_caja').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-calculator'></em> <span>Cuadre de caja</span>";

    $("#Q20000").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q10000").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q05000").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q02000").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q01000").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q00500").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q00200").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q00100").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q00050").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });

    $("#Q00020").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });
    $("#Q00010").on("keyup", function() {
        var Q20000 = $("#Q20000").val() * 200;
        var Q10000 = $("#Q10000").val() * 100;
        var Q05000 = $("#Q05000").val() * 50;
        var Q02000 = $("#Q02000").val() * 20;
        var Q01000 = $("#Q01000").val() * 10;
        var Q00500 = $("#Q00500").val() * 5;
        var Q00200 = $("#Q00200").val() * 2;
        var Q00100 = $("#Q00100").val() * 1;
        var Q00050 = $("#Q00050").val() * 0.50;
        var Q00020 = $("#Q00020").val() * 0.20;
        var Q00010 = $("#Q00010").val() * 0.10;

        var suma = Q20000 + Q10000 + Q05000 + Q02000 + Q01000 + Q00500 + Q00200 + Q00100 + Q00050 + Q00020 + Q00010;
        
        var total = $("#monto_total").val();
        $("#error_cuadre").show();
        if(suma == total){
            $("#cuadre_correcto").show();
            $("#error_cuadre").hide();
            $("#btnEnviar").show();
        }else{
            $("#error_cuadre").show();
            $("#cuadre_correcto").hide();
            $("#btnEnviar").hide();
        }
    });



    $("#formulario").bind("submit",function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEnviar");
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize(),
            beforeSend: function(){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button
                btnEnviar.val("Verificando"); // Para input de tipo button
               btnEnviar.attr("disabled","disabled");
               console.log("se esta enviando");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                var Q20000 = $("#Q20000").prop('disabled', true);
                var Q10000 = $("#Q10000").prop('disabled', true);
                var Q05000 = $("#Q05000").prop('disabled', true);
                var Q02000 = $("#Q02000").prop('disabled', true);
                var Q01000 = $("#Q01000").prop('disabled', true);
                var Q00500 = $("#Q00500").prop('disabled', true);
                var Q00200 = $("#Q00200").prop('disabled', true);
                var Q00100 = $("#Q00100").prop('disabled', true);
                var Q00050 = $("#Q00050").prop('disabled', true);
                var Q00020 = $("#Q00020").prop('disabled', true);
                var Q00010 = $("#Q00010").prop('disabled', true);
                btnEnviar.val("Se cerró la caja ");
                //btnEnviar.removeAttr("disabled");
                window.location.href = "<?=base_url('Caja/show_cierre') ?>";
                console.log("termino la peticion");
            },
            success: function(data){
                /*
                * Se ejecuta cuando termina la petición y esta ha sido
                * correcta
                * */
               if(data == 1){
                var Q20000 = $("#Q20000");
                var Q10000 = $("#Q10000");
                var Q05000 = $("#Q05000");
                var Q02000 = $("#Q02000");
                var Q01000 = $("#Q01000");
                var Q00500 = $("#Q00500");
                var Q00200 = $("#Q00200");
                var Q00100 = $("#Q00100");
                var Q00050 = $("#Q00050");
                var Q00020 = $("#Q00020");
                var Q00010 = $("#Q00010");
                var ImporteVisa = $("#ImporteVisa");
                var ImporteMC = $("#ImporteMC");

                    Q20000.css({"background":"#e2ffe2"});
                    Q10000.css({"background":"#e2ffe2"});
                    Q05000.css({"background":"#e2ffe2"});
                    Q02000.css({"background":"#e2ffe2"});
                    Q01000.css({"background":"#e2ffe2"});
                    Q00500.css({"background":"#e2ffe2"});
                    Q00200.css({"background":"#e2ffe2"});
                    Q00100.css({"background":"#e2ffe2"});
                    Q00050.css({"background":"#e2ffe2"});
                    Q00020.css({"background":"#e2ffe2"});
                    Q00010.css({"background":"#e2ffe2"});
                    ImporteVisa.css({"background":"#e2ffe2"});
                    ImporteMC.css({"background":"#e2ffe2"});
                   confirm("se guardó el cuadre de caja");
               }else if(data == 0){
                var Q20000 = $("#Q20000");
                var Q10000 = $("#Q10000");
                var Q05000 = $("#Q05000");
                var Q02000 = $("#Q02000");
                var Q01000 = $("#Q01000");
                var Q00500 = $("#Q00500");
                var Q00200 = $("#Q00200");
                var Q00100 = $("#Q00100");
                var Q00050 = $("#Q00050");
                var Q00020 = $("#Q00020");
                var Q00010 = $("#Q00010");
                var ImporteVisa = $("#ImporteVisa");
                var ImporteMC = $("#ImporteMC");

                    Q20000.css({"background":"#ff9a9a"});
                    Q10000.css({"background":"#ff9a9a"});
                    Q05000.css({"background":"#ff9a9a"});
                    Q02000.css({"background":"#ff9a9a"});
                    Q01000.css({"background":"#ff9a9a"});
                    Q00500.css({"background":"#ff9a9a"});
                    Q00200.css({"background":"#ff9a9a"});
                    Q00100.css({"background":"#ff9a9a"});
                    Q00050.css({"background":"#ff9a9a"});
                    Q00020.css({"background":"#ff9a9a"});
                    Q00010.css({"background":"#ff9a9a"});
                    ImporteVisa.css({"background":"#ff9a9a"});
                    ImporteMC.css({"background":"#ff9a9a"});

                    alert("no se puede cerrar caja porque no coincide con el total ");
               }

                console.log(data);
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                alert("Problemas al tratar de enviar el formulario");
            }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });
})
</script>