<?

	require_once '../_jinit.php';
	
	if(isset($_GET['code'])){
		$params = array(
			'client_id' . '=' . '',
			'redirect_uri' . '=' . 'https://'. $_SERVER['SERVER_NAME'] . '/joomla_socials/socials/vk.php',
			'client_secret' . '=' . '',
			'code' . '=' . $_GET['code']
		);
		
		$token = json_decode(file_get_contents("https://oauth.vk.com/access_token?" . implode('&', $params)))->access_token;
		
		if(!$token){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		$user_data_outer = json_decode(file_get_contents("https://api.vk.com/method/users.get?access_token=" . $token));
		
		class UserData{
			public $id;
			public $name;
			
			public function __construct($outer_data){
				$this->id = $outer_data->response[0]->uid;
				$this->name = $outer_data->response[0]->first_name . ' ' . $outer_data->response[0]->last_name;
			}
		}
		
		$user_data = new UserData($user_data_outer);
		$user_data->id = 'vk_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		require_once '../register_or_auth.php';

	}
	
?>