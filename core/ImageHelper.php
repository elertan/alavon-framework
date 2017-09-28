<?php
class ImageHelper {
	public const DEFAULT_IMAGE_COMPRESSION_QUALITY = 35;

	public function compress($source, $destination, $quality = self::DEFAULT_IMAGE_COMPRESSION_QUALITY) {
		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
		    $image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif') 
		    $image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
		    $image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}
}
