<?
	
	require_once '../_jinit.php';
	
	class UserData{
		public $id;
		public $name;
		
		public function __construct($outer_data){
			$this->id = $outer_data[0]->uid;
			$this->name = $outer_data[0]->nick;
		}
	}

	if(isset($_GET['token'])){
		
		$token = $_GET['token'];
		
		// client_id, then token and secret
	    $sign = md5("app_id=method=users.getInfosecure=1session_key=" . $token . "$client_secret");
	    $params = array(
	        'method'       => 'users.getInfo',
	        'secure'       => '1',
	        'app_id'       => '',
	        'session_key'  => $token,
	        'sig'          => $sign
	    );
	    
	    foreach($params as $key => $value){
		    $params[$key] = $key . '=' . $value;
	    }
		$user_data_outer = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . implode('&', $params)));
		
		$user_data = new UserData($user_data_outer);
		$user_data->id = 'mr_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}

		require_once '../register_or_auth.php';	

	}
	
?>
<script>
	var token = /access_token=([^&]+)/.exec(document.location.hash)[1];
	document.location.href= '?token=' + token;
</script>