<?

	require_once '../_jinit.php';
	
	if(isset($_GET['token'])){
		$token = $_GET['token'];
		$user_id = $_GET['user_id'];
		$user_data = json_decode(file_get_contents("https://apis.live.net/v5.0/me?access_token=" . $token));
		if(!$user_data){
			die('Произошла непредвиденная ошибка. Пожалуйста, попробуйте еще раз.');
		}
		$user_data->id = 'ms_' . $user_data->id;
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