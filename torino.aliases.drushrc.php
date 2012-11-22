<?php

  require "/etc/drush/deploy_environments_farm1.inc";
  require_once "/etc/drush/sitealias-builder.php";
  require_once "/etc/drush/sitealias-builder-extra-functions.php";

  $deploy_options = array();
  $deploy_sitename = "torino";
  $deploy_repository = "git@github.com:hernani/deploytest.git";
  $deploy_options['multisites'] = array('biblioteca', 'alumni');
  $deploy_options['after']['deploy-symlink'][] = 'my_custom_task';

  $aliases = deploy_create_aliases ($deploy_sitename, $deploy_repository, $deploy_environments, $deploy_options);


