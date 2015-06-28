<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->output->set_content_type('application/json');
        $this->load->model('catalog_model');
    }

    /*
    *   Добавление товара в корзину
    *   @param int $id
    *   @param int $amount
    */
    function add_basket($id,$amount){
        $id = intval($id);
        $amount = intval($amount);

        $product_info = $this->catalog_model->get_product_info_by_id($id);

        if (isset($product_info["error"])){
            $this->output->set_output(json_encode(false));
        }

        $product_info = $product_info["data"];

        $basket = $this->session->userdata('basket');

        // Если есть корзина и в ней есть выбранный товар, то добавляем к нему
        // новое количество
        if ($basket && isset($basket[$id])) {
            $basket[$id]["amount"]+= $amount;
        }else{
            // Формируем массив необходимой информации о товаре
            $basket[$id]["name"] = $product_info["product_name"];
            $basket[$id]["url"] = $product_info["product_url"];
            $basket[$id]["img"] = $product_info["product_img"];
            $basket[$id]["amount"] = $amount;
            $basket[$id]["price"] = $product_info["product_price"];
        }

        //Записываем новую, обновленную корзину
        $this->session->set_userdata(array("basket" => $basket));
        $this->output->set_output(json_encode("Данные добавлены"));

    }

    /*
    *	Обновление данных в корзине
    *	@param int $id - id товара
    *	@param int $amount - новое количество товара
    */
    function update_basket($id,$amount){
        $id = intval($id);
        $amount = intval($amount);

        $product_info = $this->catalog_model->get_product_info_by_id($id);

        if(isset($product_info["error"])){
            $this->output->set_output(json_encode(false));
        }

        $product_info = $product_info["data"];

        $basket = $this->session->userdata('basket');

        // Если есть корзина и в ней есть выбранный товар, то присваиваем ему
        // новое количество
        if ($basket && isset($basket[$id])) {
            $basket[$id]["amount"] = $amount;
        }else{
            $this->output->set_output(json_encode(false));
        }

        //Записываем новую, обновленную корзину
        $this->session->set_userdata(array("basket" => $basket));
        $this->output->set_output(json_encode("Данные обновлены"));

    }

    /*
    *	Удаление данных из корзины
    *	@param int $id - id товара
    */
    function delete_basket($id){
        $id = intval($id);

        //Проверка существования товара
        $product_info = $this->catalog_model->get_product_info_by_id($id);

        if(isset($product_info["error"])){
            $this->output->set_output(json_encode(false));
        }

        $product_info = $product_info["data"];

        $basket = $this->session->userdata('basket');

        /* Если есть корзина и в ней есть выбранный товар, то присваиваем ему
        новое количество*/
        if ($basket && isset($basket[$id])) {
            unset($basket[$id]);
        }else{
            $this->output->set_output(json_encode(false));
            return false;
        }

        //Записываем новую, обновленную корзину
        $this->session->set_userdata(array("basket" => $basket));
        $this->output->set_output(json_encode("Данные удалены"));

    }

    /*
    *   Получение товаров в каталоге
    *   @param int $num
    *   @param int $offset
    *   @param int $category_id
    *   @param string $order - способ сортировки
    *   @param array $filter - массив фильтров
    */
    function catalog_show_more($num,$offset,$category_id,$order,$filter){
        $num = intval($num);
        $offset = intval($offset);

        $products = $this->catalog_model->get_products_by_category($num,$offset,$category_id,$order,$filter);

        if(isset($products["error"])){
            $this->output->set_output(json_encode(false));
        }
        $products = $products["data"];

        $total_rows = $this->catalog_model->get_products_count_by_category($category_id,$filter);
        if(isset($total_rows["error"])){
            $this->output->set_output(json_encode(false));
        }
        $total_rows = $total_rows["data"];

        $this->output->set_output(json_encode(array("products" => $products, "total_rows" => $total_rows)));
        return true;
    }

    /*
    *   Получение комментариев
    *   @param $num
    *   @param $offset
    */
    function reviews_show_more($num,$offset) {
        $num = intval($num);
        $offset = intval($offset);
        
        $this->load->model('reviews_model');
        $reviews = $this->reviews_model->get_reviews($num,$offset);
        if(isset($reviews["error"])){
            $this->output->set_output(json_encode(false));
        }
        $reviews = $reviews["data"];

        $reviews_count = $this->reviews_model->get_reviews_count();

        $this->output->set_output(json_encode(array("reviews" => $reviews, "reviews_count" => $reviews_count)));
    }


}
