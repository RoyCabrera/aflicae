<?php
/* http://mifabricaonline.com/CodeIgniter/index.php/Bbdd2code/generar/69/TPresencia/Presencia/ID_Presencia */
class Bbdd2code extends CI_Controller {

 private $DB2=null ;


  public function __construct() {
    parent::__construct();


    $this->load->helper('my_helper');

   // $this->DB2 = $this->load->database(coneccion(),TRUE);
    $this->DB2 =  $this->load->database();
        
	    $this->ID=$this->session->userdata('ID');

  }

public function generar($id,$tabla,$alias,$id_clave) {

    $sql= "SELECT *  FROM   "  . $tabla ;
    $query = $this->DB2->query($sql);

		echo "Inicio controlador-------------------------------------------------";
echo "
<-?php<br>
class ". $alias ." extends CI_Controller {<br>
public function __construct() {<br>
&nbsp; parent::__construct();<br>
&nbsp; €this->load->helper('url');<br>
&nbsp; €this->load->helper('mi_helper');<br>

&nbsp; €this->load->model('". $alias ."_model');<br>

&nbsp; codigoinicio();<br>

} <br><br>
public function index() {<br>
&nbsp; €data = array( );<br>
&nbsp; €query = €this->". $alias ."_model->selectAll();<br>
&nbsp; if(!€query || €query->num_rows() < 1) {<br>
&nbsp; &nbsp; €data['". strtolower ($alias) ."_list'] = null;<br>
&nbsp; }<br>
&nbsp; else {<br>
&nbsp; €data['". strtolower ($alias) ."_list'] = array( );<br>
&nbsp; foreach (€query->result() as €row) {<br>
&nbsp; &nbsp; €Aux = array( );<br>
";
foreach ($query->list_fields() as $col) {
echo "&nbsp;€Aux['$col'] = €row->$col;<br>";
}
echo "&nbsp;  €data['". strtolower ($alias) ."_list'][] = €Aux;<br>
}&nbsp; <br>
}&nbsp; <br>
&nbsp; €this->load->view('". strtolower ($alias) ."_table', €data);<br>
}<br><br>";
echo "
public function eliminar(€$id_clave) {<br>
<br>
&nbsp; if(!$id_clave) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp; &nbsp; return;<br>
&nbsp; }<br>
<br>
&nbsp; €query = €this->". $alias ."_model->select(€$id_clave);<br>
&nbsp; if(!€query || €query->num_rows() < 1) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp; &nbsp; return;<br>
&nbsp; }<br>
<br>
&nbsp; €row = €query->row();<br>
&nbsp; if(!€row) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp;&nbsp;  return;<br>
&nbsp; }<br>
<br>
&nbsp; €eliminar = €this->". $alias ."_model->eliminar(€$id_clave);<br>
<br>
//si la actualización ha sido correcta creamos una sesión flashdata para decirlo<br>
<br>
&nbsp; if(€eliminar)<br>
&nbsp; {<br>
&nbsp; &nbsp; €this->session->set_flashdata('eliminado', 'Este item se eliminó correctamente');<br>
&nbsp; &nbsp; redirect('". $alias ."', 'refresh');<br>
&nbsp; }<br>
<br>
&nbsp; }<br>
";

echo "
public function ". $alias ."(€$id_clave) {<br>
<br>
&nbsp; if(!€$id_clave) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp; &nbsp; return;<br>
&nbsp; }<br>
<br>
&nbsp; €query = €this->". $alias ."_model->select(€$id_clave);<br>
&nbsp; if(!€query || €query->num_rows() < 1) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp; &nbsp; return;<br>
&nbsp; }<br>
<br>
&nbsp; €row = €query->row();<br>
&nbsp; if(!€row) {<br>
&nbsp; &nbsp; show_404();<br>
&nbsp; &nbsp; return;<br>
&nbsp; }<br>
<br>
&nbsp; €Aux = array( );<br>
";
foreach ($query->list_fields() as $col) {
echo "&nbsp; €Aux['$col'] = €row->$col;<br>";
}
echo "
&nbsp; €data['". strtolower ($alias) ."_data'] = €Aux;<br>
&nbsp; €this->load->view('". strtolower ($alias) ."_data', €data);</br>
&nbsp; }<br><br>
";

echo "    public function nuevo() {<br>
&nbsp; €Aux = array( );<br>";
foreach ($query->list_fields() as $col) {
echo "&nbsp; €Aux['$col'] = '';</br>";
}
echo "<br>
&nbsp; €data['". strtolower ($alias) ."_data'] = €Aux;<br>
&nbsp; €this->load->view('". strtolower ($alias) ."_data', €data);<br>
} <br>
";
echo"
public function actualizar() { </br>
</br>
";
foreach ($query->list_fields() as $col) {
echo "&nbsp; €$col = €this->input->post('$col');</br>";
}
echo"</br>
 
&nbsp; if(!€$id_clave) {</br>
&nbsp; &nbsp; €actualizar = €this->". $alias ."_model->insertar(</br>
";
foreach ($query->list_fields() as $col) { echo "€$col,";}
echo "</br>
);</br>
}</br>
else</br>
{ </br>
€actualizar = €this->". $alias ."_model->actualizar(";
foreach ($query->list_fields() as $col) { echo "€$col,";}
echo ");</br>
}</br>
if(€actualizar)</br>
{</br>
&nbsp; €this->session->set_flashdata('actualizado', 'El item se actualizó correctamente');</br>
&nbsp; redirect('". $alias ."', 'refresh');</br>
}</br>
}</br>
}</br>
?-></br>
";

		echo "Inicio modelo-------------------------------------------------";

echo "
<-?php</br>
class ". $alias  ."_model extends CI_Model {</br>
  private €DB2=null ;</br>
   public function __construct() {</br>
    parent::__construct();</br>
    &nbsp; &nbsp; 	€this->DB2 = €this->load->database(coneccion(), TRUE);</br>
    
  

	 &nbsp; &nbsp;     €this->ID=€this->session->userdata('ID');</br>
  }</br>
     public function selectAll() {</br>
&nbsp; &nbsp;     €sql= 'SELECT *  FROM   ". $tabla ."' ;</br>
&nbsp; &nbsp;     €result = €this->DB2->query(€sql);</br>
 &nbsp; &nbsp;    if(!€result) {return false;}</br>
 &nbsp; &nbsp;    return €result; </br>
  }</br>
   public function select(€$id_clave) {</br>
  &nbsp; &nbsp;   €sql= 'SELECT *  FROM   ". $tabla ." where $id_clave=€". $id_clave ."' ;</br>
  &nbsp; &nbsp;  €result = €this->DB2->query(€sql);</br>
    if(!€result) {</br>
  &nbsp; &nbsp; &nbsp; &nbsp;     return false;</br>
  &nbsp; &nbsp;   }</br>
  &nbsp; &nbsp;   return €result; </br>
  }</br>

     public function actualizar(</br>
	 ";
	 foreach ($query->list_fields() as $col) { echo "€$col,";}

	 echo "
	 ) {</br>
		&nbsp; &nbsp; 	€data = array(</br>
 ";
				foreach ($query->list_fields() as $col) { echo " &nbsp; &nbsp; &nbsp; &nbsp; '$col' => €$col,  </br>";}
	echo "
        );</br>

      &nbsp; &nbsp;   €this->DB2->where('$id_clave',€$id_clave);</br>
      &nbsp; &nbsp;   return €this->DB2->update( '". $tabla ."', €data);</br>

	}</br>

";
echo "
public function insertar( </br>
";
foreach ($query->list_fields() as $col) { echo "€$col,</br>";}
echo ") {</br>
€data = array( </br>
";
foreach ($query->list_fields() as $col) { echo " '$col' => €$col,  </br>";}
echo ");
&nbsp; &nbsp; &nbsp; &nbsp; €this->DB2->insert('". $tabla ."', €data); </br>
&nbsp; &nbsp; &nbsp; &nbsp; €insert_id = €this->DB2->insert_id();
return true; </br>

}	  </br>

	public function eliminar( €$id_clave){</br>
		&nbsp; &nbsp; &nbsp; &nbsp; 	€this->DB2->where('$id_clave', €$id_clave);</br>
		&nbsp; &nbsp; &nbsp; &nbsp; 	return €this->DB2->delete( '". $tabla ."');</br>

	} </br>} </br>
";
echo "inicio vista-TABLA-------------------------";

		echo "
		                        (table id='datatable1' class='table table-striped table-hover')</br>
                              (thead)</br>
                                 (tr)</br>
									 ";	foreach ($query->list_fields() as $col) { echo " (td)$col(/td)</br>";} echo "</br>
									(th)Editar (/th)</br>
                                    (th)Eliminar(/th)</br>

                                 (/tr)</br>
                              (/thead)</br>
                              (tbody)</br>

							  (?php</br>
									if(€". strtolower ($alias) ."_list){reset(€". strtolower ($alias) ."_list);  </br>
									foreach (€". strtolower ($alias) ."_list as €aux) {</br>
										€rutaeliminar= site_url('/$alias/eliminar/' . €aux['$id_clave']); </br>
										echo ''</br>
										(tr )</br>
										 ";	foreach ($query->list_fields() as $col) { echo " (td)' €aux['$col'](/td)</br>";} echo "</br>
												(td)(a href='''. site_url('/". $tabla ."/". $tabla ."/' . €aux['$id_clave']) . ''') (em class='icon-pencil' style='padding-right:5px')(/em)  (/a)(/td)</br>
												 (td)(a href='#'  onclick=\''return eliminar(''' . €rutaeliminar  .''')\" )(em class='icon-trash' style='padding-right:5px'   )(/em) (/a) (/td)</br>
											 (/tr)</br>
										'';</br>

									}}</br>
						?)</br>

                              (/tbody)</br>
                           (/table)</br>



		";

		echo "INICI DATA------------------------------------"
		;
		echo "
   (div id='panelDemo2' class='panel panel-default panel-demo')</br>
	(div class='panel-heading')</br>
	   (a href='(?php echo site_url('". $tabla ."') ?)' data-tool='panel-dismiss' data-toggle='tooltip' title='Close Panel' class='pull-right')</br>
		  (em class='fa fa-times')(/em)</br>
	   (/a)</br>
	(/div)</br>

(form method='post' accept-charset='utf-8' action='(?php echo site_url(); ?)/". $tabla ."/actualizar'  class='panel'  id='frmDetalle". $tabla ."' /)</br>
(div class='panel-body')</br>
(input type='text'  value='(?php echo €". $tabla ."_data['$id_clave']; ?)' id='$id_clave' name='$id_clave'   style='display:none'   )</br>


";	foreach ($query->list_fields() as $col) { echo "

(fieldset) </br>
(div class='form-group')</br>
(label class='col-md-2 control-label')$col(/label)</br>
(div class='col-md-10')</br>
(input type='text' value='(?php echo €". $tabla ."_data['$col']; ?)'  id='$col' name='$col'    class='form-control' required )</br>
(/div)</br>
(/div)</br>
(/fieldset)</br>

";} echo "







(/div) </br>
(div class='panel-footer')</br>
(div class='text-right mt-lg')</br>
(a href='(?php echo site_url('". $tabla ."') ?)')(button type='button' class='btn btn-danger')Cancelar(/button)(/a)</br>
(button  type='submit' class='btn btn-success')Guardar(/button)</br>
(/div)</br>
(/div) </br>
(/form) </br>
		(/div)</br>
		"

		;

    }



  }

?>
