<?php

session_start();
if ( ! isset( $_SESSION['user'] ) ) {
	header( 'location:log-in.php' );
}
	$total_user     = 0;
	$total_posts    = 0;
	$total_category = 0;
	require_once 'connect.php';

	// User count.
	$sql    = 'SELECT * FROM `register`';
	$result = mysqli_query( $con, $sql );
if ( $result ) {
	$num        = mysqli_num_rows( $result );
	$total_user = $num;

}

	// Posts count.
	$sql    = 'SELECT * FROM `sr_posts`';
	$result = mysqli_query( $con, $sql );
if ( $result ) {
	$num         = mysqli_num_rows( $result );
	$total_posts = $num;

}
	// Category count.
	$sql    = 'SELECT * FROM `sr_category`';
	$result = mysqli_query( $con, $sql );
if ( $result ) {
	$num            = mysqli_num_rows( $result );
	$total_category = $num;

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/admin.css">
	<title>Registration Home</title>
</head>

<body>

	<div class="container-fluid">
		<!-- Admin page Sidebar start -->
		<?php require_once 'admin-sidebar.php'; ?>
		<!-- Admin page Sidebar ends -->

		<main class="main-body">
			<div class="main-body-header d-flex">
				<div class="header-body">
					<h1>Welcome
						<?php echo $_SESSION['user']; ?>
					</h1>
				</div>
				<div class="header-body">
					<a href="logout.php">Logout</a>
				</div>                
			</div>
			<div class="main-content d-flex">
				<div class="user-count card mr-1">
					<div class="content-card">
						<h3>Total User is: <?php echo $total_user; ?></h3>
					</div>				
				</div>
				<div class="post-count card mr-1">
				<div class="content-card">
						<h3>Total Posts is: <?php echo $total_posts; ?></h3>
					</div>
				</div>
				<div class="category-count card">
				<div class="content-card">
						<h3>Total Category is: <?php echo $total_category; ?></h3>
					</div>
				</div>
			</div>		
		</main>		
	</div>
	

</body>

</html>
