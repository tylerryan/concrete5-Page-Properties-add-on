<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
echo $controller->getOpenTag();
echo $controller->getTitle();
echo $controller->getContent();
echo $controller->getCloseTag();
?>