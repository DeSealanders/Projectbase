<?php
/**
 * Class ImageLoader
 * This class is responsible for loading specified images in certain dimensions
 * It will use cached images if available, otherwise the images will be loaded via the ImageResizer class
 */
class ImageLoader {

    private function __construct() {
    
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return ImageLoader
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new ImageLoader();
        }
        return $instance;
    }

    /**
     * Load an image path in specific dimensions
     * @param $imagePath the path to the image which should be loaded
     * @param $width the desired width of the image
     * @param $height the desired height of the image
     */
    public function loadImage($imagePath, $width, $height) {

        // First try loading the image from cache
        if(!$image = $this->isCached($imagePath, $width, $height)) {

            // Load image from imageresizer if cache isn't available
            $image = ImageResizer::getInstance()->resizeImage($imagePath, $width, $height);
        }

        // Display image on the page
        $this->displayImageResource($image);
    }

    /**
     * Check if in image is cached in the specified format
     * @param $imagePath the path to the image
     * @param $width the desired width of the image
     * @param $height the desired height of the image
     * @return bool|Image returns an image object if cached, false otherwise
     */
    private function isCached($imagePath, $width, $height) {
        $fileInfo = pathinfo($imagePath);
        $cacheFileName = $fileInfo['filename'] . '_' . $width . 'x' . $height . '.' . $fileInfo['extension'];
        $cachePath = 'image/cache/' . $cacheFileName;
        if(file_exists($cachePath)) {
            return new Image($cachePath);
        }
        else {
            return false;
        }
    }

    /**
     * Display an image resource
     * @param $image the image object to show
     */
    private function displayImageResource($image) {
        if($image) {
            if($image->getExtension() == 'jpg' || $image->getExtension() == 'jpeg') {
                header('Content-Type: image/jpeg');
                imagejpeg($image->getResource(), null, 100);
            }
            else if($image->getExtension() == 'png') {
                header('Content-Type: image/png');
                imagepng($image->getResource(), null, 9);
            }
            else if($image->getExtension() == 'gif') {
                header('Content-Type: image/gif');
                imagegif($image->getResource(), null, 100);
            }
        }
    }
}
?>