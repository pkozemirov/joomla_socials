<?

	require_once '../_jinit.php';
	
	$public_key = "";
	$client_secret = "";
	
	if(isset($_GET['code'])){
		$params = array(
			'client_id' . '=' . '',
			'redirect_uri' . '=' . 'https://'. $_SERVER['SERVER_NAME'] . '/joomla_socials/socials/ok.php',
			'client_secret' . '=' . '',
			'code' . '=' . $_GET['code'],
			'grant_type' . '=' . 'authorization_code'
		);
		
		$ch = curl_init();
		$url = "https://api.ok.ru/oauth/token.do";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$token = json_decode(curl_exec($ch))->access_token;
		curl_close ($ch);
		
		if(!$token){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		$sign1=md5($token . $client_secret);
		$sign2="application_key=".$public_key."method=users.getCurrentUser".$sign1;
		$sign=strtolower(md5($sign2));

	    $user_data_outer = json_decode(file_get_contents("http://api.ok.ru/fb.do?application_key=".$public_key."&method=users.getCurrentUser&access_token=".$token."&sig=".$sign), true);
		
		class UserData{
			public $id;
			public $name;
			
			public function __construct($outer_data){
				$this->id = $outer_data['uid'];
				$this->name = $outer_data['name'];
			}
		}
		
		$user_data = new UserData($user_data_outer);
		$user_data->id = 'ok_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		require_once '../register_or_auth.php';

	}
	
?>