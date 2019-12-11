<?php

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model', 'product');
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
            redirect('login/index');
        }

        $all_productos = $this->product->get_all_products();
        $data['all_productos'] = $all_productos;
        $this->load_view_admin_g("product/index", $data);
    }


    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Coleccion_model', 'coleccion');
        $this->load->model('Categoria_model', 'categoria');

        $all_colecciones = $this->coleccion->get_all();
        $data['all_colecciones'] = $all_colecciones;
        $all_categorias = $this->categoria->get_all();
        $data['all_categorias'] = $all_categorias;
        $this->load_view_admin_g('product/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $price = $this->input->post('price');
        $categoria = $this->input->post('categoria');
        $coleccion = $this->input->post('colecciones');
        $descuento = $this->input->post('descuento');
        $stock = $this->input->post('stock');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('descripcion_lang'), 'required');
        $this->form_validation->set_rules('categoria', translate('categorie_lang'), 'required');
        $this->form_validation->set_rules('colecciones', translate('colecciones_lang'), 'required');
        $this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');
        $this->form_validation->set_rules('stock', translate('stock_lang'), 'required|numeric');
        $this->form_validation->set_rules('descuento', translate('descuento_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/add_index", "location", 301);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/product', time(), 768, 768);
                if ($result[0]) {
                    $data = ['name' => $name, 'description' => $desc, 'main_photo' => $result[1], 'price' => $price, 'coleccion_id' => $coleccion, 'categoria_id' => $categoria, 'descuento' => $descuento, 'stock' => $stock];
                    $this->product->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/index");
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("product/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("product/add_index", "location", 301);
            }
        }
    }


    function update_index($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Coleccion_model', 'coleccion');
        $this->load->model('Categoria_model', 'categoria');

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {
            $all_colecciones = $this->coleccion->get_all();
            $data['all_colecciones'] = $all_colecciones;
            $all_categorias = $this->categoria->get_all();
            $data['all_categorias'] = $all_categorias;
            $data['producto_object'] = $producto_object;
            $this->load_view_admin_g('product/update', $data);
        } else {
            show_404();
        }
    }

    function update_foto_coleccion_index($foto_producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_object = $this->product->get_by_foto_producto_id($foto_producto_id);

        if ($foto_producto_object) {
            $data['foto_producto_object'] = $foto_producto_object;
            $this->load_view_admin_g('product/foto_producto_update', $data);
        } else {
            show_404();
        }
    }

    function foto_coleccion($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_fotos = $this->product->get_by_producto_id($producto_id);


        $data['all_fotos'] = $all_fotos;
        $data['producto_id'] = $producto_id;

        $this->load_view_admin_g('product/foto_producto', $data);
    }
    function foto_coleccion_add($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $data['producto_id'] = $producto_id;

        $this->load_view_admin_g('product/add_foto', $data);
    }


    function relacionado($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        // $this->load->model('Product_model', 'product');
        $object_producto = $this->product->get_by_id($producto_id);
        if ($object_producto) {
            $all_products = $this->product->get_all_relacionado_by_producto($producto_id);

            $result_products  = $this->product->get_all_products_by_product_id_simple($producto_id);

            $lista_products = $this->product->get_by_productos_id($producto_id);

            $data['lista_products'] = $lista_products;
            $data['result_products'] = $result_products;
            $data['all_products'] = $all_products;

            $data['producto_id'] = $producto_id;
            $this->load_view_admin_g('product/relacionado', $data);
        } else {
            show_404();
        }
    }

    function add_relacionado()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_id  = $this->input->post('producto_id');
        $productos  = $this->input->post('productos');
        $object_producto = $this->product->get_by_id($producto_id);
        if ($object_producto) {
            //establecer reglas de validacion

            $this->form_validation->set_rules('productos', translate('products_lang'), 'required');

            if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
                $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
                redirect("product/relacionado/" . $producto_id, "location", 301);
            } else {

                $this->product->create_relacionado_products_array($producto_id, $productos);

                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product/relacionado/" . $producto_id, "location", 301);
            }
        } else {
            show_404();
        }
    }

    public function add_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_id = $this->input->post('producto_id');
        //en caso de que todo este bien
        $name_file = $_FILES['archivo']['name'];

        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/coleccion', time(), 768, 768);
            if ($result[0]) {
                $data = ['photo' => $result[1], 'producto_id' => $producto_id];
                $this->product->create_foto_producto($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product/index");
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("product/add_index", "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("product/add_index", "location", 301);
        }
    }
    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $price = $this->input->post('price');
        $producto_id = $this->input->post('producto_id');
        $categoria = $this->input->post('categoria');
        $coleccion = $this->input->post('colecciones');
        $stock = $this->input->post('stock');
        $descuento = $this->input->post('descuento');
        $producto_object = $this->product->get_by_id($producto_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('descripcion_lang'), 'required');
        $this->form_validation->set_rules('categoria', translate('categorie_lang'), 'required');
        $this->form_validation->set_rules('colecciones', translate('colecciones_lang'), 'required');
        $this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');
        $this->form_validation->set_rules('stock', translate('stock_lang'), 'required|numeric');
        $this->form_validation->set_rules('descuento', translate('descuento_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/update_index/" . $producto_id);
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['name' => $name, 'description' => $desc, 'price' => $price, 'coleccion_id' => $coleccion, 'categoria_id' => $categoria, 'stock' => $stock, 'descuento' => $descuento];
                    $this->product->update($producto_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/index");
                } else {

                    if ($producto_object) {

                        $result = save_image_from_post('archivo', './uploads/product', time(), 768, 768);
                        if ($result[0]) {
                            if (file_exists($producto_object->main_photo))
                                unlink($producto_object->main_photo);

                            $data = ['name' => $name, 'main_photo' => $result[1], 'description' => $desc, 'price' => $price, 'coleccion_id' => $coleccion, 'categoria_id' => $categoria, 'stock' => $stock, 'descuento' => $descuento];
                            $this->product->update($producto_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("product/index");
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("product/update_index/" . $producto_id);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("product/update_index/" . $producto_id);
            }
        }
    }
    public function update_foto_coleccion()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_id = $this->input->post('foto_producto_id');
        $foto_producto_object = $this->product->get_by_foto_producto_id($foto_producto_id);

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($foto_producto_object) {

                $result = save_image_from_post('archivo', './uploads/product', time(), 768, 768);
                if ($result[0]) {
                    if (file_exists($foto_producto_object->photo))
                        unlink($foto_producto_object->photo);

                    $data = ['photo' => $result[1]];
                    $this->product->update_foto_coleccion($foto_producto_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/foto_coleccion/" . $foto_producto_object->producto_id);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("product/update_foto_coleccion_index/" . $foto_producto_id);
                }
            } else {
                show_404();
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("product/update_foto_coleccion_index/" . $foto_producto_id);
        }
    }

    public function delete($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {
            unlink($producto_object->main_photo);
            unlink($producto_object->main_photo);
            $foto_producto_object = $this->product->get_by_producto_id($producto_id);

            if ($foto_producto_object) {
                foreach ($foto_producto_object as $item) {
                    unlink($item->photo);
                }
                $this->product->delete_foto_producto($producto_id);
            }

            $this->product->delete($producto_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }

    public function delete_foto($foto_producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_object = $this->product->get_by_foto_producto_id($foto_producto_id);

        if ($foto_producto_object) {
            unlink($foto_producto_object->photo);
            $this->product->delete_foto_producto($foto_producto_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/foto_coleccion/" . $foto_producto_object->producto_id, "location", 301);
        } else {
            show_404();
        }
    }
    public function delete_relacionado($relacionado_producto_id = 0, $producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_object = $this->product->get_relacionado_by_id($relacionado_producto_id);

        if ($producto_object) {
            $this->product->delete_relacionado($relacionado_producto_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/relacionado/" . $producto_id, "location", 301);
        } else {
            show_404();
        }
    }
    public function change($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {
            if ($producto_object->is_active == 1)
                $this->product->update($producto_id, ['is_active' => 0]);
            if ($producto_object->is_active == 0)
                $this->product->update($producto_id, ['is_active' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }
}
