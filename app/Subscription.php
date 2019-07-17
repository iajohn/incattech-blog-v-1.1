<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'comment', 'payment_desc', 'payment_method', 'amount', 'discount', 'total_amt', 'transaction_id',
        'purchase_time', 'started_time', 'end_time', 'doneby'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
