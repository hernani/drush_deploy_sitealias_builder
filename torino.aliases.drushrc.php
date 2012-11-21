<?php

  require "/etc/drush/deploy_environments_farm1.inc";
  require_once "/etc/drush/sitealias-builder.php";

  $deploy_sitename = "torino";
  $deploy_repository = "git@github.com:hernani/deploytest.git";
  $deploy_options['multisites'] = array('biblioteca', 'alumni');
  $deploy_options['after']['deploy-symlink'][] = 'my_custom_task';

  $aliases = deploy_create_aliases ($deploy_sitename, $deploy_repository, $deploy_environments, $deploy_options);

  function my_custom_task($d) {
    $d->run("ln -s /shared/preprod2/unisi %s/sites/default/files", $d->latest_release());
//  $d->run("ln -s /shared/preprod2/unisi %s/sites/default/files", $d->latest_release());
  }
