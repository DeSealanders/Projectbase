<?php
/**
 * Class ImageResizer
 * This class is responsible for resizing images to specified dimensions
 * Note: it only scales the images, they are not cropped (yet)
 */
class ImageResizer extends Singleton {

    protected function __construct() {
    
    }

    /**
     * Resize a specific image to a specified width and height
     * @param $fileName the filepath to the file which will be resized
     * @param $newWidth the width of the new image
     * @param $newHeight the height of the new image
     * @param bool $crop wether or not a image should be cropped
     * @return bool|Image returns an image object if succesfull, false otherwise
     */
    public function resizeImage($fileName, $newWidth, $newHeight, $crop = true) {
        if(file_exists('image/' . $fileName)) {

            // Create an image object from the source image
            $sourceImage = new Image($fileName, 'image/');

            // Do not allow image enlarging
            if($newWidth > $sourceImage->getWidth()) {
                $newWidth = $sourceImage->getWidth();
            }
            if($newHeight > $sourceImage->getHeight()) {
                $newHeight = $sourceImage->getHeight();
            }

            // Create the destination image
            $destImage = new Image($fileName, 'image/cache/', $newWidth, $newHeight);

            // Create the new image from the source using the specified width and height
            $tempResource = $destImage->getResource();

            // Crop the image if nessecary
            if($crop) {
                $cropValues = $this->calcCropValues($sourceImage, $destImage);
                //var_dump($cropValues);
                imagecopyresampled($tempResource, $sourceImage->getResource(), 0, 0,
                    $cropValues['topleftX'], $cropValues['topleftY'],
                    $destImage->getWidth(), $destImage->getHeight(),
                    $cropValues['sourceWidth'], $cropValues['sourceHeight']);
                $destImage->setResource($tempResource);
            }

            // Distort aspect ratio to force dimensions
            else {
                imagecopyresampled($tempResource, $sourceImage->getResource(), 0, 0, 0, 0, $destImage->getWidth(),
                    $destImage->getHeight(), $sourceImage->getWidth(), $sourceImage->getHeight());
                    $destImage->setResource($tempResource);
            }

            // Save the image
            $cacheFilePath = 'image/cache/' . $destImage->getFileName();
            if($destImage->save($cacheFilePath)) {

                // Return saved image if successfully saved
                return $destImage;
            }
            else {

                // Return false when saving went wrong
                return false;
            }

        }
        else {
            Logger::getInstance()->writeMessage('Could not find image: ' . $fileName . ' in image/' . $fileName);
            return false;
        }
    }

    /**
     * Calculate the right values to crop an image whilist keeping the aspect ratio
     * @param $sourceImage the image with its original dimensions
     * @param $destImage the image with its desired dimensions
     * @return array|bool a list of values used for cropped the image, false otherwise
     */
    private function calcCropValues($sourceImage, $destImage) {
        $widthRatio = $destImage->getWidth() / $sourceImage->getWidth();
        $heightRatio = $destImage->getHeight() / $sourceImage->getHeight();
        if($widthRatio == $heightRatio) {

            // Same scale so only scale back
            return array(
                'topleftX' => 0,
                'topleftY' => 0,
                'sourceWidth' => $sourceImage->getWidth(),
                'sourceHeight' => $sourceImage->getHeight()
            );

        }
        else if($widthRatio > $heightRatio) {

            // Cut some off the height of the image
            $heightCut = (($sourceImage->getHeight() * $widthRatio) - $destImage->getHeight())/$widthRatio;
            return array(
                'topleftX' => 0,
                'topleftY' => (int)($heightCut/2),
                'sourceWidth' => $sourceImage->getWidth(),
                'sourceHeight' => (int)($sourceImage->getHeight() - $heightCut)
            );
        }
        else if($heightRatio > $widthRatio) {

            // Cut some off the width of the image
            $widthCut = (($sourceImage->getWidth() * $heightRatio) - $destImage->getWidth())/$heightRatio;
            return array(
                'topleftX' => (int)($widthCut/2),
                'topleftY' => 0,
                'sourceWidth' => (int)($sourceImage->getWidth() - $widthCut),
                'sourceHeight' => $sourceImage->getHeight()
            );
        }
        else {
            return false;
        }
    }


}
?>