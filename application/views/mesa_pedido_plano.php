<style>
    .mesa{
        width: 100%;
        height: 240px;
        background: white;
        border: 1px solid black;
    }

</style>
   
   <div class="card col-sm-6 offset-xl-3">
   <div class="card-body">
   <div class="row">
        <div class="col-6">
            
            <a class="btn btn-secondary btn-oval text-bold btn-xl" href="<?php echo base_url('Pedido/nuevodetalle_posicion/').$ID_Pedido."/1" ?>">Cliente 1</a>
            <div class="ml-3"><a class="btn btn-sm btn-secondary"  href="<?php echo base_url('Pedido/detallePosicion/').$ID_Pedido."/1" ?>">ver detalle</a></div>
           
        </div>
        <div class="col-6">
            <a class="btn btn-secondary btn-oval text-bold btn-xl" href="<?php echo base_url('Pedido/nuevodetalle_posicion/').$ID_Pedido."/2" ?>">Cliente 2</a>
            <div class="ml-3"><a class="btn btn-sm btn-secondary"  href="<?php echo base_url('Pedido/detallePosicion/').$ID_Pedido."/2" ?>">ver detalle</a></div>
            
        </div>
   </div>
       <div class="mesa m-2">

       </div>
    <div class="row">
        <div class="col-6">
        <div class="ml-3"><a class="btn btn-sm btn-secondary"  href="<?php echo base_url('Pedido/detallePosicion/').$ID_Pedido."/3" ?>">ver detalle</a></div>
            <a class="btn btn-secondary btn-oval text-bold btn-xl" href="<?php echo base_url('Pedido/nuevodetalle_posicion/').$ID_Pedido."/3" ?>">Cliente 3</a>
            
            
        </div>
        <div class="col-6">
        <div class="ml-3"><a class="btn btn-sm btn-secondary"  href="<?php echo base_url('Pedido/detallePosicion/').$ID_Pedido."/4" ?>">ver detalle</a></div>
            <a class="btn btn-secondary btn-oval text-bold btn-xl" href="<?php echo base_url('Pedido/nuevodetalle_posicion/').$ID_Pedido."/4" ?>">Cliente 4</a>
            
        
        </div>
   </div>
   </div>

    <div class="card-footer">
        <a href="<?php echo base_url('Pedido')?>" class="btn btn-warning">Volver</a>
    </div>
</div>


