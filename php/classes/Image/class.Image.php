<?php
/**
 * Class Image
 * This class is responsible for managing the options attached to an image like its dimensions, its extension
 * In addition it is also able to manage the resource for this image (be it from scratch or a source file)
 */
class Image {

    private $width;
    private $height;
    private $resource;
    private $extension;
    private $filePath;

    /**
     * The image can be instantiated in two ways:
     * 1. By specifying a source file and leaving the width and height blank
     * 2. By specifying dimensions and a desired filepath
     * When a source file is given it will be used to create a resource
     * When dimensions are given a blank resource is created
     * @param bool $filePath the path to the source file (false if none provided)
     * @param bool $width the desired width of the blank resource (false if source image is provided)
     * @param bool $height the desired height of the blank resource (false if source image is provided)
     */
    public function __construct($filePath = false, $width = false, $height = false) {

        // Create a blank resource
        if($width && $height) {

            // Format a new imagename like demo200x200.jpg
            $fileInfo = pathinfo($filePath);
            $this->filePath = $fileInfo['filename'] . '_' . $width . 'x' . $height . '.' . $fileInfo['extension'];

            // Create a blank resource
            $image = $this->createImageFromDimensions($width, $height, strtolower($fileInfo['extension']));
        }

        // Create a resource from the source file
        else {
            $this->filePath = $filePath;
            $image = $this->createImageFromPath($filePath);
        }


        // Set all values from the retrieved image
        $this->resource = $image['resource'];
        $this->width = $image['width'];
        $this->height = $image['height'];
        $this->extension = $image['extension'];
    }

    /**
     * Save an image resource to the server (for later use)
     * @param $filePath the path to store the image in
     * @return bool true if successfull, false otherwise
     */
    public function save($filePath) {
        $quality = 100;

        // jpg or jpeg images
        if($this->extension == 'jpg' || $this->extension == 'jpeg') {
            return imagejpeg($this->getResource(), $filePath, $quality);
        }

        // png images
        else if ($this->extension == 'png') {
            return imagepng($this->getResource(), $filePath, $quality*0.09);
        }

        // gif images
        else if($this->extension == 'gif') {
            return imagegif($this->getResource(), $filePath, $quality);
        }

        // Return false if no valid extension is found
        return false;
    }

    /**
     * Return the current resource attached to this image
     * @return mixed an image resource
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * Getter for image width
     * @return mixed the width of the image (in pixels)
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * Getter for image height
     * @return mixed the height of the image (in pixels)
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Getter for image extension (jpg/jpeg, png or gif)
     * @return mixed the extension of the image
     */
    public function getExtension() {
        return $this->extension;
    }

    /**
     * Setter for the image resource
     * @param $resource the resource to be linked to this image
     */
    public function setResource($resource) {
        $this->resource = $resource;
    }

    /**
     * Getter for the filepath to the iamge
     * @return string filepath to the image
     */
    public function getFilePath() {
        return $this->filePath;
    }

    /**
     * Create a blank resource from a specified width, height and extension
     * @param $width the desired width of the blank resource
     * @param $height the desired height of the blank resource
     * @param $extension the desired extension of the blank resource
     * @return array an array with all the resource its options
     */
    private function createImageFromDimensions($width, $height, $extension) {
        return array(
            'resource' => imagecreatetruecolor($width, $height),
            'width' => $width,
            'height' => $height,
            'extension' => $extension
        );
    }

    /**
     * Create a list of image options along with its resource
     * @param $filePath the path of the source file
     * @return array an array with all the resource its options
     */
    private function createImageFromPath($filePath) {
        // Check if file exists
        if(file_exists($filePath)) {

            // Retrieve and store image details
            $imageDetails = getimagesize($filePath);
            if(count($imageDetails) > 0) {

                // Retrieve extension in lowercase
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                // Return the details for the source image
                return array(
                    'resource' => $this->createResource($filePath, $extension),
                    'width' => $imageDetails[0],
                    'height' => $imageDetails[1],
                    'extension' => $extension
                );
            }
        }
        else {
            Logger::getInstance()->writeMessage('No valid file given: ' . $filePath);
        }
    }

    /**
     * Create a resource from a specified image
     * @param $filePath the path of the source file
     * @param $extension the extension of the source file
     * @return bool|resource return a resource if successfull, false otherwise
     */
    private function createResource($filePath, $extension) {

        // jpg or jpeg images
        if($extension == 'jpg' || $this->extension == 'jpeg') {
            return imagecreatefromjpeg($filePath);
        }

        // png images
        else if ($extension == 'png') {
            return imagecreatefrompng($filePath);
        }

        // gif images
        else if($extension == 'gif') {
            return imagecreatefromgif($filePath);
        }
        else {
            Logger::getInstance()->writeMessage('Specified image is not a valid jpg, png or gif image');
            return false;
        }
    }
} 