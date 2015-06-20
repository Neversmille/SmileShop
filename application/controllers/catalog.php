<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends MY_Controller{

	/*
	*	Переопределяем поведение вызываемого метода
	*	@param string $method - вызываемый метод
	*	@param array $args - массив входящих параметров
	*/
	function _remap($method,$args){

		if (method_exists($this, $method)){
			$this->$method($args);
		}else{
			$this->index($method,$args);
		}
	}

	/*
	*	Страница /catalog - вывод 8 случайных товаров
	*/
	public function all(){

			$this->load->model('catalog_model');
			$products = $this->catalog_model->get_random_hot_products(8);
			$this->data["products"] = $products;
			$this->data["hot"] = $this->load->view("catalog/hot",$this->data,true);
			$this->data["promo_menu"] = $this->load->view("catalog/promo_menu",$this->data,true);
			$this->data["title"] = "Каталог товаров";
			$this->middle = 'catalog/index';
			$this->layout();
	}

	/*
	*	Отображение списка товаров по категории /catalog/category_name
	*	@param string $alias - название категории на латинице
	*	@param array $args - массив входящих параметров
	*/
	public function index($alias,$args=''){
		// var_dump($args);
		// $this->output->enable_profiler(TRUE);
		// echo "index_method";
		// var_dump($this->uri);
		// var_dump($order_base_url); die();
		// var_dump($this->uri->uri_string);
		// var_dump($method);
		// var_dump($args);
		// die();
		$this->load->model('catalog_model');
		$this->data["url_for_order"] = $this->catalog_model->get_url_for_order($this->uri->uri_string());

		//Формируем массив с параметрами сортировки, фильтрации и номером страницы
		$parametrs = $this->catalog_model->get_params($args);
		// var_dump($parametrs);die();
		if(empty($parametrs)){
			show_404();
		}

		$product = $parametrs["product"];
		$order = $parametrs["order"];
		$filter = $parametrs["filter"];


		//Получаем информации о переданной категории
		$category_info =$this->catalog_model->get_category_info($alias);
		// var_dump($category_info); die();
		if (empty($category_info)) {
			show_404();
		}
		$category_id = $category_info["category_id"];


		//Устанавливаем количество товаров на странице и получаем общее
		//количество товаров данной категории
		$per_page = 2;
		$total_rows = $this->catalog_model->get_products_count_by_category($category_id,$filter);


		//Передаем на отображение название текущей категории, и массив товаров
		$products = $this->catalog_model->get_products_by_category($per_page,$product,$category_id,$order,$filter);

		//Формируем массив опций для пагинатора и инициализируем его
		$config = $this->catalog_model->set_pagination($this->uri,$per_page,$total_rows,$product);
		$this->load->library('pagination');
		$this->pagination->initialize($config);

		// var_dump($products);
		// die();
		if(empty($products)){
			show_404();
		}

		//Записываем необходимые данные в отображение и выводим его
		if(isset($filter["product_firm"])){
			$this->data["product_firm"] =$filter["product_firm"];
		}else{
			$this->data["product_firm"] =$category_info["category_name"];
		}
		$this->data["products"] = $products;
		$this->data["firm_list"] = $this->catalog_model->get_category_firm_list($category_id);
		$this->data["category"] = $alias;
		$this->data["category_name"] = $category_info["category_name"];
		$this->data["category_id"] = $category_id;
		$this->data["order"] = $order;
		$this->data["filter"] = $filter;
		$this->data["product"] = $product;
		$this->data["firms"] = $this->load->view("catalog/firms",$this->data,true);
		$this->data["title"] = "Каталог товаров: ".$category_info['category_name'];
		array_push($this->js, 'ajax-catalog.js');
		$this->middle = 'catalog/products';
		$this->layout();

	}

}
