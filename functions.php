<?php

function claculate_page_number ($input_or_output, $image_name) {
	if ($input_or_output == "input") {
		$page_number = (int) substr ($image_name, strpos ($image_name, "_") + 1 , (strpos ($image_name, ".") - strpos ($image_name, "_") - 1));
	}
	elseif ($input_or_output == "output") {
		$page_number = (int) substr ($image_name, strpos ($image_name, "/") + 1 , (strpos ($image_name, "_") -1));
	}
	return $page_number;
}
function create_column_image ($right_or_left, $image_name) {
	$im = imagecreatefromjpeg($image_name);
	$page_number = claculate_page_number ("input", $image_name);
	$odd_or_even = ($page_number % 2 == 0) ? "even" : "odd";
	$start_height = 0;
	$end_height = imagesy ($im);
	if ($right_or_left == "left") {
		$start_width = 0;
		if ($odd_or_even == "odd") { //fard
			$end_width = (imagesx ($im) / 2) + 100;
		}
		elseif ($odd_or_even == "even") { //zowj
			$end_width = (imagesx ($im) / 2) + 100;
		}
		else {
			return "please choose odd or even page.";
		}
		$column_number = 2;
	}
	elseif ($right_or_left == "right") {
		if ($odd_or_even == "odd") { //fard
			$start_width = (imagesx ($im)/2) - 200;
		} 
		elseif ($odd_or_even == "even") { //zowj
			$start_width = (imagesx ($im)/2) - 200;
		} 
		else {
			return "please choose odd or even page.";
		}
		$end_width = (imagesx ($im)/2) + 50;
		$column_number = 1;
	}
	else {
		return "please choose right or left column";
	}
	imagedestroy($im);
	return cut_image ($image_name, "input", $column_number, $start_width, $start_height, $end_width, $end_height);
}

function cut_image ($image_name, $input_or_output, $column_number, $start_width, $start_height, $end_width, $end_height) {
	$im = imagecreatefromjpeg($image_name);
	$page_number = claculate_page_number ($input_or_output, $image_name);
	$output_image = imagecrop ($im, ['x' => $start_width, 'y' => $start_height, 'width' => $end_width, 'height' => $end_height ]);
	if ($output_image !== FALSE) {
		$output_image_created = imagejpeg ($output_image, "output/".$page_number.'_'.$column_number.'.jpg');
		if ($output_image_created !== FALSE) {
            imagedestroy ($output_image);
			return "successful";
		}
		else {
            imagedestroy ($output_image);
			return "imagejpeg doesnt successful";
		}
	}
	else {
        imagedestroy ($output_image);
		return "imagecrop doesnt successful";
	}
}

function convert_image_to_columns ($image_name) {
	create_column_image ("left", $image_name);
	create_column_image ("right", $image_name);
}

function merge_two_image ($first_image_name, $second_image_name) {
	$first_im = imagecreatefromjpeg($first_image_name);
	$second_im = imagecreatefromjpeg($second_image_name);
	$page_number = claculate_page_number ("output", $first_image_name);
	$output_image_name = "merged_output3/".$page_number.".jpg";
	$first_image = imagecrop ($first_im, ['x' => 0, 'y' => 0, 'width' => (max(imagesx ($first_im), imagesx ($second_im))), 'height' => (imagesy ($first_im)*2) ]);
	$first_image_created = imagejpeg ($first_image, $output_image_name);
	imagedestroy ($first_image);
	$im = imagecreatefromjpeg($output_image_name);
	//imagecopymerge ( resource $dst_im , resource $src_im , $dst_x , $dst_y , $src_x , $src_y , $src_w , $src_h , $pct ) : bool
	imagecopymerge($im, $second_im, 0 , imagesy ($first_im) , 0, 0, imagesx ($second_im) , imagesy ($second_im) , 100);
	$image_created = imagejpeg ($im, $output_image_name);
}

?>