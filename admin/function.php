<?php


// Get Author Name form Id.
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

// Get Category name form Id.
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

// Get Trimcontent.
function get_trimcontent( $content, $post_id ) {
	$content;
	if ( strlen( $content ) > 25 ) {
		$trimcontent = substr( $content, 0, 500 ) . ' <a href="post.php?post_id=' . $post_id . '">Read more...</a>';
	} else {
		$trimcontent = $content;
	}
		return $trimcontent;
}
