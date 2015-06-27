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
			$this->output->enable_profiler(TRUE);
			$this->load->model('catalog_model');
			$products = $this->catalog_model->get_random_hot_products(8);
			if (isset($products["error"])) {
				$products = array();
			}
			$products = $products["data"];
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
		$this->load->model('catalog_model');
		$url_for_order = $this->catalog_model->get_url_for_order($this->uri->uri_string());
		if (isset($url_for_order["error"])){
			show_404("Произошла непредвиленная ошибка, попробуйте повторить ваш запрос");
		}
		$this->data["url_for_order"] = $url_for_order["data"];

		//Формируем массив с параметрами сортировки, фильтрации и номером страницы
		$parametrs = $this->catalog_model->get_params($args);
		if(isset($parametrs["error"])){
			show_404("По вашему запросу ничего не найдено");
		}
		$parametrs = $parametrs["data"];
		$product = $parametrs["product"];
		$order = $parametrs["order"];
		$filter = $parametrs["filter"];

		//Получаем информации о переданной категории
		$category_info =$this->catalog_model->get_category_info($alias);
		if (isset($category_info["error"])) {
			show_404("По вашему запросу ничего не найдено");
		}
		$category_info = $category_info["data"];
		$category_id = $category_info["category_id"];


		//Устанавливаем количество товаров на странице и получаем общее
		//количество товаров данной категории
		$per_page = 2;
		$total_rows = $this->catalog_model->get_products_count_by_category($category_id,$filter);
		if (isset($total_rows["error"])){
			show_404("По вашему запросу ничего не найдено");
		}
		$total_rows = $total_rows["data"];

		//Передаем на отображение название текущей категории, и массив товаров
		$products = $this->catalog_model->get_products_by_category($per_page,$product,$category_id,$order,$filter);
		if (isset($products["error"])){
			show_404("По вашему запросу ничего не найдено3");
		}
		$products = $products["data"];

		//Формируем массив опций для пагинатора и инициализируем его
		$config = $this->catalog_model->set_pagination($this->uri,$per_page,$total_rows,$product);
		if (isset($config["error"])){
			show_404("По вашему запросу ничего не найдено");
		}
		$config = $config["data"];

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$firm_list = $this->catalog_model->get_category_firm_list($category_id);
		if (isset($firm_list["error"])){
			$firm_list = array();
		}else{
			$firm_list = $firm_list["data"];
		}

		//Записываем необходимые данные в отображение и выводим его
		if(isset($filter["firm_name"])){
			$this->data["product_firm"] =$filter["firm_name"];
		}else{
			$this->data["product_firm"] =$category_info["category_name"];
		}
		$this->data["products"] = $products;
		$this->data["firm_list"] = $firm_list;
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

	public function find(){
		if(null!==$this->input->post('search')){
			$search = $this->input->post('search',TRUE);
			$search = urlencode($search);
			redirect('/search/'.$search);
		}
	}

	public function search($search=''){
		if(!empty($search)){
			$this->load->helper('security');
			$query = urldecode($search[0]);
			$query = xss_clean($query);

			if(isset($search[1])){
				$page = $search[1];
				$page = xss_clean($page);
			}else{
				$page = null;
			}
			$per_page = 5;

			if($page == 0){
				$offset =0;
			} else{
				$offset = ($page-1)*$per_page;
			}

			$this->load->model('catalog_model');
			$products = $this->catalog_model->search($query,$per_page,$offset);
			if(isset($products["error"])){
				show_404("Неверно заданый поиск");
			}
			$products = $products["data"];
			$total_rows = $this->catalog_model->get_search_count($query);
			if(isset($total_rows["error"])){
				show_404("Возникла непридвиденная ошибка");
			}
			$total_rows = $total_rows["data"];
			$this->catalog_model->set_search_pagination($per_page,$page,$total_rows,$query);
			$this->data["search_count"] = $total_rows;
			$this->data["products"] = $products;
			$this->data["search_text"] = $query;
		}


		$this->middle = 'catalog/search';
		$this->layout();


	}


}
