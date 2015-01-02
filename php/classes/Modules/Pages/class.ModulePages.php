<?php

class ModulePages extends Module {

    public function __construct() {
        parent::__construct('Pages');
        $this->setDescription('Manage the pages for the website');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new TextComponent('Description', 'description'));
        $this->addComponent(new MultiDropdownComponent('Contentblocks', 'content',
                array(
                    2 => array(
                        'Projects' =>
                            array(
                                'project1',
                                'project2',
                                'project3'
                            )
                    ),
                    1 => array(
                        'Contact' =>
                            array(
                                4 => 'Peter',
                                6 => 'Jordi'
                            )
                    ),
                    3 => array(
                        'Content' =>
                            array(
                                'Wie',
                                'Wat',
                                'Levering'
                            )
                    )
                )
            ));
    }

} 