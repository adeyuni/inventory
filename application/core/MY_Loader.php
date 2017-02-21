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
   
   	public function check_session_admin($enableRedirect = true) {
		$ci =& get_instance();
	
		if (!isset($_SESSION['username'])) {
			if ($enableRedirect) {
				$ci->output->set_header('Location: '.site_url('/admin/login?next='.urlencode($_SERVER['REQUEST_URI'])));
			}
			return false;
		}
		return true;
	}
}