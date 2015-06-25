<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slider_admin_model extends CI_Model {

	/*
	*	Получение всех слайдов
	*/
	public function get_slides(){
		$slides = $this->db->order_by('slider_is_active','desc')
								->order_by('slider_position','asc')
								->get('slider')
								->result_array();
		if(empty($slides)){
			return array("error" => "не слайдов");
		}else{
			return array("data" => $slides);
		}
	}

	public function get_slide_info($id){
		$id = intval($id);
		$slide_info = $this->db->where('slider_id',$id)
									->get('slider')
									->result_array();
		if(empty($slide_info)){
			return array("error" => "не слайдов");
		}else{
			return array("data" => $slide_info[0]);
		}
	}

	/*
	*	Получени информации о товаре по id
	*	@param int $id
	*/
	public function get_product_info($id){
		$id = intval($id);
		$product_info = $this->db->where('product_id',$id)
										->get('products')
										->result_array();
		if (empty($product_info)){
			return array("error" => "нет такого товара");
		}else{
			return array("data" => $product_info[0]);
		}

	}

	/*
	*	Добавление нового слайда
	*	@param array $insert
	*/
	public function add_slide($insert){
		if(!is_array($insert)){
			return array("error" => "неверный тип аргументов");
		}
		$add_slide = $this->db->insert("slider",$insert);
		if ($add_slide){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления слайда");
		}
	}

	public function edit_slide($id,$insert){
		$id = intval($id);
		if(!is_array($insert)){
			return array("error" => "неверный тип аргументов");
		}
		$edit_slide = $this->db->where("slider_id",$id)
									->update("slider",$insert);
		if ($edit_slide){
			return array("data" => true);
		}else{
			return array("error" => "ошибка добавления слайда");
		}
	}

}
