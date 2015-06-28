<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders_admin_model extends CI_Model {

	/*
	*	Получение количества фирм
	*/
	public function get_orders_count(){
		$count = $this->db->count_all_results('orders');
		return $count;
	}

	/*
	*	Получение списка фирм
	*	@param int $num - количество фирм на странице
	*	@param int $offset - смещение
	*/
	public function get_orders($num,$offset){
		$num = intval($num);
		$offset = intval($offset);

		$orders = $this->db->order_by('order_create_date','desc')
										->get('orders',$num,$offset)
										->result_array();

		if(empty($orders)){
			return array("error" => "нет заказов");
		}else{
			return array("data" => $orders);
		}
	}

	/*
	*	Получение данных о фирме по имени
	*	@param string $name
	*/
	public function get_order_info_by_id($id){
		$id = intval($id);

		$order_info = $this->db->select('client_name,order_price,order_phone,order_text,order_create_date,order_id,order_complete,client_lastname')
									->join('clients', 'order_client_id = client_id', 'left')
									->where('order_id',$id)
									->get('orders')
									->result_array();

		if(empty($order_info)) {
			return array("error" => "нет такого заказа");
		}else{
			return array("data" => $order_info[0]);
		}
	}

	public function get_order_products($id){
		$id = intval($id);
		$order_products = $this->db->select('orderItem_product_id,product_name,product_url,product_img,orderItem_amount,orderItem_price, product_avaible')
											->join('products', 'orderItem_product_id = product_id', 'left')
											->where("orderItem_order_id",$id)
											->get("orderItems")
											->result_array();
		if(empty($order_products)) {
			return array("error" => "нет товаров закрепленных за этим заказом");
		}else{
			return array("data" => $order_products);
		}
	}

	public function update_order($id,$status){
		$id = intval($id);
		$status = intval($status);
		$update = $this->db->where("order_id",$id)
								->set("order_complete",$status)
								->update("orders");
		if($update){
			return array("data" => true);
		}else{
			return array("error" => false);
		}
	}


	/*
	*    Формирование и инициализация массива опций пагинатора
	*    @param int $per_page - колчество комментариев на странице
	*    @param int $page - текущий номер страницы
	*/
	function set_pagination($per_page,$page){
		$per_page = intval($per_page);
		$page = intval($page);
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admin/orders';
		$config['per_page'] =$per_page;
		$config['cur_page'] = $page;
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'Вначало';
		$config['last_link'] = 'Последняя';
		$config['next_link'] = '&gt;';
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->get_orders_count();
		$this->pagination->initialize($config);
	}

}
