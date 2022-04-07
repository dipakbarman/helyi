<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'http://localhost/helyi/return_url',
        'http://localhost/helyi/addmoney_cashfree',
        'http://localhost/helyi/cashfree_plan_purchase',
        'http://localhost/helyi/cashfree_plan_purchase_returnurl',
        'http://localhost/helyi/epos_cashfree',
        'https://localhost/helyi/return_url',
        'https://localhost/helyi/addmoney_cashfree',
        'https://localhost/helyi/cashfree_plan_purchase',
        'https://localhost/helyi/cashfree_plan_purchase_returnurl',
        'https://localhost/helyi/epos_cashfree',
        'https://helyi.in/Prod/return_url',
        'https://helyi.in/Prod/addmoney_cashfree',
        'https://helyi.in/Prod/cashfree_plan_purchase',
        'https://helyi.in/Prod/cashfree_plan_purchase_returnurl',
        'https://helyi.in/Prod/epos_cashfree',
        'https://helyi.in/staging/return_url',
        'https://helyi.in/staging/addmoney_cashfree',
        'https://helyi.in/staging/cashfree_plan_purchase',
        'https://helyi.in/staging/cashfree_plan_purchase_returnurl',
        'https://helyi.in/staging/epos_cashfree',
        'https://helyi.in/return_url',
        'https://helyi.in/addmoney_cashfree',
        'https://helyi.in/cashfree_plan_purchase',
        'https://helyi.in/cashfree_plan_purchase_returnurl',
        'https://helyi.in/epos_cashfree',
    ];
}
