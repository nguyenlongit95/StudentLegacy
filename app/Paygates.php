<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paygates extends Model
{
    //
    protected $table="paygates";

    protected $filltable = [
        "currency_id",
        "currency_code",
        "code",
        "name",
        "withdraw",
        "withdrawField",
        "deposit",
        "payment",
        "instant",
        "verify",
        "convert",
        "description",
        "avatar",
        "url",
        "configs",
        "status",
        "w_fixed_fees",
        "w_percent_fees","w_daily_limit",
        "w_country_block","w_min",
        "w_max","w_nofees",
        "d_fixed_fees","d_percent_fees","d_daily_limit",
        "d_country_block","d_min",
        "d_max","d_nofees",
        "p_fixed_fees","p_percent_fees",
        "p_daily_limit","p_country_block","p_min",
        "p_max","p_nofees"
    ];
}
