<?php
/*
 * loads whole page template.
 * adds custom template and admin_template methos to CI_Loader class
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Loader extends CI_Loader {

    public function template($template_name, $vars = array(), $return = FALSE)
    {
        define("BASE_URL", base_url());
        define("RES_URL", base_url() . "assets/");
        $router =& load_class('Router', 'core');
        $CI =& get_instance();
        $vars['user_info'] = $CI->session->userdata('user_info');
        $vars['current_page'] = $router->fetch_class();
        $vars['current_action'] = $router->fetch_method();
        if($return):
            $content  = $this->view('shared/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('shared/footer', $vars, $return);
            return $content;
        else:
            $this->view('shared/header', $vars);
            $this->view($template_name, $vars);
            $this->view('shared/footer', $vars);
        endif;
    }

    public function template_admin($template_name, $vars = array(), $return = FALSE)
    {
        define("BASE_URL", base_url());
        define("RES_URL", base_url() . "assets/");
        $router =& load_class('Router', 'core');
        $CI =& get_instance();

        $vars['admin_info'] = $CI->session->userdata('admin_info');
        $vars['current_page'] = $router->fetch_class();
        $vars['current_action'] = $router->fetch_method();
        
		if($return):
            $content  = $this->view('admin/header', $vars, $return);
            $content  = $this->view('nav', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('admin/footer', $vars, $return);
            return $content;
        else:
            $this->view('admin/header', $vars);
            $this->view('nav', $vars);
            $this->view($template_name, $vars);
            $this->view('admin/footer', $vars);
        endif;
    }
}
?>