<?php

  $deploy_environments['prod'] = array(
    'servers' => array('web1', 'web2'),
    'user' => 'vagrant',
    'deploy-to' => '/var/www/drupal',
    'root' => '/var/www/drupal/%deploy_sitename/current/docroot',
    'branch' => 'master'
  );

  $deploy_environments['dev'] = array(
    'servers' => array('web1'),
    'branch' => 'master',
    'user' => 'vagrant',
    'deploy-to' => '/var/www/drupal',
    'root' => '/var/www/drupal/%deploy_sitename/current/docroot',
  );
