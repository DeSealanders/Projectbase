<?php

/**
 * Class Canvas
 * This class represents a canvas in a generated form
 */
class Canvas extends FormComponent{

    private $options;
    private $selected;

    public function __construct($label, $id, $options = array(), $selected = false, $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
        $this->selected = $selected;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<canvas width="300px" height="300" id="' . $this->id . '"></canvas>';
        echo '</div>';
        echo '</div>';
        $this->printJs();
    }

    private function printJs() {
        ?>
        <script>
        var canvas = $("canvas#<?php echo $this->id; ?>");
        var context = canvas.get(0).getContext("2d");
        context.font = "14px Lato sans-serif";
        <?php
        foreach($this->options as $item => $position) {
            if($item == $this->selected) {
                echo 'context.fillStyle = "red";';
                echo 'context.strokeStyle = "red";';
            }
            else {
                echo 'context.fillStyle = "black";';
                echo 'context.strokeStyle = "black";';
            }
            echo 'context.strokeRect(' . $position['x'] . '+1, ' . $position['y'] . '+1, 98, 98);';
            echo 'context.fillText("' . $item . '", ' . $position['x'] . '+20, ' . $position['y'] . '+50);';

        }
        ?>
        </script>
        <?php
    }
} 