<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    http://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @banner    Libraries
 * @author        EllisLab Dev Team
 * @link        http://codeigniter.com/user_guide/general/controllers.html
 */
require_once APPPATH . "/libraries/ResponseMessage.php";

class CI_Controller
{

    /**
     * Reference to the CI singleton
     *
     * @var    object
     */
    private static $instance;

    /**
     * Class constructor
     *
     * @return    void
     */
    public function __construct()
    {
        self::$instance = &$this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = &load_class($class);
        }

        $this->load = &load_class('Loader', 'core');
        $this->load->initialize();

        log_message('info', 'Controller Class Initialized');

        //Mabuya stuff
        $this->load->helper(['form', 'url', 'mabuya']);
        $this->load->library(["session", "form_validation", "cart"]);

        $this->response = new ResponseMessage();
        $this->load_language();

        date_default_timezone_set("America/Guayaquil");
    }

    function check_user_logged()
    {
        if ($this->session->userdata('user_id') === null) {
            redirect("Login/index");
        }
    }



    function init_form_validation()
    {
        $this->form_validation->set_message('required', translate('required'));
        $this->form_validation->set_message('min_length', translate('min_length'));
        $this->form_validation->set_message('max_length', translate('max_length'));
        $this->form_validation->set_message('valid_email', translate('valid_email'));
        $this->form_validation->set_message('matches', translate('matches'));
        $this->form_validation->set_message('is_unique', translate('is_unique'));
        $this->form_validation->set_message('numeric', translate('numeric'));
        $this->form_validation->set_message('exact_length', translate('exact_length'));
        $this->form_validation->set_message('greater_than', translate('greater_than'));
        $this->form_validation->set_message('less_than', translate('less_than'));
        $this->form_validation->set_message('alpha', translate('alpha'));
        $this->form_validation->set_message('alpha_numeric', translate('alpha_numeric'));
        $this->form_validation->set_message('alpha_dash', translate('alpha_dash'));
        $this->form_validation->set_message('integer', translate('integer'));
        $this->form_validation->set_message('decimal', translate('decimal'));
        $this->form_validation->set_message('is_natural', translate('is_natural'));
        $this->form_validation->set_message('is_natural_no_zero', translate('is_natural_no_zero'));
        $this->form_validation->set_message('valid_emails', translate('valid_emails'));
        $this->form_validation->set_message('valid_ip', translate('valid_ip'));
        $this->form_validation->set_message('valid_base64', translate('valid_base64'));
        $this->form_validation->set_message('alpha_numeric_space', translate('alpha_numeric_space'));
        $this->form_validation->set_message('valid_url', translate('valid_url'));
    }

    // --------------------------------------------------------------------

    /**
     * Get the CI singleton
     *
     * @static
     * @return    object
     */
    public static function &get_instance()
    {
        return self::$instance;
    }

    public function login($session_data)
    {
        $this->session->set_userdata($session_data);
    }

    public function is_logged($session_variables, $redirect_to = "")
    {
        $all_ok = TRUE;
        foreach ($session_variables as $key => $data) {
            if ($this->session->userdata($key) != $data) {
                $all_ok = FALSE;
                break;
            }
        }
        return $all_ok;
    }

    public function log_out()
    {
        foreach ($this->session->userdata() as $key => $data) {
            $this->session->unset_userdata($key);
        }
    }



    public function load_view_front($url = "", $data = [], $like_file = 0, $data_seo = null)
    {
        $data_header = [];
        $data_footer = [];
        if ($data_seo != null)
            $data_header['data_seo'] = $data_seo;

        $this->load->model('Empresa_model', 'empresa');
        $data_header['empresa_object'] = $this->empresa->get_by_id(1);
        $data_footer['empresa_object'] = $data_header['empresa_object'];
        $this->load->model('Membresia_model', 'membresia');
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $data_header['membresia_user'] = $this->membresia->get_membresia_by_user_id($user_id);
            $data_footer['membresia_user'] = $data_header['membresia_user'];
        }
        //$this->load->model('Banner_model', 'banner');

        //   $data_header['all_banners'] = $this->banner->get_all();

        //$data_footer['all_banners'] = $data_header['all_banners'];




        /* $this->load->model('Category_model','cat');
        $all_categories = $this->cat->get_all();
        $data_header['all_categories'] = $all_categories;

        $this->load->model('Noticia_model','noticia');
        $data_footer['noticias_footer'] = $this->noticia->get_all(null,null,'fecha_creacion','DESC',3,true);

        $this->load->model('Producto_model','producto');
        $data_footer['productos_footer'] = $this->producto->get_all();*/

        $this->load->view("front_template/header", $data_header);
        $this->load->view($url, $data, $like_file);

        // $data_footer['categories_footer'] = $this->cat->get_all();
        $this->load->view("front_template/footer", $data_footer);
    }


    public function load_view_admin_g($url = "", $data = [], $like_file = 0)
    {

        $this->load->view("admin/header_g");


        $this->load->view("admin/left_g");
        $this->load->view($url, $data, $like_file);

        $this->load->view("admin/footer_g");
    }







    protected function load_language()
    {
        if (isset($_SESSION['lang_subasta'])) {
            switch ($_SESSION['lang_subasta']) {
                case "es": {

                        $this->config->load('es_lang'); // cargo el idioma espanniol
                        break;
                    }
                case "en": {

                        $this->config->load('en_lang');   // cargo el idioma ingles
                        break;
                    }
                case "por": {
                        $this->config->load("por_lang");
                        break;
                    }
                default: {

                        $this->config->load('es_lang'); // si me pasan otro que no sean los predefinidos, escojo espanniol por defecto
                    }
            }
        } else {

            $this->config->load('es_lang'); // si no hay ninguno seteado, tomo espanniol por defecto
        }
    }





    public function array_from_post($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function validate_rol($roles)
    {
        if (!in_array($this->session->userdata('role_id'), $roles)) {
            $this->log_out();
            $this->response->set_message(translate('not_access'), ResponseMessage::ERROR);
            redirect("Login/index");
        }
    }
}
