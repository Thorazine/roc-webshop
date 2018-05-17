# Database

The database data can be altered in the DB class: app/classes/DB.php


# Libraries

Run in your terminal:

```
composer install
```


# Mollie payments

Mollie needs a valid public url to update the payment status. On localhost you will need to change the url
in the "webshop/app/Controllers/PayController.php" file. You can find it in the create() function on
line ~70. If you don't use ngrok or something similar, your payment will always fail.
