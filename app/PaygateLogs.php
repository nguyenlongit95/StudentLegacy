<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaygateLogs extends Model
{
    //
    protected $table = "paygates_log";

    protected $filltable = [
        "order_code","user",
        "pay_amount","currency_id",
        "currency_code","provider",
        "bank_code","post_logs","payment_logs","",
        "callback_logs","ip","","country","user_agent"
    ];
}
