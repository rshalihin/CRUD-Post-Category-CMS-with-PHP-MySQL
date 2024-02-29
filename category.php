<?php

session_start();
if ( isset( $_SESSION['user'] ) ) {
	$user_name = $_SESSION['user'];
}
require_once 'admin/connect.php';
require_once 'admin/function.php';

$category_id = (int) $_GET['cat_id'];

$sql    = "SELECT * FROM `sr_posts` WHERE cat_id = '$category_id' ORDER BY post_date DESC";
$result = mysqli_query( $con, $sql );

if ( $result ) {
	$num = mysqli_num_rows( $result );

	if ( $num > 0 ) {
		for ( $i = 0; $i < $num; $i++ ) {
			$all_posts[] = mysqli_fetch_assoc( $result );

		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/front.css">
	<title>Welcome Home</title>
</head>
<body>

<div class="container-fluid">
	<?php
	foreach ( $all_posts as $post ) {
		echo '<div class="card"><div class="Post-card">';
		echo '<div class="author-name"><h4>' . get_author( $post['post_author'] ) . '</h4></div>';
		echo '<div class="time">' . $post['post_date'] . '</div>';
		echo '<div class="category"><a href="category.php?cat_id=' . $post['cat_id'] . '" target="_blank">Category: ' . get_category( $post['cat_id'] ) . '</a></div>';
		echo '<div class="post">' . $post['content'] . '</div>';
		echo '</div></div>';
	}
	?>
</div>
