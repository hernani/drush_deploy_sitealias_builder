<?php  

  $deploy_environments['prod'] = array(
    'servers' => array('web1', 'web2'),
    'deploy-to' => '/var/www/drupal',
    'branch' => 'master'
  );

  $deploy_environments['dev'] = array(
    'servers' => array('web1'),
    'deploy-to' => '/var/www/drupal',
    'branch' => 'master'
  );
