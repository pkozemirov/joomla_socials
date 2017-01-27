<?
	require_once '_jinit.php';
	$app->logout();
	header("Location: " . $_SERVER['HTTP_REFERER']);
?>