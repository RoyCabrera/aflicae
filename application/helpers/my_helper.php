<?php

if ( ! function_exists('sessionExist'))
{
    function sessionExist(){
        $CI =& get_instance();
        if(!$CI->session->userdata('token')){
            redirect('Login','refresh');
        }
    }

}

if ( ! function_exists('validaToken'))
{
    function validaToken(){
        $ci =& get_instance();
        if($ci->Token_model->validaToken() != $ci->session->userdata('token')){
            redirect('Login/validaToken');
        }
    }

}


if ( ! function_exists('insertarLog'))
{
    function insertarLog($Log){
        $ci =& get_instance();
        $ci->Log_model->insertarLog($Log);
    }

}

if ( ! function_exists('devolverUAFAUMFM'))
{
    function devolverUAFAUMFM($UsuarioAlta,$FechaAlta,$UsuarioMod,$FechaMod){
		date_default_timezone_set('America/Lima');
        $ci =& get_instance();
        $UsuarioAlta = $ci->Usuario_model->selectNombreCompleto($UsuarioAlta);
        $UsuarioMod = $ci->Usuario_model->selectNombreCompleto($UsuarioMod);
        echo "<em class='icon-plus color-tema' style='padding-right:5px'></em>".$UsuarioAlta." [".date('d/m/Y',strtotime($FechaAlta))."]   <em class='icon-pencil color-tema' style='padding-right:5px'></em> ".$UsuarioMod." [".date('d/m/Y',strtotime($FechaMod))."]" ;
    }

}


if ( ! function_exists('encriptar'))
{
    function encriptar($ID){
        $ci =& get_instance();
        $ID = $ci->encryption->encrypt($ID);
        $search  = array('/', '=', '+');
        $replace = array('~', '-', '.');
        $subject = $ID;
        $ID = str_replace($search, $replace, $subject);
        return $ID;
    }

}


if ( ! function_exists('desencriptar'))
{
    function desencriptar($ID){
        $ci =& get_instance();

        $search = array('~', '-', '.');
        $replace  = array('/', '=', '+');
        $subject = $ID;
        $ID = str_replace($search, $replace, $subject);
        $ID = $ci->encryption->decrypt($ID);

        return $ID;
    }

}

if ( ! function_exists('subirimagen'))
{
    function subirimagen($ruta1,$ruta2,$nombre_archivo){
        $ci =& get_instance();
      // echo "-->".$_SERVER['DOCUMENT_ROOT'].$ruta1."<br>";
     // echo URL_RAIZ.$ruta1."<br>";
        if(!file_exists(URL_RAIZ.$ruta1)){
            mkdir(URL_RAIZ.$ruta1,0777,true);
        }
     //  echo 'assets/img'.$ruta2."/";

            $config['upload_path'] = 'assets/img'.$ruta2;
            $config['allowed_types'] = "*";
            $config['max_size'] = "5000000";
            $config['max_width'] = "20000";
            $config['max_height'] = "20000";
            $config['overwrite'] = TRUE;

            $ci->load->library('upload', $config);
            print_r($config);

            if (!$ci->upload->do_upload($nombre_archivo)) {
                                //*** ocurrio un error
                                //   $data['uploadError'] = $this->upload->display_errors();
                      print_r($ci->upload->display_errors());
                                	die;exit;
                return false;
            }else{
                return true;
            }
    }
}

if ( ! function_exists('subirimagenthumbnail'))
{
function subirimagenthumbnail($ruta,$rutaorigen,$rutathumbnail){
    $ci =& get_instance();
    //echo $_SERVER['DOCUMENT_ROOT'].$ruta."<br>";
    if(!file_exists(URL_RAIZ.$ruta)){
        mkdir(URL_RAIZ.$ruta,0777);
    }
    //echo $rutaorigen."<br>";
   // echo $rutathumbnail."<br>";

        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] =  'assets/img'.$rutaorigen;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']= 'assets/img'.$rutathumbnail;
        $config['width'] = 150;
        $config['height'] = 150;
        $ci->load->library('image_lib', $config);
        $ci->image_lib->resize();
    return true;
}
}


if( !function_exists('maestra') ){
    function maestra(){
        echo "
        $('.maestra').DataTable({
            'paging': true, // Table pagination
            'ordering': true, // Column ordering
			'info': true, // Bottom left status text
            responsive: true,
            oLanguage: {
                'sInfo': ' _START_ - _END_ hasta _TOTAL_ items',
                sSearch: 'Buscar:',
                sLengthMenu: '_MENU_ número de items',
                info: 'Página _PAGE_ d _PAGES_',
                zeroRecords: 'No se encontró ningún items',
                infoEmpty: 'No existen items registrados',
                infoFiltered: '(filtered from _MAX_ total items)',
                oPaginate: {
                    sNext: '<em class=\"fa fa-caret-right\"></em>',
                    sPrevious: '<em class=\"fa fa-caret-left\"></em>'
                }
            },
            // Datatable Buttons setup
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copy', className: 'btn-warning' },
                { extend: 'csv', className: 'btn-warning' },
                { extend: 'excel', className: 'btn-warning', title: 'XLS-File' },
                { extend: 'pdf', className: 'btn-warning', title: $('title').text() },
                { extend: 'print', className: 'btn-warning' }
            ]
        });
        ";
    }


    if(!function_exists('mesAletra')){
        function mesAletra($mes){

                    $arrayMes = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

                        return $arrayMes[$mes];

                }
    }

}
if( !function_exists('maestra2') ){
    function maestra2(){
        echo "
        $('.maestra2').DataTable({
            'paging': true, // Table pagination
            'ordering': false, // Column ordering
			'info': true, // Bottom left status text
            responsive: true,
            oLanguage: {
                'sInfo': ' _START_ - _END_ hasta _TOTAL_ items',
                sSearch: 'Buscar:',
                sLengthMenu: '_MENU_ número de items',
                info: 'Página _PAGE_ d _PAGES_',
                zeroRecords: 'No se encontró ningún items',
                infoEmpty: 'No existen items registrados',
                infoFiltered: '(filtered from _MAX_ total items)',
                oPaginate: {
                    sNext: '<em class=\"fa fa-caret-right\"></em>',
                    sPrevious: '<em class=\"fa fa-caret-left\"></em>'
                }
            },
            // Datatable Buttons setup
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copy', className: 'btn-warning' },
                { extend: 'csv', className: 'btn-warning' },
                { extend: 'excel', className: 'btn-warning', title: 'XLS-File' },
                { extend: 'pdf', className: 'btn-warning', title: $('title').text() },
                { extend: 'print', className: 'btn-warning' }
            ]
        });
        ";
    }


    if(!function_exists('mesAletra2')){
        function mesAletra2($mes2){

                    $arrayMes = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

                        return $arrayMes[$mes2];

                }
    }

}

?>
