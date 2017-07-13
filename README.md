# _Best Restaurant_

#### _PHP Silex & Database Practice, 7.13.2017_

#### By _**Dylan Lewis & Brittany Kerr**_

## Description

_This PHP database exercise allows the user to enter cuisines and within the cuisine category they can add restaurants, thus creating a cuisine list. The user can add a description to the restaurant, search restaurants by cuisine type, modify cuisine name and delete an entire cuisine category._

## Setup Requirements

* Ensure that the following programs are downloaded to your computer:
  * [MAMP](https://www.mamp.info/en/) for Windows or MacOS
  * [PHP](https://secure.php.net/)
  * [Composer](https://getcomposer.org/)
* Sign into github and copy repository: https://github.com/kerrbrittany9/dining
* From your local console:
  * Enter Desktop by typing "cd Desktop"
  * Type "git clone [add above URL]".
  * Type "cd dining" to enter directory.
  * Download dependencies by typing "composer install" in console.
* In browser type "localhost:8888/phpmyadmin"
  * Click 'import' tab and choose file 'dining.sql' to import database.
* Open preferences>ports on MAMP and verify that Apache Port is 8888.
* Go to preferences>web server and click the file folder next to document root.
  * Click web folder and hit select.
  * Click ok at the bottom of preferences to start server.
* In your browser, type 'localhost:8888' to view the webpage.
* Type a cuisine name in input field to get started.

## Specifications
1. Behavior: The user can add a restaurant to a restaurant list.
```
  * Input: Portland City Grill
  * Output: 1. Luce 2. Portland City Grill
```
2. Behavior: The user can add restaurant to the list with description.
```
  * Input: Portland City Grill - Fine Dining - Downtown - Five Stars
  * Output: Fine Dining: 1. Portland City Grill: Fine Dining, Downtown, Five Stars, 2. Luce: Italian, NE, Four Stars
```
3. Behavior: The user can search for restaurant via cuisine type.
```
  * Input: Fine Dining
  * Output: 1. Portland City Grill, Jake's
```

4 The user can click on cuisine and 'edit this cuisine' by renaming it.
```
  * Example Input: click 'american' and then 'edit this cuisine'. enter 'fast food'.
  * Example Output: 'fast food'
```

## Technologies Used

* _PHP_
* _HTML_
* _Bootstrap CSS_
* _Silex_
* _Twig_
* _Composer_
* _MAMP_

### License

Copyright &copy; 2017 Dylan Lewis & Brittany Kerr

This software is licensed under the MIT license.
