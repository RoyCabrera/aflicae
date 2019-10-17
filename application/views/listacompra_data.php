<style>
.pagination:{
	display:none;
}
</style>

            
<form action="<?php echo base_url('Compra/AsignarListaCompra') ?>" method="POST" id="frm">

	<div class="offset-md-3 offset-xl-3 col-md-6 col-xl-6 offset-xs-0 col-xs-12">
    <div class="card">
		<div class="card-body" >
			<!-- START card tab-->
		
			<input type='hidden' name='ID_ListaCompra' id="ID_ListaCompra" value="<?php echo encriptar($listacompra->ID_ListaCompra); ?>">
				
            <label>Personal</label>
            <select class="form-control" name='CodUsuario' id='CodUsuario' required>
                <option value=''>-- Seleccione --</option>
                <?php
                    if($list_usuarios){
                        foreach($list_usuarios->result() as $row){
                            if($row->Correo == $listacompra->CodUsuario){
                                echo "<option selected value='".$row->Correo."' >".$row->Nombre."  ".$row->ApellidoPaterno. " ".$row->ApellidoMaterno."</option>";
                            }else {
                                echo
                                "<option value='".$row->Correo."'>".$row->Nombre."  ".$row->ApellidoPaterno. " ".$row->ApellidoMaterno.
                                "</option>";
                            }
                        
                        }
                    }
                    ?>
            </select>
					
            <label for="Observacion" class='pt-2'>Observación</label>
            <textarea name="Observacion" rows="6" id="Observacion" class="form-control"><?php echo $listacompra->Observacion; ?></textarea>
        
            

        </div>
        <div class="card-footer">
            <div class="col-12">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
        </div>
			

		
	</div>
    </div>
</form>


<script>
	$(document).ready(function () {
        $('#t_compras').addClass('show').addClass('active');
        $('#t_lista').addClass('active');

        var d = document.getElementById("titulomodulo");
	  d.innerHTML = "<em class='fa fa-user''></em> <span>Asignar personal</span>";

	});


	$("#frm").submit(function (event) {
		var validator = $('#frm').data('bootstrapValidator');
		validator.validate();
		console.log(validator.validate());
		if (!validator.isValid()) {
			//return false;
		}
	});
	<?php maestra(); ?>

</script>
