<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('custom', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
