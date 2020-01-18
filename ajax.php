<?php 
header('Content-Type: text/html; charset=windows-1251');
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$count = '';
//getting data
$like_or_dislike = $_POST['like_or_dislike'];
$data_razdel = $_POST['data_razdel'];
$comment_id = $_POST['comment_id'];
$client_id = $_POST['client_id'];

$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'test';
$link = mysqli_connect($host, $user, $password, $db_name);

//get the current number of likes / dislikes
$arr0 = [];
$query = 'SELECT likes,dislikes FROM `comments` WHERE comment_id = '.$comment_id.';';
$result0 = mysqli_query($link, $query);
if (mysqli_fetch_assoc($result0) ! = 0){
	for ($arr0 = []; $row = mysqli_fetch_assoc($result0); $arr0[] = $row);
}
$curlikes = $arr0['likes'];
$curdislikes = $arr0['dislikes'];

//checking if user left a rating earlier
$query = 'SELECT * FROM likes_dislikes WHERE id_razdel = '.$data_razdel.' AND id_chapter = '.$comment_id.' AND client_id = '.$client_id.';';
$result1 = mysqli_query($link, $query);
if (mysqli_fetch_assoc($result1) > 0) {
	$count .= '
		<div>
		  <span>You have already rated this review</span>
		</div>
		';
	if ($like_or_dislike == 'like') $count .= $curlikes;
	if ($like_or_dislike == 'dislike') $count .= $curdislikes;
	
} else {
$query = 'INSERT INTO likes_dislikes VALUES ('.$data_razdel.','.$comment_id.', 0,'.$client_id.');';
mysqli_query($link, $query);

	if ($like_or_dislike == 'like'){
		$query = 'UPDATE `comments` SET likes = likes + 1 WHERE comment_id='.$comment_id.';';
		mysqli_query($link, $query);
		$arr2 = [];
		$query = 'SELECT likes FROM `comments` WHERE comment_id='.$comment_id.';';
		$result2 = mysqli_query($link, $query);
		if (mysqli_fetch_assoc($result2) ! = 0){
			for ($arr2 = []; $row = mysqli_fetch_assoc($result2); $arr2[] = $row);
		}
		$count .= $arr2['likes'];
	}

	if ($like_or_dislike == 'dislike'){
		$query = 'UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = '.$comment_id.';';
		mysqli_query($link, $query);
		$arr3 = [];
		$query = 'SELECT dislikes FROM `comments` WHERE comment_id = '.$comment_id.';';
		$result3 = mysqli_query($link, $query);
		if (mysqli_fetch_assoc($result3) ! = 0){
			for ($arr3 = []; $row = mysqli_fetch_assoc($result3); $arr3[] = $row);
		}
		$count .= $arr3['dislikes'];
	}
}
echo $count;