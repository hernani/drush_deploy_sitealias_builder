<?php

function deploy_create_aliases ($deploy_sitename, $deploy_repository, $deploy_environments, $deploy_multisites) {
	
    if (empty($deploy_environments)) 
      return array();

    foreach ($deploy_environments as $env_key => $environment) {
      foreach ($environment['servers'] as $server => $server_env) {
     
        $aliases[$env_key . '.'. $server] = array(
          'root' => $server_env['deploy-to'] . '/' . $env_key . '/' . $deploy_sitename . '/current',
          'remote-user' => 'vagrant',
	  'deploy-env-tag' => $env_key,
          'remote-host' => $server,
          'command-specific' => array(
            'deploy' => array(
               'application' => $deploy_sitename . $env_key,
               'deploy-repository' => $deploy_repository,
               'branch' => 'master',
               'keep-releases' => $server_env['branch'],
	       'deploy-via' => 'RemoteCache',
               'deploy-to' => $server_env['deploy-to'] . '/' . $env_key . '/' . $deploy_sitename,
             )
          )
       );
          
        $aliases[$env_key]['site-list'][] = '@'. $deploy_sitename. "." . $env_key . "." . $server;
          
      }
    }
      

    /* support to multisites */
    if (!empty($deploy_multisites)) {
      foreach ($deploy_multisites as $multisite) {
        foreach ($aliases as $alias_env => $alias) {
          if (!empty($alias['deploy-env-tag'])) {
            $alias['uri'] = $multisite;
            $aliases [$alias['deploy-env-tag'] . '.' . $multisite] = $alias;
          }
        }
      }
    }

	  return $aliases;
}
