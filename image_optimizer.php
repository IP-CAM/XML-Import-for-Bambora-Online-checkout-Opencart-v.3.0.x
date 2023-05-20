<?php
function optimize_image($imageUrl, $imagePath, $maxFileSizeKB = 300)
{
    $imageContent = file_get_contents($imageUrl);
    $fileSizeKB = strlen($imageContent) / 1024;

    if ($fileSizeKB > $maxFileSizeKB) {
        $sourceImage = imagecreatefromstring($imageContent);

        $width = imagesx($sourceImage);
        $height = imagesy($sourceImage);

        $maxSize = 600; // Max width or height
        if ($width > $maxSize || $height > $maxSize) {
            // Calculate new size
            if ($width > $height) {
                $newWidth = $maxSize;
                $newHeight = round($height * ($maxSize / $width));
            } else {
                $newHeight = $maxSize;
                $newWidth = round($width * ($maxSize / $height));
            }

            // Create a new, resized image
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save the new image
            switch (pathinfo($imageUrl, PATHINFO_EXTENSION)) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($newImage, DIR_IMAGE . $imagePath, 77); // 85 is quality
                    break;
                case 'png':
                    imagepng($newImage, DIR_IMAGE . $imagePath, 8); // 8 is compression level
                    break;
                case 'gif':
                    imagegif($newImage, DIR_IMAGE . $imagePath);
                    break;
            }
        } else {
            // If image is smaller than max size, save it as it is
            file_put_contents(DIR_IMAGE . $imagePath, $imageContent);
        }
    } else {
        // If image is smaller than max size in MB, save it as it is
        file_put_contents(DIR_IMAGE . $imagePath, $imageContent);
    }
}
