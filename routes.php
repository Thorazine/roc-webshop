<?php

// route file

router()->get('/', 'HomeController', 'index', 'home');
router()->get('/products/{slug}', 'ProductController', 'index', 'product');
router()->get('/pay', 'PayController', 'index', 'pay');
router()->post('/pay/create', 'PayController', 'create', 'pay.create');
router()->get('/pay/done/{orderId}', 'PayController', 'done', 'pay.done');
router()->get('/pay/webhook/{orderId}', 'PayController', 'webhook', 'pay.webhook');
router()->post('/pay/webhook/{orderId}', 'PayController', 'webhook', 'pay.webhook');
router()->get('/pay/success/{orderId}', 'PayController', 'success', 'pay.success');
router()->get('/pay/pending/{orderId}', 'PayController', 'pending', 'pay.pending');
router()->get('/pay/failed/{orderId}', 'PayController', 'failed', 'pay.failed');

router()->post('/cart/add/{id}', 'CartController', 'add', 'cart.add');
router()->post('/cart/remove/{id}', 'CartController', 'remove', 'cart.remove');



