<?php

session_start();
if ( ! isset( $_SESSION['user'] ) ) {
	header( 'location:log-in.php' );
}

$error;
$success = 0;
require_once 'connect.php';

$sql    = 'SELECT * FROM `sr_category`';
$result = mysqli_query( $con, $sql );

if ( $result ) {
	$num = mysqli_num_rows( $result );

	if ( $num > 0 ) {
		for ( $i = 0; $i < $num; $i++ ) {
			$categories[] = mysqli_fetch_assoc( $result );
		}
	}
}

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {


	// Input field value.
	$post_title   = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	$post_status  = $_POST['post_status'];
	$user_name    = $_SESSION['user'];
	$category_id  = $_POST['cat_id'];

	$sql    = "SELECT * FROM `register` WHERE `full_name` = '$user_name'";
	$result = mysqli_query( $con, $sql );

	if ( $result ) {
		$num = mysqli_num_rows( $result );

		if ( $num > 0 ) {
			$row       = mysqli_fetch_assoc( $result );
			$author_id = $row['id'];
		}
	}

	if ( empty( $post_title ) || empty( $post_content ) ) {
		$error['empty'] = 'Please Enter Post Title or Content';
	}

	if ( ! isset( $error ) ) {
		$sql = "INSERT INTO `sr_posts` (post_title, content, post_status, post_author, cat_id, post_date ) VALUE ('$post_title', '$post_content', '$post_status', '$author_id', '$category_id', NOW() )";

		$result = mysqli_query( $con, $sql );

		if ( $result ) {
			$success = 1;
			// header( 'location: index.php' );
		} else {
			$error['msg'] = 'Faild to insert post';
			die( mysqli_error( $con ) );
		}
	}
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/form.css">
	<link rel="stylesheet" href="../css/admin.css">
	<title>Add Post</title>
</head>

<body>

	<div class="container-fluid">
		<!-- Admin page Sidebar start -->
		<?php require_once 'admin-sidebar.php'; ?>
		<!-- Admin page Sidebar ends -->

		<main>
		<div class="post-form">
			<div class="post-head">
				<h2>Add Post</h2>
			</div>
			<form action="" method="POST">
				<label for="title">Add Title</label>
				<input type="text" name="post_title" id="title" placeholder="Enter your full name">
				<label for="post_content">Post Content</label>
				<textarea name="post_content" id="post_content" rows="15"></textarea>

				<select name="post_status" id="post_status">
					<option value="publish">Publish</option>
					<option value="draft">Draft / Save</option>
				</select>
				<select name="cat_id" id="cat_id">
					<?php
					foreach ( $categories as $category ) {
						echo '<option value="' . $category['cat_id'] . '">' . $category['cat_name'] . '</option>';
					}
					?>
					</select>

				<input type="submit" value="Add Post">
				<?php
				if ( isset( $error['empty'] ) ) {
					echo '<p>' . $error['empty'] . '</p>';  }
				?>
			</form>
			<?php
			if ( isset( $error['msg'] ) ) {
				echo '<p>' . $error['msg'] . '</p>';  }
			?>
							
		</div>
		</main>

	</div>	

</body>

</html>
