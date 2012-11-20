<?php

  $deploy_environments['prod'] = array(
    'servers' => array('web1', 'web2'),
    'branch' => 'master',
    'user' => 'vagrant'
  );

  $deploy_environments['dev'] = array(
    'servers' => array('web1'),
    'branch' => 'master',
    'user' => 'vagrant'
  );
