<?php

/*
*	Парсер продукта с price.ua
*	@param string name - точное название продукта на price.ua
*/
function parse($name){

		if(!is_string($name) || empty($name)){
			return array("error" => "неверный формат  имени");
		}

		$name = urlencode($name);
		$url = "http://price.ua/search/?q=".$name;

		$ch = curl_init();
		$timeout = 0;
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$rawdata = curl_exec($ch);
		if(!$rawdata) {
			return array("error" => "нет такого товара");
		}
		curl_close($ch);
		$rawdata = str_replace(array("\r\n", "\r", "\n"), '', $rawdata);

		preg_match('/<div\s+?class="products-list.*?><div\s+?class="product-item.*?<div\s+?.*?data-big-image-url="(?P<img>.*?)".*?<a\s+?class="model-name.*?>(?P<product_name>.*?)<\/a>.*?<div\sclass="characteristics.*?>(?P<parametrs>.*?)<\/div>*<\/div>.*?<span\sclass="price.+?>(?<price>.+?)<span/i', $rawdata, $matches);

		preg_match_all ( '/<span\sclass="fbold.*?>(?P<option>.*?)<\/span>(?P<value>.*?)<\/div>/i', $matches["parametrs"],$parametrs );

		if(empty($matches) || empty($parametrs)) {
			return array("error" => "нет такого товара");
		}

		foreach ($parametrs["option"] as $key => $value) {
			$info[] = ($value." ".trim($parametrs["value"][$key]));
		}

		$info = implode("\n" , $info );

		$price = $matches["price"];
		$price = trim($price);
		$price = htmlentities($price);
		$price = str_replace(array("&nbsp;","&Acirc;"), '',$price);
		$url = preg_replace("/[^a-zA-Z0-9_]/","_",$matches["product_name"]);

		$product = array(
				"product_name" => trim($matches["product_name"]),
				"product_url" => $url,
				"product_img" => $matches["img"],
				"product_price" => $price,
				"product_descr" => $info
			);

		if(empty($product)){
			return array("error" => "товар не найден");
		}else {
			return array("data" => $product);
		}
}
