<?php  

  $deploy_environments['prod'] = array(
    'servers' => array('web1', 'web2'),
    'branch' => 'master'
  );

  $deploy_environments['dev'] = array(
    'servers' => array('web1'),
    'branch' => 'master'
  );
