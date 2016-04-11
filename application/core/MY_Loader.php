<?php
/**
 * MY_Loader merupakan extends dari CI_Loader
 * @author Ade Y
 * 
 */
class MY_Loader extends CI_Loader {

    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $this->view('skin/header', $vars, $return);
        $this->view('skin/body', $vars, $return);
		$this->view($template_name, $vars, $return);
        $this->view('skin/footer', $vars, $return);
    }
   
}