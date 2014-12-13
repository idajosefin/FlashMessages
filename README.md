[![Build Status](https://travis-ci.org/pbjuhr/FlashMessages.svg?branch=master)](https://travis-ci.org/idajosefin/FlashMessages.svg?branch=master)

FlashMessages
=============

FlashMessages is a class to handle success, debug, warning and error messages. It's made for the framework Anax-MVC.

How to use
-------------
###1. Download

The easiest way to install this is using composer. Add this your composer.json: 

```javascript
"require": {
    "ider/flashmessages": "dev-master"
},
```
###2. Include FlashMessages in your project
Session must be started before using FlashMessages. In order to include the class in you Anax-MVC, you can add this in your front controller: 

```php
$di->setShared('FlashMessages', function() use ($di) { 
    $FlashMessages = new \ider\FlashMessages\FlashMessages($di); 
    return $FlashMessages; 
});
```

###3. Generate and display messages
Four different types of messages can be generated. Here is and example of how you can display a message in Anax-MVC:  
```php
    $app->FlashMessages->addSuccess("Yes, Everything went very smoothly!");
    $app->FlashMessages->addInfo("This is very important information.");
    $app->FlashMessages->addWarning("This is a warning.");
    $app->FlashMessages->addError("Too bad! Something went wrong.");
```