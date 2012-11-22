<?php

/**
 * @file
 *   This file contains extra functions needed for deployment process
 *  (e.g.: functions to run after deployment to symlink settings and files)
 */

function my_custom_task($d) {
    $env = $d->sites[0]['deploy-env-tag'];
    $site = $d->sites[0]["#group"];
    $d->run("ln -s /shared/" . $env . "/" . $site . " %s/docroot/sites/default/files", $d->latest_release());
 }
