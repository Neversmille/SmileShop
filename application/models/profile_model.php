<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_orders_history($client_id) {

        //Получение массива информации о заказах с client_id указнного клиента
        $orders = $this->db->where('order_client_id',$client_id)
                        ->order_by('order_id','desc')
                        ->get('orders')
                        ->result_array();

        if (empty($orders)) {
            return array();
        }else{
            return $orders;
        }

    }

    public function get_orders_detail($orders) {
        if (empty($orders)){
            return array();
        }
        //Формирование массива из order_id
        foreach ($orders as $value) {
            $orders_id[] = $value["order_id"];
        }

        // Получение массива информации всех товаров из списка заказов
        $orderItems = $this->db->join('products', 'orderItem_product_id = product_id', 'left')
                                           ->where_in('orderItem_order_id',$orders_id)
                                            ->get('orderItems')
                                            ->result_array();

        // $orderItems = $this->db->where_in('orderItem_order_id',$orders_id)
        //                                  ->get('orderItems')
        //                                 ->result_array();

        if (empty($orderItems)) {
            return array();
        }

        //Формирование массива ["order_id" => array(orderItems1,orderItems2,....)]
        foreach ($orderItems as $value) {
            $order_id = $value["orderItem_order_id"];

            if (!isset($all_info[$order_id])){
                $all_info[$order_id] = array();
            }
            $all_info[$order_id][] = $value;
        }

        if(empty($all_info)) {
            return array();
        }else{
            return  $all_info;
        }
    }

}
