<?php

return [
    //These are for the Marketplace
    'appID' => '127611ce5425cd9426cedd323b116721',
    'secretKey' => '40c49f847f9a8766b3014bf4154910a31f9c596e',
    'testURL' => 'https://ces-gamma.cashfree.com',
    'prodURL' => 'https://ces-api.cashfree.com',
    'maxReturn' => 100, //this is for request pagination
    'isLive' => true,

    //For the PaymentGateway.
    'PG' => [
        'appID' => '127611ce5425cd9426cedd323b116721',
        'secretKey' => '40c49f847f9a8766b3014bf4154910a31f9c596e',
        'testURL' => 'https://test.cashfree.com',
        'prodURL' => 'https://api.cashfree.com',
        'isLive' => true
    ]
];
