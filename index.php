<?php
	$params = explode( "/", $_GET['params'] );
	
	$setting = explode( "x", $params[0] );

	$widthParam = (int) $setting[0];
	$heightParam = (int) $setting[1];

	if($params[1]){
		$background = explode(",",hex2rgb($params[1]));
	} else {
		$background = explode(",",hex2rgb('CCC'));
	}
	
	$width = empty($widthParam) ? 100 : $widthParam;
	$height = empty($heightParam) ? 100 : $heightParam;
	
	$values = array( 
		0, 0,
		0, $height, 
		$width - 1, 0,
		$width - 1, $height
	);

	$image = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocate($image, $background[0], $background[1], $background[2]);
	
	$polygon_color = imagecolorallocate($image, 170, 170, 170);
	imagepolygon($image, $values, 4, $polygon_color);

	header('Content-Type: image/png');
	imagepng($image);
	imagedestroy($image);

	function hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		switch(strlen($hex)){
			case 1:
				$hex = $hex.$hex;
			case 2:
				$r = hexdec($hex);
				$g = hexdec($hex);
				$b = hexdec($hex);
				break;
			case 3:
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
				break;
			default:
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
				break;
		}

		$rgb = array($r, $g, $b);
		return implode(",", $rgb); 
	}
?>