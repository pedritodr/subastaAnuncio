<?php

class Cate_anuncio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_cate_anuncio = $this->cate_anuncio->get_all();
        $data['all_cate_anuncio'] = $all_cate_anuncio;
        $this->load_view_admin_g("cate_anuncio/index", $data);
    }



    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('cate_anuncio/add');
    }


    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $nombre = $this->input->post('nombre');

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("cate_anuncio/add_index", "location", 301);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $banners = $_FILES['banner']['name'];
            $separado = explode('.', $name_file);
            $separado2 = explode('.', $banners);
            $ext = end($separado); // me quedo con la extension
            $ext2 = end($separado2); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            $allow_extension2 = in_array($ext2, $allow_extension_array);

            if ($allow_extension || $_FILES['archivo']['error'] == 4) {
                if ($allow_extension2 || $_FILES['banner']['error'] == 4) {
                    if ($_FILES['archivo']['error'] == 4 && $_FILES['banner']['error'] == 4) {
                        $data = ['nombre' => $nombre, 'is_active' => 1];
                        $this->cate_anuncio->create($data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("cate_anuncio/index");
                    } else {
                        if ($_FILES['archivo']['error'] == 0 && $_FILES['banner']['error'] == 0) {
                            $result = save_image_from_post('archivo', './uploads/cate_anuncio', time(), 128, 128);
                            $result2 = save_image_from_post('banner', './uploads/cate_anuncio/banner', time(), 1620, 218);
                            if ($result[0] && $result2[0]) {
                                $data = ['nombre' => $nombre, 'photo' =>  $result[1], 'banner' =>  $result2[1], 'is_active' => 1];
                                $this->cate_anuncio->create($data);
                                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                redirect("cate_anuncio/index");
                            } else {
                                $this->response->set_message($result[1] . $result[2], ResponseMessage::ERROR);
                                redirect("cate_anuncio/add_index", "location", 301);
                            }
                        } else {
                            if ($_FILES['archivo']['error'] == 0 && $_FILES['banner']['error'] == 4) {
                                $result = save_image_from_post('archivo', './uploads/cate_anuncio', time(), 128, 128);
                                if ($result[0]) {
                                    $data = ['nombre' => $nombre, 'photo' => $result[1], 'is_active' => 1];
                                    $this->cate_anuncio->create($data);
                                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                    redirect("cate_anuncio/index");
                                } else {
                                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                                    redirect("cate_anuncio/add_index", "location", 301);
                                }
                            } else {
                                $result2 = save_image_from_post('banner', './uploads/cate_anuncio/banner', time(), 1620, 218);
                                if ($result2[0]) {
                                    $data = ['nombre' => $nombre, 'banner' => $result2[1], 'is_active' => 1];
                                    $this->cate_anuncio->create($data);
                                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                    redirect("cate_anuncio/index");
                                } else {
                                    $this->response->set_message($result2[1], ResponseMessage::ERROR);
                                    redirect("cate_anuncio/add_index", "location", 301);
                                }
                            }
                        }
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("cate_anuncio/add_index", "location", 301);
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("cate_anuncio/add_index", "location", 301);
            }
        }
    }


    function update_index($cate_anuncio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $cate_anuncio_object = $this->cate_anuncio->get_by_id($cate_anuncio_id);

        if ($cate_anuncio_object) {
            $data['cate_anuncio_object'] = $cate_anuncio_object;
            $this->load_view_admin_g('cate_anuncio/update', $data);
        } else {
            show_404();
        }
    }


    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $nombre = $this->input->post('nombre');
        $cate_anuncio_id = $this->input->post('cate_anuncio_id');
        $cate_anuncio_object = $this->cate_anuncio->get_by_id($cate_anuncio_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        //$this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $banners = $_FILES['banner']['name'];
            $separado = explode('.', $name_file);
            $separado2 = explode('.', $banners);
            $ext = end($separado); // me quedo con la extension
            $ext2 = end($separado2); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            $allow_extension2 = in_array($ext2, $allow_extension_array);

            if ($allow_extension || $_FILES['archivo']['error'] == 4) {
                if ($allow_extension2 || $_FILES['banner']['error'] == 4) {
                    if ($_FILES['archivo']['error'] == 4 && $_FILES['banner']['error'] == 4) {
                        $data = ['nombre' => $nombre];
                        $this->cate_anuncio->update($cate_anuncio_id, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("cate_anuncio/index");
                    } else {
                        if ($_FILES['archivo']['error'] == 0 && $_FILES['banner']['error'] == 0) {
                            $result = save_image_from_post('archivo', './uploads/cate_anuncio', time(), 128, 128);
                            $result2 = save_image_from_post('banner', './uploads/cate_anuncio/banner', time(), 1620, 218);
                            if ($result[0] && $result2[0]) {
                                if (file_exists($cate_anuncio_object->photo))
                                    unlink($cate_anuncio_object->photo);

                                if (file_exists($cate_anuncio_object->banner))
                                    unlink($cate_anuncio_object->banner);

                                $data = ['nombre' => $nombre, 'photo' =>  $result[1], 'banner' =>  $result2[1]];
                                $this->cate_anuncio->update($cate_anuncio_id, $data);
                                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                redirect("cate_anuncio/index");
                            } else {
                                $this->response->set_message($result[1] . $result[2], ResponseMessage::ERROR);
                                redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
                            }
                        } else {
                            if ($_FILES['archivo']['error'] == 0 && $_FILES['banner']['error'] == 4) {
                                $result = save_image_from_post('archivo', './uploads/cate_anuncio', time(), 128, 128);
                                if ($result[0]) {
                                    if (file_exists($cate_anuncio_object->photo))
                                        unlink($cate_anuncio_object->photo);

                                    $data = ['nombre' => $nombre, 'photo' => $result[1]];
                                    $this->cate_anuncio->update($cate_anuncio_id, $data);
                                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                    redirect("cate_anuncio/index");
                                } else {
                                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                                    redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
                                }
                            } else {
                                $result2 = save_image_from_post('banner', './uploads/cate_anuncio/banner', time(), 1620, 218);
                                if ($result2[0]) {
                                    if (file_exists($cate_anuncio_object->banner))
                                        unlink($cate_anuncio_object->banner);

                                    $data = ['nombre' => $nombre, 'banner' => $result2[1]];
                                    $this->cate_anuncio->update($cate_anuncio_id, $data);
                                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                                    redirect("cate_anuncio/index");
                                } else {
                                    $this->response->set_message($result2[1], ResponseMessage::ERROR);
                                    redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
                                }
                            }
                        }
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("cate_anuncio/update_index/" . $cate_anuncio_id);
            }
        }
    }



    public function delete($cate_anuncio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $cate_anuncio_object = $this->cate_anuncio->get_by_id($cate_anuncio_id);

        if ($cate_anuncio_object) { //eliminado foto
            unlink($cate_anuncio_object->photo);

            $this->cate_anuncio->delete($cate_anuncio_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("cate_anuncio/index");
        } else {
            show_404();
        }
    }



    function index_subcate($cate_anuncio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_subcate = $this->cate_anuncio->get_by_Cate_anuncio_id($cate_anuncio_id);

        $data['all_subcate'] = $all_subcate;
        $data['cate_anuncio_id'] = $cate_anuncio_id;

        $this->load_view_admin_g('cate_anuncio/index_subcate', $data);
    }



    //crea el registro de las subcategorias
    public function add_subcate()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        //FK
        $nombre = $this->input->post('nombre');
        $cate_anuncio_id = $this->input->post('cate_anuncio_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('fullname_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("cate_anuncio/index_subcate");
        } else { //en caso de que todo este bien
            $data_subcate = [
                'nombre' => $nombre,
                'cate_anuncio_id' => $cate_anuncio_id,
            ];
            $this->cate_anuncio->create_sub_cate($data_subcate);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("cate_anuncio/index_subcate/" . $cate_anuncio_id);
        }
    }


    function update_subacate_index($subcate_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($subcate_id);
        if ($subcate_object) {
            $data['subcate_object'] = $subcate_object;
            $this->load_view_admin_g('cate_anuncio/subcate_update', $data);
        } else {
            show_404();
        }
    }
    public function update_subcate()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subcate_id = $this->input->post('subcate_id');
        $nombre = $this->input->post('nombre');
        $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($subcate_id);
        if ($subcate_object) {
            $data = ['nombre' => $nombre];
            $this->cate_anuncio->update_subcate($subcate_id, $data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("cate_anuncio/index_subcate/" . $subcate_object->cate_anuncio_id);
        } else {
            show_404();
        }
    }



    public function delete_subcate($subcate_id = 0) //elimina las subcategorias
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($subcate_id);

        if ($subcate_object) {
            $this->cate_anuncio->delete_subcate($subcate_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("cate_anuncio/index_subcate/" . $subcate_object->cate_anuncio_id, "location", 301);
        } else {
            show_404();
        }
    }

    public function change($categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $object = $this->cate_anuncio->get_by_id($categoria_id);

        if ($object) {
            if ($object->is_front == 1)
                $this->cate_anuncio->update($categoria_id, ['is_front' => 0]);
            if ($object->is_front == 0)
                $this->cate_anuncio->update($categoria_id, ['is_front' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("cate_anuncio/index");
        } else {
            show_404();
        }
    }
}
