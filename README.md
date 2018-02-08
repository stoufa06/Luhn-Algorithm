# Luhn-Algorithm
Composer library for Luhn algorithm credit card Validation

# Install with composer
`composer require stoufa/luhn-agorithm`

# How to use 
create php file index.php
```php
<?php  
require __DIR__."/vendor/autoload.php";

use LuhnAlgo\Card;

// Valid card number
try {
    $card_number = '378766681165445';
    $card = new Card($card_number);
    echo "$card_number credit card is valid card number". PHP_EOL;
} catch (Exception $e) {
    echo "$card_number credit card is not valid card number". PHP_EOL;
}


// Invalid card number
try {
    $card_number = '378766681165455';
    $card = new Card($card_number);
    echo "$valid_card credit card is valid card number". PHP_EOL;
} catch (Exception $e) {
    echo "$card_number credit card is not valid card number". PHP_EOL;
}
```

Run php file
`php index.php`

# Run project tests
Via command line
`php path-to-project-code/test/test.commandline.php`

Html version 
`http://localhost/Luhn-Algorithm/test/test.html.php`

Test data are json files located in test/testdata. These files are generated from http://www.getcreditcardnumbers.com/.
