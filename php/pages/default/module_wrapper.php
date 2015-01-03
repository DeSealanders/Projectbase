<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<?php
// Print all css and js includes
IncludeLoader::getInstance()->printIncludes();
?>
<?php
echo '<title>' . $this->getTitle() . '</title>';
?>
</head>
<body>
<div class="backend">
    <div class="menu">
        <ul>
        <?php
        // Show the menu
        $menuList = array('overview');
        $menuList = array_merge($menuList, ModuleManager::getInstance()->getModuleList());
        foreach($menuList as $menuItem) {
            $class = '';
            if($this->isActiveMenuItem($menuItem)) {
                $class .= 'active';
            }
            if($menuItem == 'overview') {
                $class .= ' overview';
                $link = '/projectbase/module';
                $text = '<i class="fa fa-fw fa-home"></i><span>' . ucfirst($menuItem) . '</span>';
            }
            else {
                $link = '/projectbase/module/' . $menuItem;
                $text = ucfirst($menuItem);
                $class .= ' padded';
            }
            echo '<li class="' . $class . '"><a href="' . $link . '">' . $text . '</a></li>';
        }
        ?>
        </ul>

        <span class="user">
            <?php
            if($user = UserManager::getInstance()->getCurrentUser()) {
                echo '<span class="fa fa-fw fa-user"></span><span>' .  ucfirst($user->getUsername()) . '</span><span> <a href="/projectbase/logout">(Logout)</a></span>';
            }
            else {
                echo 'wtf?';
            }
            ?>
        </span>
    </div>
    <div class="container">
        <?php

        $this->loadView($this->moduleDetails);

        ?>
    </div>
</div>
</body>
</html>