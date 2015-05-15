<?php

function resizeimage($file,$imageDir) {
	$userfile_name = $file['name'];

	if(!isset($file['tmp_name']) || $file['tmp_name'] == '') {

	}
	if(copy($file['tmp_name'],"$imageDir/". $file['name']))
	{
		/*
		 * let's start by identifying the image type. No doubt the more efficient way
		 * is to use string functions but who cares?
		 */

		$parts = split("\.",$file['name']);
		$ext = $parts[count($parts)-1];

		$thumb_name = array_slice($parts,0,count($parts)-1);

		$ext = strtolower($ext);
		switch($ext)
		{
			case "jpg";
			   /*
				* sometimes we may find that the image already contains  an
				* embedded thumbnail. Then we simply extract that.
				*/
				$thumb_data = exif_thumbnail("$imageDir/". $file['name']);
				$thumb_name = join(".",$thumb_name) .  ".jpg";
				if($thumb_data)
				{
					$fp = fopen("$imageDir/thumb/$thumb_name","wb");
					fputs($fp,$thumb_data);
				}
				else
				{
				   /*
					* tough luck here comes work.
					*/
					$src_img=ImageCreateFromJpeg("$imageDir/$userfile_name");
				}
				break;

			case "gif":
				$src_img=ImageCreateFromGif("$imageDir/$userfile_name");
				$thumb_name = join(".",$thumb_name) .  ".gif";
				break;

			case "png":
				$thumb_name = join(".",$thumb_name) .  ".png";
				$src_img=ImageCreateFromPng("$imageDir/$userfile_name");
				break;

		}

		/* get it's height and width */
		$imgSx = imagesx($src_img);
		$imgSy = imagesy($src_img);

		if($imgSy != 0)
		{
			/*
			* lets calculate the aspect ratio and the height
			* and width for the scaled image.
			*/

			$ratio = $imgSx/$imgSy;
			if($ratio > 1)
			{

				$new_imgSx = 55;
				$new_imgSy = 55/$ratio;
			}
			else
			{

				$new_imgSx = (float) 55 * $ratio;
				$new_imgSy = 55;

			}

			$dst_img=imagecreatetruecolor($new_imgSx,$new_imgSy);

			/* create the scaled instance */
			ImageCopyResampled($dst_img,$src_img,0,0,0,0,$new_imgSx,$new_imgSy,$imgSx,$imgSy);

			/* write the damned thing to disk */
			if($ext == "jpg" || $ext == "gif")
			{
				imageJpeg($dst_img,"$imageDir/thumb/$thumb_name");
			}
			else
			{
				imagePng($dst_img,"$imageDir/thumb/$thumb_name");
			}
		}

/*		chdir("$imageDir/");
		if(strtolower($file['type']) == "gif")
			rename($userfile_name.".jpg");
		chdir("/var/www/html/tahitizik/admin");
	*/
	}
	else {
		echo "Unable to upload image";
	}
}
?>
