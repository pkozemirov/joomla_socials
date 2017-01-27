<?
	
	require_once '../_jinit.php';
	
	class UserData{
		public $id;
		public $name;
		
		public function __construct($outer_data){
			$this->id = $outer_data->id;
			$this->name = $outer_data->first_name . ' ' . $outer_data->last_name;
		}
	}

	if(isset($_GET['token'])){
		
		$user_data_outer = json_decode(file_get_contents('https://login.yandex.ru/info?format=json&oauth_token=' . $_GET['token']));
		
		$user_data = new UserData($user_data_outer);
		$user_data->id = 'ya_' . $user_data->id;
		
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}

		require_once '../register_or_auth.php';

	} else {
?>
<script>
	var token = /access_token=([^&]+)/.exec(document.location.hash)[1];
	document.location.href= '?token=' + token;
</script>
<?		
	}
	
?>
