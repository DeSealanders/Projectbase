<?php
/**
 * Class CacheLoader
 * This class is responsible for loading cached images if available
 */
class CacheLoader extends Singleton {

    protected function __construct() {
    
    }

    /**
     * Check if in image is cached in the specified format
     * @param $imagePath the path to the image
     * @param $width the desired width of the image
     * @param $height the desired height of the image
     * @return bool|Image returns an image object if cached, false otherwise
     */
    public function loadImage($imagePath, $width, $height) {
        $fileInfo = pathinfo($imagePath);
        $cacheFileName = $fileInfo['filename'] . '_' . $width . 'x' . $height . '.' . $fileInfo['extension'];
        $cacheFile = $cacheFileName;
        if(file_exists('image/cache/' . $cacheFile)) {
            return new Image($cacheFile, 'image/cache/');
        }
        else {
            return false;
        }
    }
}
?>