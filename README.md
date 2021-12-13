wtforms-php
===========

PHP WTForms library inspired by Python WTForms module

## Installing WTForms-PHP

There are two ways to get WTForms-PHP, i.e. by composer install or download the package manually.

#### Get WTForms-PHP via composer

You can run the following terminal command in the root directory of your project:

```bash
composer install wtforms\wtforms
```

or add the the following lines to your composer.json file as a requirement:

```bash
wtforms\wtforms: 1.0
```

#### Get WTForms-PHP via download

You can download the latest version of the project [here](https://github.com/b4oshany/wtforms-php/archive/v0.5.zip)

## Using WTForms-PHP in your project

If your using composer with autoloading, you can simple use the `WTForms` namespace to load specific classes or modules from the WTForms-PHP library. For instance:

```php
use WTForms\Form;
use WTForms\Fields\StringField;
```

Otherwise, you have to manually include them by doing the following:

```php
require_once 'path/to/wtforms-php/src/Form.php';
require_once 'path/to/wtforms-php/src/fields/StringField.php';
```

## Create a WTForm Object

The example below is used to create form object with a list of form input fields.

```php
class AddressForm extends Form{
    function setUp(){
        $this->_fields = [
            "street" => (new Fields\StringField("Street")),
            "town" => (new Fields\StringField("Town/District"))->required(),
            "parish" => (new Fields\StringField("Parish"))->required(),
            "country" => (new Fields\StringField("Country"))->required(),
        ]
    }
}
```

