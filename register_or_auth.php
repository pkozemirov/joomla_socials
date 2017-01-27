<?
	$credentials = array('username'=>$user_data->id, 'password'=>$user_data->id);
	$options = array('remember'=>true);
		
	//выполняем авторизацию
	if(!$app->login($credentials, $options)){
		$userData = array( 
		    'name' => $user_data->name,
		    'username' => $user_data->id,
		    'password' => $user_data->id,
		    'password2' => $user_data->id,
		    'groups' => array(2)
		);
		
		// проверка сохранения данных в базе
		$user = new JUser;

		if(!$user->bind($userData)) {
			throw new Exception("Could not bind data. Error: " . $user->getError());
		}
		if (!$user->save()) {
			throw new Exception("Could not save user. Error: " . $user->getError());
		}
		if(!$app->login($credentials, $options)){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
	}
?>
<script>
	window.opener.location.reload();
	window.close();
</script>