<?php

/**
 * @file
 *   This file contains extra functions needed for deployment process
 *  (e.g.: functions to run after deployment to symlink settings and files)
 */

function my_custom_task($d) {
    $env = $d->sites[0]['deploy-env-tag'];
    $d->run("ln -s /shared/" . $env . "/unisi %s/docroot/sites/default/files", $d->latest_release());
//  $d->run("ln -s /shared/preprod2/unisi %s/sites/default/files", $d->latest_release());
}
