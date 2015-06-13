[![PHKAPA](http://phkapa.net/images/phkapa_logo.png)](http://phkapa.net)


**PHKAPA** , Nonconformity management software for quality assurance. Allows to generate action (CAPA) requests that routes through register, review, plan ( root cause , action plan) , and verification stages. It provides effective mechanisms to determinate the source and cost of problems, released under [MIT License]

Official website**: [http://phkapa.net](http://phkapa.net)

WIKI website**: [http://wiki.phkapa.net](http://wiki.phkapa.net)

It is powered by [CakePHP](http://cakephp.org) MVC framework.


## Requirements
  * HTTP Server. For example: Apache. mod_rewrite is preferred, but by no means required
  * PHP 5.2.8 or greater.
  * MySQL 5 or higher
  * All built-in drivers require PDO. You should make sure you have the correct PDO extensions installed.

## With Composer

You can install pHKapa using [Composer](https://getcomposer.org/)

Download Composer or update: 
`composer self-update`

Run:

`php composer.phar create-project -s dev phalkaline/phkapa [phkapa_directory]`

If Composer is installed globally, run:

`composer create-project -s dev phalkaline/phkapa [phkapa_directory]`

and goto http://wiki.phkapa.net/doku.php/install to start using .. .

## With Git and Composer 

Run:

`git clone https://github.com/pHAlkaline/phkapa.git`

`cd [phkapa directory] `

`composer update`

and goto http://wiki.phkapa.net/doku.php/install to start using ...

## With Git

Run:

`git clone https://github.com/pHAlkaline/phkapa.git`

`cd [phkapa directory] `

`git clone -b 2.6.7 http://github.com/cakephp/cakephp.git vendor/cakephp/cakephp`

and goto http://wiki.phkapa.net/doku.php/install to start using ...

