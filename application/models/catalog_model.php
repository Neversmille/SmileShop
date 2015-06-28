<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalog_model extends CI_Model {

    /*
    *   Получение информации о  категории по alias
    *   @param string $category_alias
    */
    function get_category_info($category_alias){
        if(!is_string($category_alias)){
            return array("error" => "аргумент должен быть массивом");
        }

        $category_info = $this->db->select('category_id,category_name')
                                            ->where('category_alias',$category_alias)
                                            ->get('categories')
                                            ->result_array();

        if(empty($category_info[0])){
            return array("error" => "категории не существует");
        }else{
            return array("data" => $category_info[0]);
        }
    }

    /*
    *   Получение информации о  категории по id
    *   @param string $category_id
    */
    function get_category_info_by_id($category_id){
        $category_id = intval($category_id);

        $category_info = $this->db->where('category_id',$category_id)
                                            ->get('categories')
                                            ->result_array();

        if(empty($category_info[0])){
            return array("error" => "категории не существует");
        }else{
            return array("data" => $category_info[0]);
        }

    }


    /*
    *   Получение  товаров по категории
    *   @param int $num
    *   @param int $offset
    *   @param int $category_id
    *   @param string $order - способ сортировки
    *   @param array $filter - массив фильтров
    */
    function get_products_by_category($num,$offset,$category_id,$order,$filter){
        $num = intval($num);
        $offset = intval($offset);
        $category_id = intval($category_id);
        if(!is_string($order) || !is_array($filter)){
            return array("error" => "неверный тип аргументов");
        }

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
            return array("error" => "неверный тип сортировки");
        }

        //Получение товаров по категории без фильтра либо с фильтром
        if(empty($filter)){
            $products = $this->db->join('firms', 'product_firm = firm_id', 'left')
                                            ->where('product_category_id',$category_id)
                                            ->order_by($order, $type)
                                            ->get('products',$num,$offset)
                                            ->result_array();
        }else{
            $products = $this->db->join('firms', 'product_firm = firm_id', 'left')
                                            ->where('product_category_id',$category_id)
                                            ->where($filter)
                                            ->order_by($order, $type)
                                            ->get('products',$num,$offset)
                                            ->result_array();
        }

        if(empty($products)){
            return array("error" => "нет товаров данной категории");
        }else{
            return array("data" => $products);
        }
    }

    /*
    *	Получение информации о товаре по id
    *	@param int id $product_id
    */
    public function get_product_info_by_id($product_id){
        $product_id = intval($product_id);

        $product_info = $this->db->where('product_id',$product_id)
                                            ->get('products')
                                            ->result_array();

        if (empty($product_info)){
            return array("error" => "нет товара с таким id");
        }else{
            return array("data" => $product_info[0]);
        }
    }

    /*
    *   Получение количества товаров по id категории
    *   @param int $category_id
    *   @param array $filter - массив фильтров
    */
    function get_products_count_by_category($category_id,$filter) {
        $category_id = intval($category_id);
        if(!is_array($filter)){
            return array("error" => "неверный тип аргументов");
        }

        //Подсчет количества товаров данной категории без фильтра либо с фильтром
        if (empty($filter)){
            $count = $this->db->where('product_category_id',$category_id)
                                        ->count_all_results('products');
        }else{
            $count = $this->db->join('firms', 'product_firm = firm_id', 'left')
                                        ->where('product_category_id',$category_id)
                                        ->where($filter)
                                        ->count_all_results('products');
        }

        if ($count===0) {
            return array("error" => "нет товаров данной категории");
        }else{
            return array("data" => $count);
        }
    }

    /*
    *	Разбор переданных параметров в ассоциативный массив
    *	@param $array - входящий массив  параметров
    *						 url адресса вида order=pricemax/product=3
    */
    function get_params($array) {
        //Значения по умолчанию
        $result["order"] = "new";
        $result["product"] = null;
        $result["filter"] = array();

        if (empty($array)) {
            return array("data" => $result);
        }else{
            foreach ($array as $item) {
                $parametr = preg_split("/=/",$item);

                //Разбиваем параметры по =
                if (count($parametr)==2){
                    $parametr_key = $parametr[0];
                    $parametr_value = $parametr[1];

                    /*Отфильтровуем переданные параметры*/
                    if ($parametr_key =="order" || $parametr_key == "product"){
                        $result[$parametr_key] = $parametr_value;
                    }else{

                        if ($parametr_key=="firm") {
                            $parametr_key = "firm_name";
                        }else{
                            return array("error" => "заданы недопустимые параметры");
                        }
                        $result["filter"][$parametr_key] = $parametr_value;

                    }

                }else{
                    return array("error" => "заданы недопустимые параметры");
                }
            }
        }

        return array("data" => $result);
    }

    /*
    *   Получения списка фирм по id категории
    *   @param int $category_id
    */
    public function get_category_firm_list($category_id) {
        $category_id = intval($category_id);

        $result = $this->db->select('product_firm, firm_name')
                                    ->join('firms', 'product_firm = firm_id', 'left')
                                    ->where('product_category_id',$category_id)
                                    ->group_by('product_firm')
                                    ->get('products')
                                    ->result_array();

        if(empty($result)){
            return array("error" => "у данной категории нет фирм");
        }else{
            return array("data" => $result);
        }
    }

    /*
    *	Формирование массива опций для пагинатора
    *	@param object $uri - обьект класса Uri для текущей страницы
    *	@param int $per_page - количество товара на странице
    *	@param int $total_rows - количество товаров данной категории
    *	@param int $product - номер текущей страницы
    */
    public function set_pagination($uri,$per_page,$total_rows,$product) {
        $per_page = intval($per_page);
        $product = intval($product);
        $total_rows = intval($total_rows);

        if(!is_object($uri)){
            return array("error" => "неверный тип аргументов");
        }

        //Количество сегментов в текущем url
        $uri_segment = count($uri->segments);

        //Формируем url текущей страницы без сегмента с номером страницы
        $search = preg_split("/(product=\d+$)+/",$uri->uri_string);
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
        $config['cur_page'] = $product;
        $config['uri_segment'] = $uri_segment;
        $config['prefix'] = 'product=';

        return array("data" => $config);
    }

    /*
    *   Формирование url для сортировки (обрезаем данные пагинатора)
    *   @param string $current_url - текущий url
    */
    public function get_url_for_order($current_url){
        if (!is_string($current_url)){
            return array("error" => "аргумент должен быть типа string");
        }

        $array = preg_split("/(\/product=\w+$)/",$current_url);
        return array("data" => base_url().$array[0]."/");
    }

    /*
    *   Получеения случайны горячих предложений
    *   @param int $num - количество получаемых данных
    */
    public function get_random_hot_products($num){
        $num = intval($num);

        $result = $this->db->where('product_hot','1')
                                    ->order_by('product_id','random')
                                    ->limit($num)
                                    ->get('products')
                                    ->result_array();

        if(empty($result)) {
            return array("error" => "нет горячих товаров");
        }else{
            return array("data" => $result);
        }
    }

    /*
    *   Получение цены товара по id
    *   @param int $id - id товара
    */
    public function get_product_price_by_id($id){
        $id = intval($id);

        $price = $this->db->select('product_price')
                                ->where('product_id',$id)
                                ->get('products')
                                ->result_array();

        if (empty($price)){
            return array("error" => "нет товара с таким id");
        }else{
            return array("data" => $price[0]["product_price"]);
        }
    }

    /*
    *   Получение названия фирмы по id
    *   @param int $firm_id
    */
    public function get_firm_name($firm_id){
        $firm_id = intval($firm_id);

        $firm_name = $this->db->where('firm_id',$firm_id)
                                        ->get('firms')
                                        ->result_array();

        if(empty($firm_name)){
            return array("error" => "нет фирмы с таким id");
        }else{
            return array("data" => $firm_name[0]);
        }
    }

    /*
    *   Получение id фирмы по названию
    *   @param string $firm_name
    */
    public function get_firm_id($firm_name){
        if(!is_string($firm_name)) {
            return array("error" => "аргумент должен быть типа string");
        }

        $firm_id = $this->db->where('firm_name',$firm_name)
                                    ->get('firms')
                                    ->result_array();

        if(empty($firm_id)){
            return array("error" => "нет фирмы с таким id");
        }else{
            return array("data" => $firm_id[0]);
        }
    }

    /*
    *   Получение слайдов слайдера на главной страницы
    */
    public function get_main_slides(){
        $slides = $this->db->join('products', 'product_id = slider_product_id', 'left')
                                ->where('slider_is_active',1)
                                ->order_by('slider_is_active','desc')
                                ->order_by('slider_position','asc')
                                ->get('slider')
                                ->result_array();

        if (empty($slides)){
            return array("error" => "нет слайдов");
        }else{
            return array("data" => $slides);
        }
    }

    /*
    *   Поиск товара в БД
    *   @param string $search
    *   @param int $per_page
    *   @param int $offset
    */
    public function search($search,$per_page,$offset) {
        $per_page = intval($per_page);
        $offset = intval($offset);
        if(!is_string($search)){
            return array("error" => "неверный тип аргумента");
        }

        $products = $this->db->join('firms', 'product_firm = firm_id', 'left')
                                    ->like('product_name',$search)
                                    ->get('products',$per_page,$offset)
                                    ->result_array();

        return array("data" => $products);
    }

    /*
    *   Подсчет количества результатов по запросу
    */
    function get_search_count($search){
        if(!is_string($search)){
            return array("error" => "неверный тип аргумента");
        }

        $count = $this->db->like('product_name',$search)
                                    ->count_all_results('products');

        return array("data" => $count);
    }

    /*
    *   Формирование массива опций для пагинатора страницы поиска
    *   @param int $per_page
    *   @param int $page
    *   @param int $totalrows
    *   @param string $search
    */
    function set_search_pagination($per_page,$page,$totalrows,$search){
        $per_page = intval($per_page);
        $page = intval($page);
        $this->load->library('pagination');
        $config['base_url'] = base_url()."search/".$search;
        $config['per_page'] =$per_page;
        $config['cur_page'] = $page;
        $config['next_link'] = '&gt;';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $config['first_link'] = 'Вначало';
        $config['last_link'] = 'Последняя';
        $config['uri_segment'] =3;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] =$totalrows;
        $this->pagination->initialize($config);
    }

}
