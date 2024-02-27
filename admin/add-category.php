<?php

session_start();
if ( ! isset( $_SESSION['user'] ) ) {
	header( 'location:log-in.php' );
}

$error;
$success = 0;

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	include_once 'connect.php';

	// Input field value.
	$cat_name    = $_POST['cat_name'];
	$cat_details = $_POST['cat_details'];


	if ( empty( $cat_name ) ) {
		$error['cat_name'] = 'Please Enter the category name';
	}

	if ( ! isset( $error ) ) {
		$sql = "INSERT INTO `sr_category` (cat_name, cat_details ) VALUE ('$cat_name', '$cat_details' )";

		$result = mysqli_query( $con, $sql );

		if ( $result ) {
			$success = 1;
		} else {
			$error['msg'] = 'Faild to insert Category';
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
	<title>Add Categoryt</title>
</head>

<body>

	<div class="container-fluid">
		<!-- Admin page Sidebar start -->
		<?php require_once 'admin-sidebar.php'; ?>
		<!-- Admin page Sidebar ends -->

		<main>
		<div class="post-form">
			<div class="post-head">
				<h2>Add Category</h2>
				<?php
				if ( $success === 1 ) {
					echo '<br><p class="success-alert">Category added successfuly</p>';  }
				?>
			</div>
			<form action="" method="POST">
				<label for="cat_name">Add Category</label>
				<input type="text" name="cat_name" id="title" placeholder="Enter category name">
				<label for="cat_details">Category Details</label>
				<textarea name="cat_details" id="cat_details" rows="5"></textarea>

				<input type="submit" value="Add Category">
				<?php
				if ( isset( $error['cat_name'] ) ) {
					echo '<p>' . $error['cat_name'] . '</p>';  }
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
