<?php

// route file

router()->get('/', 'HomeController', 'index', 'home');
router()->get('/products/{slug}', 'ProductController', 'index', 'product');
router()->get('/pay', 'PayController', 'index', 'pay');
router()->post('/pay/create', 'PayController', 'create', 'pay.create');

router()->post('/cart/add/{id}', 'CartController', 'add', 'cart.add');
router()->post('/cart/remove/{id}', 'CartController', 'remove', 'cart.remove');



