<?php
/**
 * Class ImageLoader
 * This class is responsible for loading specified images in certain dimensions
 * It will use cached images if available, otherwise the images will be loaded via the ImageResizer class
 */
class ImageLoader extends Singleton {

    protected function __construct() {
    
    }

    /**
     * Load an image path in specific dimensions
     * @param $fileName the path to the image which should be loaded
     * @param $width the desired width of the image
     * @param $height the desired height of the image
     */
    public function loadImage($fileName, $width, $height) {

        // First try loading the image from cache
        if(!$image = CacheLoader::getInstance()->loadImage($fileName, $width, $height)) {

            // Load image from imageresizer if cache isn't available
            $image = ImageResizer::getInstance()->resizeImage($fileName, $width, $height);
        }

        // Display image on the page
        $this->displayImageResource($image);
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