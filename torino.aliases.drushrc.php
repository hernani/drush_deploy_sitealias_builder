<?php

  require "/etc/drush/deploy_environments_farm1.inc";
  require_once "/etc/drush/sitealias-builder.php";  
        
  $deploy_sitename = "torino";
  $deploy_repository = "git@github.com:hernani/deploytest.git";
  $deploy_multisites = array('biblioteca', 'alumni');

  $aliases = deploy_create_aliases ($deploy_sitename, $deploy_repository, $deploy_environments, $deploy_multisites);
