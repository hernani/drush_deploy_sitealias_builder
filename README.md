drush_deploy_sitealias_builder
==============================

A repository with example files showing how to manage sites in different environments using drush deploy and site aliases
This example configuration enables developers to automatically configure group site aliases that represent sites in different environments. Using drush deploy code can be grabbed from one code repository and deployed to the different nodes of a specified environment (dev, staging and production)

Usage
--------
In order to this strategy to work it is needed that Drush is configured in all the web nodes. We will define in a central server, site aliases for each of the sites we are deploying. Sitealias-builder does the magic behind creating these aliases for the three different environments. Each site have a configuration file where code repository location and site name are defined. Please refer to torino.aliases.drushrc.php to understand how to create sitenames in the platform.

Each site will be deployed to a defined set of servers (farm). Each site configuration file should include the list of servers for the different enviroments. Please refer to deploy_environments_farm1.inc to understand how to define these farms.

Install
--------
Copy deploy_environments_farm1.inc, sitealias-builder.php, torino.aliases.drushrc.php to a drush configuration directory (/etc/drush) and adapt them accordingly.

When issuing 
$drush sa

You should receive the site aliases defined for your site in the different environments:
@torino
@torino.dev
@torino.dev.alumni
@torino.dev.biblioteca
@torino.dev.web1
@torino.prod
@torino.prod.alumni
@torino.prod.biblioteca
@torino.prod.web1
@torino.prod.web2

To test deploying a site to a defined environment you can use drush deploy. Use the verbose flag to understand the actions from drush deploy.
$ drush deploy @torino.prod
