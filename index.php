<?php

session_start();
if ( isset( $_SESSION['user'] ) ) {
	$user_name = $_SESSION['user'];
}
require_once 'admin/connect.php';
require_once 'admin/function.php';

$sql    = 'SELECT * FROM `sr_posts` ORDER BY post_date DESC';
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
		echo '<div class="category">Category: ' . get_category( $post['cat_id'] ) . '</div>';
		echo '<div class="post">' . $post['content'] . '</div>';
		echo '</div></div>';
	}
	?>
</div>



</body>

</html>
