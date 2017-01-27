<?

	require_once '../_jinit.php';
	
	if(isset($_GET['code'])){
		$params = array(
			'client_id' . '=' . '',
			'grant_type' . '=' . 'authorization_code',
			'redirect_uri' . '=' . 'https://'. $_SERVER['SERVER_NAME'] . '/joomla_socials/socials/ig.php',
			'client_secret' . '=' . '',
			'code' . '=' . $_GET['code']
		);
		
		$ch = curl_init();
		$url = "https://api.instagram.com/oauth/access_token";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$user_data_outer = json_decode(curl_exec($ch));
		curl_close ($ch);
		
		if(!$user_data_outer){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		class UserData{
			public $id;
			public $name;
			
			public function __construct($outer_data){
				$this->id = $outer_data->user->id;
				$this->name = $outer_data->user->full_name;
			}
		}
		
		$user_data = new UserData($user_data_outer);
		$user_data->id = 'ig_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		require_once '../register_or_auth.php';

	}
	
?>