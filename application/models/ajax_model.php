<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	 	$this->output->set_content_type('application/json');
		$this->load->model('catalog_model');
    }


	/*
	*	Добавление товара в корзину
	*/
	function add_basket($id,$amount){

		$product_info = $this->catalog_model->get_product_info_by_id($id);

		if (!$product_info) {
			$this->output->set_output(json_encode(false));
			return false;
		}

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
		return true;

	}

	/*
	*	Обновление данных в корзине
	*	@param int $id - id товара
	*	@param int $amount - новое количество товара
	*/
	function update_basket($id,$amount){
		$product_info = $this->catalog_model->get_product_info_by_id($id);

		if (!$product_info) {
			$this->output->set_output(json_encode(false));
		}

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
		return true;

	}

	/*
	*	Удаление данных из корзины
	*	@param int $id - id товара
	*/
	function delete_basket($id){

		//Проверяем существует ли товар вообще
		$product_info = $this->catalog_model->get_product_info_by_id($id);

		if (!$product_info) {
			$this->output->set_output(json_encode(false));
			return false;
		}

		$basket = $this->session->userdata('basket');

		// Если есть корзина и в ней есть выбранный товар, то присваиваем ему
		// новое количество
		if ($basket && isset($basket[$id])) {
			unset($basket[$id]);
		}else{
			$this->output->set_output(json_encode(false));
			return false;
		}

		//Записываем новую, обновленную корзину
		$this->session->set_userdata(array("basket" => $basket));
		$this->output->set_output(json_encode("Данные удалены"));
		return true;

	}


}
