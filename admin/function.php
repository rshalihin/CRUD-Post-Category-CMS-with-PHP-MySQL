<?php


// Get Author Name form Id
function get_author( $author_id ) {
	global $con;
	// $author_id = $all_posts['post_author'];
	$sql    = "SELECT * FROM `register` WHERE id = '$author_id'";
	$result = mysqli_query( $con, $sql );
	if ( $result ) {
		$num = mysqli_num_rows( $result );

		if ( $num > 0 ) {
			$row         = mysqli_fetch_assoc( $result );
			$author_name = $row['full_name'];
		}
	}
	return $author_name;
}

// Get Category name form Id
function get_category( $cat_id ) {
	global $con;
	// $author_id = $all_posts['post_author'];
	$sql    = "SELECT * FROM `sr_category` WHERE cat_id = '$cat_id'";
	$result = mysqli_query( $con, $sql );
	if ( $result ) {
		$num = mysqli_num_rows( $result );

		if ( $num > 0 ) {
			$row           = mysqli_fetch_assoc( $result );
			$category_name = $row['cat_name'];
		}
	}
	return $category_name;
}
