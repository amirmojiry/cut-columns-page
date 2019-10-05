<?php

ini_set('max_execution_time', 300000);
include_once 'functions.php';

?>
<html>
	<head>
		<title>
			برش ستون از صفحه
		</title>
		<style>
			img.column {
				width:200px;
				border-style: dashed;
				margin-left: 50px;
			}
		</style>
	</head>
	<body>
		<center dir="rtl">
			<?php
			if ( ! empty ($_GET['p']) ) {
				$page_number = $_GET['p'];
			}
			else {
				die ("set page number");
			}
			?>
			<div>
				<a href="cut_pages.php?p=<?= $page_number ?>">
					برش مجدد این صفحه
				</a>
			</div>
			<div>
				<a href="?p=<?= $page_number - 1  ?>" style="margin:20px">
					صفحه قبلی
				</a>
				<a href="?p=<?= $page_number + 1  ?>">
					صفحه بعدی
				</a>
			</div>
			<form method="POST">
				<div>	
					<label for="cut_right">
						برش ستون راست
					</label>
					<input type="text" name="cut_right" autocomplete="off" autofocus><br>
				</div>
				<br>
				<div>
					<label for="cut_left">
						برش ستون چپ
					</label>
					<input type="text" name="cut_left" autocomplete="off"><br>
				<div>
				<input type="submit" value="cut">
			</form>
			<div>
			<?php
			if ($page_number >= 29 && $page_number <= 1544) {
				$column_right = "output/".$page_number."_1.jpg";
				$column_left = "output/".$page_number."_2.jpg";
				echo "<img src='$column_right' class='column'>";
				echo "<img src='$column_left' class='column'>";
			}
			if (! empty ($_POST)) {
				$start_height = 0;
				if (! empty ($_POST['cut_right'])) {
					
					$im = imagecreatefromjpeg($column_right);
					$end_height = imagesy ($im);
					$start_width = $_POST['cut_right'];
					$end_width = imagesx ($im) - $start_width;
					cut_image ($column_right, "output", 1, $start_width, $start_height, $end_width, $end_height);
				}
				elseif (! empty ($_POST['cut_left'])) {
					$im = imagecreatefromjpeg($column_left);
					$end_height = imagesy ($im);
					$start_width = 0;
					$end_width = imagesx ($im) - $_POST['cut_left'];
					cut_image ($column_left, "output", 2, $start_width, $start_height, $end_width, $end_height);
				}
			}
			?>
			</div>
			<div>
				<a href="?p=<?= $page_number - 1  ?>" style="margin:20px">
					صفحه قبلی
				</a>
				<a href="?p=<?= $page_number + 1  ?>">
					صفحه بعدی
				</a>
			</div>
		</center>
	</body>
</html>


