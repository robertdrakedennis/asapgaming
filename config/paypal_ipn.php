<?php
/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 9/29/2018
 * Time: 1:59 AM
 */

return [
        'paypal_environment' => env('PAYPAL_ENVIRONMENT', 'sandbox'),
        'paypal_email' => env('PAYPAL_EMAIL', 'xeninco@gmail.com'),
        'paypal_cancel_url' => env('PAYPAL_CANCEL_URL', 'https://weeb.cafe'),
        'paypal_return_url' => env('PAYPAL_RETURN_URL', 'https://weeb.cafe'),
        'paypal_notify_url' => env('PAYPAL_NOTIFY_URL', 'https://weeb.cafe/paypal/notify')
];
