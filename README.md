# opencart-php-import

The file must be placed in opencart 3.0.3.8 in the next location:
admin/controller/create_product.php
And in order to be triggered access the next url:
http://localhost/opencart3/admin/index.php?route=create_product

You need to also allow opencart to acces this class by doing the next:

![image](https://github.com/takegabriel08/opencart-php-import/assets/45741342/5ce0ec1a-ea57-48b1-9cee-bf57661decee)

Find your class and check the checkbox in both Access Permission and Modify permission tabs.
This will basically create a dumb product with the hardcoded data that I entered.
