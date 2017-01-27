<?

	require_once '../_jinit.php';
	
	if(isset($_GET['code'])){
		$params = array(
			'client_id' . '=' . '',
			'redirect_uri' . '=' . 'https://'. $_SERVER['SERVER_NAME'] . '/joomla_socials/socials/fb.php',
			'client_secret' . '=' . '',
			'code' . '=' . $_GET['code']
		);
		
		$token = json_decode(file_get_contents("https://graph.facebook.com/v2.8/oauth/access_token?" . implode('&', $params)))->access_token;
		
		if(!$token){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		$user_data = json_decode(file_get_contents("https://graph.facebook.com/me?fields=email,name,id&access_token=" . $token));
		$user_data->id = 'fb_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		
		require_once '../register_or_auth.php';

	}
	
?>