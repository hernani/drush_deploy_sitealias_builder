<?php
  /**
   * This file lists the different site aliases defined and can expose them to
   * Jenkins via a url.
   * In Jenkins the following plugin can be used to use the output of this script as
   * a parameter: https://wiki.jenkins-ci.org/display/JENKINS/Extended+Choice+Parameter+plugin
   */

  /**
   * Auxiliary function to check end of string
   */
  function _endsWith($haystack,$needle,$case=true) {
    if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
    return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
  }

  /**
   * Auxiliary function to load all aliases files
   */
  function _loadAliasesFiles($dir) {

    $aliases_files = $installed_sites = $all_aliases = array();

    // load all files of a directory
    foreach (new DirectoryIterator($dir) as $file) {
      if ($file->isFile()) {
          $file_name = $file->getFileName();
          if (_endsWith($file_name, '.aliases.drushrc.php')) {
            $aliases_files[] = $file_name;
          }
      }
    }

    // loop through the found files
    if (!empty($aliases_files)) {
      foreach ($aliases_files as $alias_file) {
        // get the name of the site
        $pos = strpos($alias_file,'.aliases.drushrc.php');
        $site_name = substr($alias_file,0, $pos);
        $installed_sites[$site_name] = $alias_file;
        include ($dir . '/' . $alias_file);

        // loop through the aliases
        foreach ($aliases as $key => $value) {
          $key_parts = explode(".", $key);

          // we can't sync main sites without a valid node (web1 for instance)
          if (!isset($key_parts[1])) {
            continue;
          }

          // haven't passed by this site
          if (isset($key_parts[1]) && $key_parts[1] == $value['remote-host']
              && !isset($alias_already_set[$site_name . '.' . $key_parts[0]])) {
            $alias_already_set[$site_name . '.'. $key_parts[0]] = $key;
          }
          else if ($key_parts[1] == $value['remote-host']) {
            continue;
          }

          $all_aliases[$site_name][$key] = $value;
        }
      }
    }

    return $all_aliases;
  }

  // load files
  $installed_sites = _loadAliasesFiles('/etc/drush');

  // with multisites and all environments
  if (isset($_GET['mode']) && $_GET['mode'] == 'full') {
    foreach ($installed_sites as $project => $sites) {
      foreach ($sites as $key => $value) {
        $installed_sites_with_multisites[$project . '.' . $key] = $value;
      }
    }

    ksort($installed_sites_with_multisites);
    $installed_sites = $installed_sites_with_multisites;
  }


  // TODO
  if (isset($_GET['display']) && $_GET['display'] == 'web') {
    if (!empty($installed_sites)) {
      print "sites=";
      print "\n";
    }
  }
  else {
    // print them
    if (!empty($installed_sites)) {
      print "sites=";
      print implode(',', array_keys($installed_sites));
      print "\n";
    }
  }

