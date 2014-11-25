<?php
/**
 * Class ImageResizer
 * This class is responsible for resizing images to specified dimensions
 * Note: it only scales the images, they are not cropped (yet)
 */
class ImageResizer {

    private function __construct() {
    
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return ImageResizer
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new ImageResizer();
        }
        return $instance;
    }

    /**
     * Resize a specific image to a specified width and height
     * @param $sourceFile the filepath to the file which will be resized
     * @param $newWidth the width of the new image
     * @param $newHeight the height of the new image
     * @return bool|Image returns an image object if succesfull, false otherwise
     */
    public function resizeImage($sourceFile, $newWidth, $newHeight) {
        $sourceFilePath = 'image/' . $sourceFile;
        if(file_exists($sourceFilePath)) {

            // Create an image object from the source image
            $sourceImage = new Image($sourceFilePath);

            // Create the destination image
            $destImage = new Image($sourceFile, $newWidth, $newHeight);

            // Create the new image from the source using the specified width and height
            $tempResource = $destImage->getResource();
            imagecopyresampled($tempResource, $sourceImage->getResource(), 0, 0, 0, 0, $destImage->getWidth(),
                $destImage->getHeight(), $sourceImage->getWidth(), $sourceImage->getHeight());
            $destImage->setResource($tempResource);

            // Save the image
            $newFilePath = 'image/cache/' . $destImage->getFilePath();
            if($destImage->save($newFilePath)) {

                // Return saved image if successfully saved
                return $destImage;
            }
            else {

                // Return false when saving went wrong
                return false;
            }

        }
        else {
            Logger::getInstance()->writeMessage('Could not find image: ' . $sourceFile . ' in ' . $sourceFilePath);
            return false;
        }
    }
}
?>