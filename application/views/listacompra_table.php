<?php
if(desencriptar($_SESSION['ID_Perfil'])==1 || desencriptar($_SESSION['ID_Perfil']) == 2){
    $superadmin = "";
    $maestra = "maestra";
    $agregar = "";
}
else{
    $superadmin = "style='display:none'";
    $maestra = "";
    $agregar = "display:none";
}
?>

<div style="position: absolute;right: 10px;top: 10px;z-index: 100;">
    <a <?php echo $superadmin ?> href='<?php echo base_url('Compra/Asignar');?>'>
        <div class="fab bg-warning">+</div>
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-hover maestra2 table-bordered">
                <thead>
                    <th>Estado</th>
                    <th>Fecha Hora</th>
                    <th>Personal</th>
                    <th>Obsservación</th>
                    <th></th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <?php 
                    
                    if(desencriptar($_SESSION['ID_Perfil']) == 1 || desencriptar($_SESSION['ID_Perfil']) == 2){
                        echo "<th>Dinero</th>
                        
                        <th>Eliminar</th>";
                    }else{
                        echo "";
                    }
                    ?>
                    
                </thead>
                <tbody>
                    <?php 
                    
                        if(isset($listaAsignado)){
                            foreach($listaAsignado->result() as $aux) {
                                    $ID = encriptar($aux->ID_ListaCompra);
                                    $rutaeliminar= base_url('Compra/eliminarListaCompra/'.$ID);
                                    switch ( $aux->ID_Estado) {
                                        case 10:
                                            $color="danger";
                                            break;
                                        case 12:
                                            $color="info";
                                            break;
                                        case 13:
                                            $color="secondary";
                                            break;
                                        case 14:
                                            $color="purple";
                                            break;
                                            case 15:
                                            $color="warning";
                                            break;
                                        default:
                                            $color="success";
                                            break;
                                    }
                                    $rendir="";  
                                    $asignardinero="";
                                if(desencriptar($_SESSION['ID_Perfil']) == 1 || desencriptar($_SESSION['ID_Perfil']) == 2){
                                    if($aux->ID_Estado == 12){
                                        $rendir= "<a class='btn btn-xs btn-inverse' href='".base_url('Compra/rendirListaCompra/'.$aux->ID_ListaCompra)."'>Rendir</a>";
                                    }else{
                                        $rendir="";
                                    }
                                    if($aux->TotalDineroAsignado == null){
                                        $estilo="";
                                    }else{
                                        $estilo="style='display:none'";
                                    }
                                    if($aux->ID_Estado == 15 ||$aux->ID_Estado == 12 || $aux->ID_Estado == 13){
                                        $asignardinero="<td class='w-20'></td>";
                                    }else{
                                        $asignardinero= "<td class='w-20'>
                                        <a   onclick=\"return editar('$aux->CodUsuario','$aux->ID_ListaCompra')\" href='#' data-toggle='modal' data-target='#modalEditarDinero'>
                                            <em class='fas fa-dollar-sign'></em>
                                        </a>
                                    </td>";
                                    }
                                    $permisos = "
                                    
                                    <td class='w-20'>
                                        <a href='#'  onclick=\"return baja('$rutaeliminar')\" >
                                            <em class='icon-trash'></em>
                                        </a>
                                    </td>";
                                }else{
                                    $permisos = "";
                                }
                                
                                $ID_ListaCompra = encriptar($aux->ID_ListaCompra);
                                $Correo = encriptar($aux->CodUsuario);
                                echo "<tr>
                                    <td width='5'><span  class='badge badge-$color' >$aux->Estado</span></td>
                                    <td width='5'>".date_format(date_create($aux->FechaHora), 'd/m/Y H:i:s')."</td>
                                    <td width='5'>$aux->Nombre $aux->ApellidoPaterno $aux->ApellidoMaterno</td>
                                    <td>$aux->Observacion</td>
                                    <td class='w-20'>$rendir</td>
                                    <td class='w-20' >
                                        <a  href='".base_url('Compra/selectDetalleListaCompra/'.$ID_ListaCompra.'/'.$Correo)."'>
                                            <em  class='fas fa-list'></em>
                                        </a>
                                    </td>
                                    <td class='w-20'>
                                        <a  href='".base_url('Compra/listacompraEdit/'.$ID)."'>
                                            <em class='icon-pencil'></em>
                                        </a>
                                    </td>
                                    $asignardinero
                                    $permisos
                                 
                                </tr>";
                            }
                        }
                            
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        $('#t_compras').addClass('show').addClass('active');
        $('#t_lista').addClass('active');
        $('#m_compra_asigna').addClass('active');
        var d = document.getElementById("titulomodulo");
        d.innerHTML = "<em class='fa fa-cart-plus''></em> <span>Lista de compras</span>";
        
      

    });
    
    function AsignarDineroCompras(Correo,ID_ListaCompra){
    
    
        $("#CorreoCompras").val(Correo);
        $('#ID_ListaCompra').val(ID_ListaCompra)
        
    }
    function editar(Correo,ID_ListaCompra) {
        $.ajax({
            type:'POST',
            url:"<?php echo base_url('Compra/selectDineroCompras') ?>/" + ID_ListaCompra+"/"+Correo,
            success:function(data) {
              
                 $('#formularioEditarDinero').html(data);

            },
            fail:function() {
                alert("error");
            }
        });
    }
    function baja(eliminar) {

    swal({
            title: "¿Desea eliminar esta lista de compras?",
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
   
   	
    
    <?php maestra2(); ?>
</script>