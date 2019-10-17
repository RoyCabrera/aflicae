<div class="col-lg-6 offset-lg-3">
    <form action="<?php echo base_url('Caja/insertarAperturaCaja') ?>" method="POST" id="frm">
        <div class="card">
            <div class="card-body">
            <label>Billetes</label>
            <input type="hidden" name="ID_Apertura" id="ID_Apertura" value="<?= encriptar($caja->ID_Apertura) ?>">
            
            <div class="row">
            <div class="input-group mb-3 col-lg-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">S/ 200.00</span>
                </div>
                <input class="form-control text-right" id="doscientos" min="0" pattern="^[0-9]+" type="number" aria-describedby="basic-addon3" name='Q20000' value="<?= $caja->Q20000 ?>">
                </div>
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 100.00</span>
                    </div>
                    <input class="form-control text-right" id="cien" min="0" pattern="^[0-9]+" type="number" aria-describedby="basic-addon3" name='Q10000' value="<?= $caja->Q10000 ?>">
                </div>
                
            </div>
            <div class="row">
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text " id="basic-addon3">S/ 50.00</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="cincuenta" type="number" aria-describedby="basic-addon3" name='Q05000' value="<?= $caja->Q05000 ?>">
                </div>
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 20.00</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="veinte" type="number" aria-describedby="basic-addon3" name='Q02000' value="<?= $caja->Q02000 ?>">
                </div>
                
            </div>

            <div class="row">
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 10.00</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+" id="diez" type="number" aria-describedby="basic-addon3" name='Q01000' value="<?= $caja->Q01000 ?>">
                </div>
            </div>
            <hr>
            <label>Monedas</label>
            <div class="row">
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 5.00</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00500' value="<?= $caja->Q00500 ?>">
                </div>
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 2.00</span>
                    </div>
                    <input class="form-control text-right"  min="0" pattern="^[0-9]+" id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00200' value="<?= $caja->Q00200 ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 1.00</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00100' value="<?= $caja->Q00100 ?>">
                </div>
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 0.50</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00050' value="<?= $caja->Q00050 ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 0.20</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00020' value="<?= $caja->Q00020 ?>">
                </div>
                <div class="input-group mb-3 col-lg-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">S/ 0.10</span>
                    </div>
                    <input class="form-control text-right" min="0" pattern="^[0-9]+"  id="basic-url" type="number" aria-describedby="basic-addon3" name='Q00010' value="<?= $caja->Q00010 ?>">
                </div>
                
            </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" id='guardarApertura'  type="submit" >Aperturar</button>
                
                <a class="btn btn-warning" id='cancelarApertura'  href="<?= base_url('Caja/show_apertura')?>">Cancelar</a>
                
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function(){
    $('#caja').addClass('show').addClass('active');
    $('#apertura_caja').addClass('active');
    var d = document.getElementById("titulomodulo");
    d.innerHTML = "<em class='fa fa-dollar'></em> <span>Apertura de caja</span>";

    
})
</script>