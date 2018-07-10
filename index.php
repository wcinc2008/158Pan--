<?php
/**
 * @package 158Pan
 * @author Mlooc
 * @version 1.0.0
 * @link https://mlooc.cn
 */
// 指定允许其他域名访问  
header('Access-Control-Allow-Origin:*');
	function object_array($array) {  
	    if(is_object($array)) {  
	        $array = (array)$array;  
	    } if(is_array($array)) {  
	        foreach($array as $key=>$value) {  
	            $array[$key] = object_array($value);  
	        }  
	    }  
	    return $array;  
	}

	function MloocCurl($post_data){
		$UserAgent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36';#设置UserAgent
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "http://api.baizhu.cc/api/getinfo");
		curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
		#关闭SSL
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		#返回数据不直接显示
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
		$post_data='js={"appid":"307","getlist":{"c1":1,"inslog":"","proc":null,"reg":[{"id":25},{"id":39},{"id":45},{"id":69},{"id":203},{"id":213}]},"id":2052,"mac":"2C-FD-A1-7B-7E-11","md5":"CF517D077E9C152120787EB6B251615B","msoft":"LG%E5%8A%A9%E6%89%8B5.8%E5%AF%86%E7%A0%81666%40307_112837.exe","rgn":"","sid":"'.$id .'","st":0,"ver":"2.2.1.207","zn":8}';
		$result = json_decode(MloocCurl($post_data,true));
		$result = object_array($result);
		$downUrl = $result["main"]["descr_downurl"];
		header('Location:'.$downUrl);
	}else{
		$result_url = str_replace("index.php","","//".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?id=113249");
		echo "演示：";
		echo "<br/>";
		echo "<br/>";
		echo '<a href="'.$result_url.'" target="_blank">'.$result_url.'</a>';
	}
?>