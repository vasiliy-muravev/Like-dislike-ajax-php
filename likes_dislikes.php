<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$text = '';
$comment_id = '';
$client_id = '';
$likes = 5;
$dislikes = 2;

$text .= '
	<link href="css/style.css" rel="stylesheet" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="js/js.js" charset="utf-8"></script>
	';
$text .= 
	'<div class="likedislikecomment">
	    <a class="like-comment" like_dislike="like" data_razdel="7" comment_id="'.$comment_id.'" client_id="'.$client_id.'" onclick="like_dislike(this);"></a>
			<span class="count-like" data-countid="'.$comment_id.'">'.$likes.'</span>
		<a class="dislike-comment" like_dislike="dislike" data_razdel="7" comment_id="'.$comment_id.'" client_id="'.$client_id.'" onclick="like_dislike(this);"></a>
			<span class="count-dislike" data-countid="'.$comment_id.'">'.$dislikes.'</span>
	</div>
	';

echo $text;
