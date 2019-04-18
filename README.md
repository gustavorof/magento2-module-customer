# Magento 2 projectc
Magento 2 project created for Youwe. The proposal of this application is to show development of some magento 2 modules.

In this projects, there are three modules:

* Company
* Customer
* Slider

## Getting Started

This is a Magento community 2.3.1 project and for that is recommended a environment prepared to run Magento 2. I really recommend to use docker.

### Requirements



```
PHP 7
Magento Communit 2.3.1
Docker (Optional)
```

### Installing

Clone this repository. use master branch

```
git clone git@github.com:gustavorof/magento2-module-customer.git
git checkout master
```

Install all dependencies with composer

```
composer install
```

Run Magento commands
```
bin/magento setup:upgrade or bin/magento setup:install (all parameters needed).
bin/magento setup:di:compile
```

## Running the tests

To Run unit tests of project,you can run this command at root directory. Unit test are very important to make sure your code has the expected result. A code that has a good coverage is more reliable.

```
vendor/bin/phpunit
```

## Built With

* [Magento 2.3.1](https://github.com/magento/magento2) - Magento 2 Platform

## Author

* **Gustavo Francisco** - *Fullstack developer* - [Profile on Github](https://github.com/gustavorof)

## License

This project was made for Youwe assessment development.

## Acknowledgments

* PHP 7
* PHPUnit
* Composer
* Magento 2

## Additional Information

This Magento project contains three modules that I'm working by myself and I had to make some changes for this proposal. I couldn't finish them completly but I think you can have a good idea of my knowledges with Magento 2.

But, if this is not enough, I can send you some zip files with modules that I've worked and I cannot share repository.