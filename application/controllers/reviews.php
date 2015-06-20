<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MY_Controller{

	/*
	*	Главная страница Отзывов
	*/
	public function index($current_page="null"){

		$this->load->model('reviews_model');

		//Проверяем был ли отправлен комментарий
		if(null!==$this->input->post('add_review')){

			$this->load->library('form_validation');
			$this->load->model('rules_model');
			$this->form_validation->set_rules($this->rules_model->reviews_errors());
			$check = $this->form_validation->run('reviews');


			//Если поля прошли валидацию, то пытаемся добавить запись в бд, если валидация
			//не удалась, то грузим форму с теми же данными и выводим ошибки
			if ($check == TRUE){

				$insert["review_text"] = $this->input->post('text');

				//Получаем имя загруженного файла для проверки далее был ли загружен вообще файл
				$tmp_name = $_FILES["userfile"]["tmp_name"];

				//Проверяем был ли загружен вообще файл, если был то обрабатываем его,
				//если нет - то добавляем коммент
				if (is_uploaded_file($tmp_name)) {

					$file = $this->upload_file();

					//Проверяем удалась ли загрузка файла, либо возникла ошибка
					if ($file["result"]) {
						$insert["review_file"] = $file["file_name"];
						$insert["review_filename"] = $file["orig_name"];
						$add_review = $this->reviews_model->add_review($insert);
						if (isset($add_review["error"])){
							show_404("ошибка добавления комментария");
						}
						redirect($this->uri->uri_string());
					}else{
						$this->data["file_error"] = $file["file_error"];
					}

				}else{
					$add_review = $this->reviews_model->add_review($insert);
					if (isset($add_review["error"])){
						show_404("ошибка добавления комментария");
					}
					redirect($this->uri->uri_string());
				}

			}
		}

		//Опции для пагинатора
		$per_page = 5;
		$page = intval($current_page);

		//Данные для отображения
		$this->reviews_model->set_pagination($per_page,$page);
		$reviews = $this->reviews_model->get_reviews($per_page,$page);
		if(isset($reviews["error"])){
			$reviews = array();
		}else{
			$reviews = $reviews["data"];
		}
		$this->data["form"] = $this->load->view("reviews/form_add_review",$this->data,true);
		$this->data["reviews"] = $reviews;
		$this->data["title"] = "Отзывы";
		array_push($this->js, 'ajax-reviews.js');
		$this->middle = 'reviews/index';
		$this->layout();
	}

	/*
	*	Загрузка файла
	*	@return array с информацией о загруженном файле
	*/
	private function upload_file() {

		//Правила загружаемного файла
		$config['upload_path'] = 'asset/upload/reviews';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload',$config);

		//Пытаемся загрузить файл
		if ($this->upload->do_upload()) {
			$info = $this->upload->data();
			return array("result" => true, "file_name" => $info["file_name"], "orig_name" => $info["orig_name"]);
		}else {
			return array("result" => false, "file_error" => $this->upload->display_errors());
		}

	}

}
