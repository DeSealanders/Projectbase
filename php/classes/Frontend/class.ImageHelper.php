<?php
/**
 * Class ImageHelper
 *
 */
class ImageHelper extends Singleton
{

    protected  function __construct()
    {

    }

    /**
     * Print the html for a specified image
     * It will use a lightbox if it is enabled in the conf.includes.php
     * @param $file the image file which will be printed
     * @param bool $thumb the thumbnail image file if prefered (false means no thumbnail)
     * @param string $caption a optional caption attached to the image
     * @param bool $group the lightbox group for the image (when more images will be grouped in a gallery)
     */
    public function printImage($file, $thumb = false, $caption = '', $group = false) {

        // Use lightbox if enabled
        if(IncludesConfig::getInstance()->isEnabled('lightbox')) {
            echo '<div class="image">';
            echo '<figure>';
            echo '<a href="' . $file . '"';

            // If group is specified
            if($group) {
                echo 'data-lightbox="' . $group . '"';
            }

            // Otherwise group on filename
            else {
                echo 'data-lightbox="' . $file . '"';
            }
            echo 'data-title="' . $caption . '">';

            // With a thumbnail
            if($thumb) {
                echo '<img class="img-thumbnail thumbnail" src="' . $thumb . '">';
            }

            // Without a thumbnail
            else {
                echo '<img class="img-thumbnail" src="' . $file . '">';
            }
            echo '</a>';
            echo '<figcaption><p>' . $caption . '</p></figcaption>';
            echo '</figure>';
            echo '</div>';
        }

        // Otherwise standard image when lightbox is disabled
        else {
            echo '<div class="image">';

            // With a thumbnail
            if($thumb) {
                echo '<a target="_blank" href=' . $file . '>';
                echo '<figure><img class="thumbnail" src="' . $thumb . '"/>';
                echo '</a>';
            }

            // Without a thumbnail
            else {
                echo '<a target="_blank" href=' . $file . '>';
                echo '<figure><img src="' . $file . '"/>';
                echo '</a>';
            }
            echo '<figcaption><p>' . $caption . '</p></figcaption>';
            echo ' </figure></div>';
        }
    }


} 