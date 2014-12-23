<?php

class ModuleRouter extends Singleton{

    private $moduleDetails;

    protected function __construct() {

    }

    public function route($route) {
        // Set the moduledetails so it can be used in the wrapper page
        $this->moduleDetails = $route->getModuleDetails();
        $this->checkPostActions($this->moduleDetails, $_POST);
        $this->checkActions($this->moduleDetails);
        $wrapperPage = 'php/pages/default/module_wrapper.php';
        require($wrapperPage);
    }

    private function checkPostActions($moduleDetails, $post) {

        if(!empty($post) && isset($post['button'])) {

            if($post['button'] == 'close') {
                header('location: /projectbase/module/' . $moduleDetails['module']);
                die('redirecting');
            }

            // Save module data if specified
            else if($post['button'] == 'save') {
                ModuleManager::getInstance()->saveItem($moduleDetails['module'], $moduleDetails['itemid']);
            }

            else if($post['button'] == 'saveclose') {
                ModuleManager::getInstance()->saveItem($moduleDetails['module'], $moduleDetails['itemid']);
                header('location: /projectbase/module/' . $moduleDetails['module']);
                die('redirecting');
            }
        }
    }

    private function checkActions($moduleDetails) {

        if(isset($moduleDetails['action'])) {

            // Create a new entry and redirect to single view
            if($moduleDetails['action'] == 'new') {
                $itemId = ModuleManager::getInstance()->newItem($moduleDetails['module']);
                header('location: /projectbase/module/' . $moduleDetails['module'] . '/' . $itemId);
                die('redirecting');
            }

            // Delete specified entry and redirect to multi view
            else if($moduleDetails['action'] == 'delete' && isset($moduleDetails['itemid'])) {
                ModuleManager::getInstance()->deleteItem($moduleDetails['module'], $moduleDetails['itemid']);
                header('location: /projectbase/module/' . $moduleDetails['module']);
                die('redirecting');
            }
        }
    }

    private function loadView($moduleDetails) {

        if(isset($moduleDetails['view'])) {
            if($moduleDetails['view'] == 'overview') {
                require('/php/pages/default/backend.php');
            }


            // Load the module (including data) specified by the router
            else if(isset($moduleDetails['module'])) {
                ModuleManager::getInstance()->loadModule($moduleDetails['module']);

                // Get the loaded module if everything went correctly
                if($module = ModuleManager::getInstance()->getModule($moduleDetails['module'])) {

                    // Load the correct layout file
                    if($moduleDetails['view'] == 'multi') {
                        if(!$module->isAllowedDelete() && !$module->isAllowedNew() && $module->isAllowedEdit() && $record = $module->getSingleRecord()) {
                            //echo $module->printBackendHtml('single', $record['itemid']);
                            header('location: /projectbase/module/' . $moduleDetails['module'] . '/' . $record['itemid']);
                        }
                        else {
                            $module->printBackendHtml('multi');
                        }
                    }
                    else if($moduleDetails['view'] == 'single') {
                        $module->printBackendHtml('single', $moduleDetails['itemid']);
                    }
                }
                else {
                    Logger::getInstance()->writeMessage('Could not load module: ' . $module);
                }
            }
        }
    }

    private function getTitle() {
        if(isset($this->moduleDetails['module']))
        {
            $title = ucfirst($this->moduleDetails['module']);
        }
        else if(isset($this->moduleDetails['view']) && $this->moduleDetails['view'] == 'overview') {
            $title = 'Overview';
        }
        return $title;
    }

    private function isActiveMenuItem($menuItem) {
        if(isset($this->moduleDetails['module'])) {
            return $this->moduleDetails['module'] == $menuItem;
        }
        else if(isset($this->moduleDetails['view'])) {
            return $menuItem == 'overview';
        }
    }


} 