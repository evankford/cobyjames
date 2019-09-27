<?php

function isSvg($filePath = 'path/to/file') {
	if (gettype($filePath) == 'string'){
		if (realpath($filePath)) {	
			if (file_exists($filePath)) {
				return 'image/svg+xml' === mime_content_type($filePath);
			} 
		}
	}
}

add_theme_support('post-thumbnails');


//Here's how you can add custom sizes
// add_image_size('internal-thumbnail', 1400, 452);


////IMAGE SIZES
add_image_size('300w', 300);
add_image_size('450w', 4500);
add_image_size('600w', 600);
add_image_size('750w', 750);
add_image_size('900w', 900);
add_image_size('1200w', 1200);
add_image_size('1500w', 1500);
add_image_size('1800w', 1800);
add_image_size('2100w', 2100);
add_image_size('2400w', 2100);

function get_imgset($id, $max=false) {
	$toreturn = '';
	
	$sizes = array('300w', '450w' , '600w', '750w', '900w', '1200w', '1500w', '1800w', '2100w', '2400w');

	$i = 0;
	
	foreach ($sizes as $size) {
		$comma = ', ';
		if ($i == 0) {
			$comma = '';
		}
		if ($i + 1 < sizeof($sizes)) {
			$src = wp_get_attachment_image_src($id, $size, false)[0];
			
			$toreturn .= $comma .  $src . ' ' . $sizes[$i + 1];
			$i++;
			if ($size == $max) {
				break;
			}
		}
	}
	return $toreturn;
}

function imgwrap($imageid, $isbg = false, $maxsize = false) {
	$img = wp_get_attachment_image_src($imageid, '300w');
	
	   $imgurl = $img[0];
    $uploads = wp_upload_dir();
    $file_path = str_replace( $uploads['baseurl'], $uploads['basedir'], $imgurl );
	// echo $img[1];
	// echo $img[2];
	$style = '';

	$bg = '';
	if ($isbg) { 
		$bg = ' bg ' ;
		$style = '';
	}
	
	if (isSvg($file_path)) {
		echo '<div class="respimg-wrap svg ' . $bg  . '" ' . $style . '>';
		echo '<img class="respimg lazyload" src="' . $img[0] . '">';
		echo '</div>';
	} elseif ($img[1]) {
			$imgratio = ($img[2] / $img[1])*100;
			$fallback_size = '1200w';
			if ($maxsize != false) {
				$fallback_size = $maxsize;
			}
			$style= 'style="padding-bottom: '. $imgratio . '%;"';
			if ($isbg) { 
				$bg = ' bg ' ;
				$style = '';
			}
			
			
			echo '<div class="respimg-wrap ' . $bg  . '" ' . $style . '>';
			echo '<img class="respimg lazyload" src="' . wp_get_attachment_image_src($imageid, $fallback_size, false)[0] . '" data-srcset="' . get_imgset($imageid, $maxsize) . '">';
			echo '</div>';
	}
}

function vidimg($imageid, $mp4src= false, $webmsrc = false, $isbg = false, $maxsize = '2000w') {
	echo '<div class="vidimg-outer">';
		$img = wp_get_attachment_image_src($imageid, '300w');
	
	   $imgurl = $img[0];
    $uploads = wp_upload_dir();
    $file_path = str_replace( $uploads['baseurl'], $uploads['basedir'], $imgurl );
	// echo $img[1];
	// echo $img[2];
	$style = '';

	$bg = '';
	if ($isbg) { 
		$bg = ' bg ' ;
		$style = '';
	}
	
	if (isSvg($file_path)) {
		echo '<div class="respimg-wrap svg ' . $bg  . '" ' . $style . '>';
		echo '<img class="respimg lazyload" src="' . $img[0] . '">';
		echo '</div>';
	} elseif ($img[1]) {
			$imgratio = ($img[2] / $img[1])*100;
			$fallback_size = '1200w';
			if ($maxsize != false) {
				$fallback_size = $maxsize;
			}
			$style= 'style="padding-bottom: '. $imgratio . '%;"';
			if ($isbg) { 
				
				$style = '';
			}
			
			
			echo '<div class="respimg-wrap ' . $bg  . '" ' . $style . '>';
			echo '<img class="respimg lazyload" src="' . wp_get_attachment_image_src($imageid, $fallback_size, false)[0] . '" data-srcset="' . get_imgset($imageid, '2000w') . '">';
			echo '</div>';
	}
	if ($mp4src) :?>
	<div class="bgvideo-wrap loading">
		<video poster="<?php echo wp_get_attachment_image_src($imageid, '1200w', false)[0];?>" playsinline muted autoplay loop>
				<source src="<?php echo $webmsrc;?>" type="video/webm">
				<source src="<?php echo $mp4src;?>" type="video/mp4">
		</video>
	</div>
	<script>
	
	</script>
	<?php 
	endif;
	echo '</div><!--close vidimg-outer-->';
}