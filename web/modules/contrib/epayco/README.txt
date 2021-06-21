CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
---------------
ePayco is a Colombian payment gateway. This module is an aim to
integrate the ePayco features with Drupal.


REQUIREMENTS
---------------
This module requires:

 * Composer (for installation and library downloading).
 * Drupal core >=8.7.7
 * ePayco PHP library.

Optional:

 * Drupal Commerce (https://www.drupal.org/project/commerce).
 * Business Rules (https://www.drupal.org/project/business_rules).

INSTALLATION
---------------
Just open a command-line tool (bash for most UNIX-Like OS), and go
to the project root folder. Execute following command:

 composer require 'drupal/epayco'

Then, just go to admin/modules, and enable module as usual.


CONFIGURATION
---------------
Once module is installed:

 * Go to /admin/config/services/epayco/factory, and add there a
   new entity. Fill there all needed values according to your ePayco dashboard.

 * Optional: If sub-module "Commerce ePayco" is enabled, and you want to add a
   payment gateway, go to /admin/commerce/config/payment-gateways (as usual)
   and add a "ePayco (Standard checkout)" or "ePayco (One page checkout)"
   payment gateway. For field "Factory", just choose the entity you created
   in previous step.

 * Optional: Go to admin/people/permissions, and enable some roles to allow
   overriding some ePayco settings at their own store pages, or managing
   configuration entities.


MAINTAINERS
-----------

 * Fernando Muñoz (waspper) - https://www.drupal.org/u/waspper
