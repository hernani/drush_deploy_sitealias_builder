<?php
/**
  * The task needs to be defined with a @task "decorator" in the comment block preceding it
  * @task
  */
function my_custom_task($d) {
    $env = $d->sites[0]['deploy-env-tag'];
    $site = $d->sites[0]["#group"];
    $d->run("ln -s /shared/" . $env . "/" . $site . "/default" . " %s/docroot/sites/default/files", $d->latest_release());

    if (!empty($d->sites[0]['deploy-options']['multisites'])) {
      foreach ($d->sites[0]['deploy-options']['multisites'] as $multisite) {
        $d->run("ln -s /shared/" . $env . "/" . $site . "/" .  $multisite  . " %s/docroot/sites/" . $multisite . "/files", $d->latest_release());
      }
    }
 }

