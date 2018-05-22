<?php

use Mollie\Api\Exceptions\ApiException; // https://github.com/mollie/mollie-api-php

Class PayController extends Controller
{

	private $mollieApiKey = 'test_8H2TrFhK9pAR8SNGptzdmgP2gRVUvC';

	public function index()
	{
		return response()->view('pay');
	}


	public function create()
	{
		// validate the user data
		require '../classes/validation/PayValidationCreate.php';

		try {
			/*
				There is always a posibility that queries don't run as expected.
				When one fails, another might succeed. That means that you might
				have inconsistent data in your database.
				To counteract this, you can start a transaction. A transaction
				is running a query, but not committing to it until you are ready
				for it. To run them, you just need to commit.
			*/
			db()->transaction();

			$parameters = router()->parameters();

			// create the user
			$userId = db()->query('INSERT INTO `users` (first_name, suffix_name, last_name, country, city, street, street_number, street_suffix, zipcode, email, password, created_at, updated_at)
				VALUES
				(:first_name, :suffix_name, :last_name, :country, :city, :street, :street_number, :street_suffix, :zipcode, :email, :password, :created_at, :updated_at)',[
					'first_name' => $parameters['first_name'],
					'suffix_name' => $parameters['suffix_name'],
					'last_name' => $parameters['last_name'],
					'country' => $parameters['country'],
					'city' => $parameters['city'],
					'street' => $parameters['street'],
					'street_number' => $parameters['street_number'],
					'street_suffix' => $parameters['street_suffix'],
					'zipcode' => $parameters['zipcode'],
					'email' => $parameters['email'],
					'password' => password_hash($parameters['password'], PASSWORD_BCRYPT), // encrypt the password before putting it in the database
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
			])->insert();

			// create an order in the database, update the mollie id after
			$orderId = db()->query('INSERT INTO `orders`
				(amount, payment_status, user_id, created_at, updated_at)
				VALUES
				(:amount, :payment_status, :user_id, :created_at, :updated_at)', [
					'amount' => $_SESSION['cart']['total'],
					'payment_status' => 'open',
					'user_id' => $userId,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
			])->insert();

			// On localhost mollie can't reach us. So https://ngrok.com/ will tunnel for us on localhost.
			// But on the server it will not, only on localhost
			$webhookUrl = (router()->domainName == 'localhost') ? 'https://686079cb.ngrok.io/webshop/public/pay/webhook/'.$orderId : router()->name('pay.webhook', ['orderId' => $orderId]);

			$mollie = new \Mollie\Api\MollieApiClient();
			$mollie->setApiKey($this->mollieApiKey); // test api key

			// create a mollie api v2 payment: https://github.com/mollie/mollie-api-php
			$payment = $mollie->payments->create([
			    "amount" => [
			        "currency" => "EUR",
			        "value" => (string)$_SESSION['cart']['total']
			    ],
			    "description" => "Bedankt voor uw aankoop bij MyBikeShop.nl!",
			    "redirectUrl" => router()->name('pay.done', ['orderId' => $orderId]),
			    "webhookUrl"  => $webhookUrl,
			    'metadata' => $orderId, // send along the order id
			]);

			// create an order in the database, add the mollie id
			db()->query('UPDATE orders SET mollie_id = :mollie_id WHERE id = :id', [
				'mollie_id' => $payment->id,
				'id' => $orderId
			])->update();

			// put all the products in the database
			foreach($_SESSION['cart']['products'] as $productId => $product) {
				db()->query('INSERT INTO `orders_products`
					(order_id, product_id, price, quantity, created_at, updated_at)
					VALUES
					(:order_id, :product_id, :price, :quantity, :created_at, :updated_at)', [
						'order_id' => $orderId,
						'product_id' => $productId,
						'price' => $product['price'],
						'quantity' => $product['quantity'],
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
				])->insert();
			}

			db()->commit();

			header("Location: " . $payment->getCheckoutUrl(), true, 303);
		}
		catch(Exception $e) {
			db()->rollBack();
			dd($e->getMessage());
		}
	}

	// return point for mollie. Redirect to the correct page.
	public function done($orderId)
	{
		$order = db()->query('SELECT * FROM `orders` WHERE id = :id', ['id' => $orderId])->first('Order');

		if(in_array($order->payment_status, ['paid'])) {
			Cart::reset();
			return router()->redirect()->name('pay.success', ['orderId' => $orderId]);
		}
		elseif(in_array($order->payment_status, ['pending'])) {
			Cart::reset();
			return router()->redirect()->name('pay.pending', ['orderId' => $orderId]);
		}
		return router()->redirect()->name('pay.failed', ['orderId' => $orderId]);
	}

	// return point for mollie
	public function success($orderId)
	{
		return response()->view('success');
	}

	// return point for mollie
	public function pending($orderId)
	{
		return response()->view('pending');
	}

	// return point for mollie
	public function failed($orderId)
	{
		return response()->view('failed');
	}

	// return point for mollie
	public function webhook($orderId)
	{

		try {
			$mollieId = router()->parameters()['id'];

			// get the payment
			$mollie = new \Mollie\Api\MollieApiClient();
			$mollie->setApiKey($this->mollieApiKey);
			$payment = $mollie->payments->get($mollieId);

	    	// update order in database with new status
	    	db()->query('UPDATE orders SET payment_status = :payment_status WHERE mollie_id = :mollie_id', [
	    			'payment_status' => $payment->status,
	    			'mollie_id' => $mollieId,
		    	])
	    		->update();



	    	if ($payment->isPaid()) {
    	        /*
    	         * At this point you'd probably want to start the process of delivering the product to the customer.
    	         */
    	    } elseif ($payment->isOpen()) {
    	        /*
    	         * The payment is open.
    	         */
    	    } elseif ($payment->isPending()) {
    	        /*
    	         * The payment is pending.
    	         */
    	    } elseif ($payment->isFailed()) {
    	        /*
    	         * The payment has failed.
    	         */
    	    } elseif ($payment->isExpired()) {
    	        /*
    	         * The payment is expired.
    	         */
    	    } elseif ($payment->isCanceled()) {
    	        /*
    	         * The payment has been canceled.
    	         */
    	    }
    	} catch (ApiException $e) {
    		dd("API call failed: " . htmlspecialchars($e->getMessage()));
    	}
	}



	public function paymentDone()
	{
		$payment = $mollie->payments->get($payment->id);

		if ($payment->isPaid())
		{
		    echo "Payment received.";
		}
	}
}
