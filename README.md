[![PHKAPA](http://phkapa.phalkaline.eu/images/phkapa_logo.png)](http://phkapa.phalkaline.eu)


**PHKAPA** , this software allows you to generate a action (CAPA) request that routes through register, review, plan ( root cause , action plan) , and verification stages. 
This tracking software provides an effective mechanism for determinate the source and costs of problems. for PHP, released under [MIT License]

Official website**: [http://phkapa.phalkaline.eu](http://phkapa.phalkaline.eu)

WIKI website**: [http://phkapa.phalkaline.eu/wiki](http://phkapa.phalkaline.eu/wiki)

It is powered by [CakePHP](http://cakephp.org) MVC framework.


## Requirements
  * Apache 2 with `mod_rewrite` or similar
  * PHP 5.2 or higher
  * MySQL 5 or higher

## Git submodules install ( cakephp and dompdf )


cd /var/www/yourapp/

git submodule add https://github.com/cakephp/cakephp.git lib/cakephp

git add .gitmodules


git submodule add https://github.com/dompdf/dompdf.git vendors/dompdf

git add .gitmodules


cd vendors/dompdf

git submodule init

git submodule update
