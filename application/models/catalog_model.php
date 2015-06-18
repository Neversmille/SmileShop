<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalog_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /*
    *   Получение информации о  категории по alias
    *   @param string $category_alias
    *   @return array
    */
    function get_category_info($category_alias){
        $category_info = $this->db->select('category_id,category_name')
                                            ->where('category_alias',$category_alias)
                                            ->get('categories')
                                            ->result_array();
                                            // var_dump($category_info);die();
        if(!empty($category_info[0])){
            return $category_info[0];
        }else{
            return array();
        }

    }

    /*
    *   Получение информации о  категории по id
    *   @param string $category_id
    *   @return array
    */
    function get_category_info_by_id($category_id){
        $category_info = $this->db->where('category_id',$category_id)
                                            ->get('categories')
                                            ->result_array();
                                            // var_dump($category_info);die();
        if(!empty($category_info[0])){
            return $category_info[0];
        }else{
            return array();
        }

    }


    /*
    *   Получение списка товаров по категории
    *   @param int $num - количество товаров отображаемого на странице
    *   @param $offset - позиция указателя страница в url
    *   @param int $category_id
    *   @param string $order - способ сортировки
    *   @param array $filter - массив фильтров
    *   @return array $products - список товаров
    */
    function get_products_by_category($num,$offset,$category_id,$order,$filter){
        // var_dump($num);
        // var_dump($offset);
        // var_dump($category_id);
        // var_dump($order);
        // var_dump($filter);die();
        if($order == "new") {
            $order = "product_id";
            $type = "desc";
        }elseif($order == "pricemax") {
            $order = "product_price";
            $type = "desc";
        }elseif($order == "pricemin") {
            $order = "product_price";
            $type = "asc";
        }elseif($order == "name") {
            $order = "product_name";
            $type = "asc";
        }else{
            return array();
        }

        if(empty($filter)){
            $products = $this->db->where('product_category_id',$category_id)
                                            ->order_by($order, $type)
                                            ->get('products',$num,$offset)
                                            ->result_array();
        }else{
            $products = $this->db->where('product_category_id',$category_id)
                                            ->where($filter)
                                            ->order_by($order, $type)
                                            ->get('products',$num,$offset)
                                            ->result_array();
        }

        if(!empty($products)){
            return $products;
        }else{
            return array();
        }

    }

        /*
    *	Получение информации о товаре по id
    *	@param int id $product_id
    *	@return array - информация о категории
    *	@return array array() - если нет товара с таким idl
    */
    public function get_product_info_by_id($product_id){
        $product_info = $this->db->where('product_id',$product_id)
                                        ->get('products')
                                        ->result_array();
        if (empty($product_info)){
            return array();
        }else{
            return $product_info[0];
        }
    }

    /*
    *	Получение количества товаров по id категории
    *	@param int $category_id
    *	@return	int количество товаров данной категории в БД
    */
    function get_products_count_by_category($category_id,$filter) {

        if (empty($filter)){
            return $this->db->where('product_category_id',$category_id)
                                            ->count_all_results('products');
        }else{
            return $this->db->where('product_category_id',$category_id)
                                            ->where($filter)
                                            ->count_all_results('products');
        }



    }

    /*
	*	Разбор get параметров в ассоциативный массив
	*	@param $array - входящий массив get параметров
	*						 url адресса вида order=pricemax/page=3
	*	@return array $result - ассоциативный массив
	*								["page" => 3, "order" => "pricemax"]
     *     @return array () - при неправильном формате get параметров
	*/
	function get_params($array) {
		$result = array();
		$result["order"] = "new";
		$result["page"] = null;
         $result["filter"] = array();
		if (empty($array)) {
			return $result;
		}else{
			foreach ($array as $item) {
				$parametr = preg_split("/=/",$item);

                  //Разбиваем параметры по =, если передано чтото не через =
                  //возвращаем пустой массив
				if (count($parametr)==2){
					$parametr_key = $parametr[0];
					$parametr_value = $parametr[1];
                        /*Отфильтровуем переданные параметры*/
                        if ($parametr_key =="order" || $parametr_key == "page"){
                            $result[$parametr_key] = $parametr_value;
                        }else{
                            if ($parametr_key=="firm") {
                                $parametr_key = "product_firm";
                            }else{
                                return array();
                            }
                            $result["filter"][$parametr_key] = $parametr_value;
                        }

				}else{
                    return array();
                }
			}
		}
		return $result;
	}

    /*
    *   Получения списка фирм по id категории
    *   @param int $category_id
    *   @return array - список фирм
    */
    public function get_category_firm_list($category_id) {
        return $this->db->select('product_firm')
                        ->where('product_category_id',$category_id)
                        ->group_by('product_firm')
                        ->get('products')
                        ->result_array();
    }

    /*
    *	Формирование массива опций для класса Pagination
    *	@param object $uri - обьект класса Uri для текущей страницы
    *	@param int $per_page - количество товара на странице
    *	@param int $total_rows - количество товаров данной категории
    *	@param int $page - номер текущей страницы
    *    @return array $config - массив опций для инициализации класса Pagination
    */
    public function set_pagination($uri,$per_page,$total_rows,$page) {

        //Количество сегментов в текущем url
        $uri_segment = count($uri->segments);

        //Формируем url текущей страницы без сегмента с номером страницы
        $search = preg_split("/(page=\d+$)+/",$uri->uri_string);
        $url = $search[0];

        //Массив опций для конфигурации класса Pagination
        $config['base_url'] = base_url().$url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['next_link'] = '&gt;';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $config['first_link'] = 'Вначало';
        $config['last_link'] = 'Последняя';
        $config['cur_page'] = $page;
        $config['uri_segment'] = $uri_segment;
        $config['prefix'] = 'page=';
        return $config;

    }

    /*
    *   Формирование url для сортировки (обрезаем данные пагинатора)
    *   @param string $current_url - текущий url
    *   @return string - текущий url без данных пагинатора
    */
    public function get_url_for_order($current_url){
        $array = preg_split("/(\/page=\w+$)/",$current_url);
        return(base_url().$array[0]."/");
    }

    /*
    *   Получеения случайны горячих предложений
    *   @param string $num - количество получаемых данных
    *   @return array - массив товаров
    */
    public function get_random_hot_products($num){
        return $this->db->where('product_hot','1')
                        ->order_by('product_id','random')
                        ->limit($num)
                        ->get('products')
                        ->result_array();
    }

    /*
    *   Получение цены товара по id
    *   @param int $id - id товара
    *   @return $price
    *   @return boolean false - в случае отсутствия товара
    */
    public function get_product_price_by_id($id){
            $price = $this->db->select('product_price')
                                        ->where('product_id',$id)
                                        ->get('products')
                                        ->result_array();
            if (empty($price)){
                return false;
            }else{
                return $price[0]["product_price"];
            }

    }

}
