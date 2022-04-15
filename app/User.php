<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\SoftDeletes;	//追記

use App\Notifications\OrderNotify;
use App\Notifications\OrderNotifyEng;
use App\Notifications\PasswordResetNotification;
use App\Notifications\PasswordResetEnNotification;

class User extends Authenticatable
{
    use Notifiable, Billable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id',
        'name', 
        'kana',
        'zipcode',
        'prefecture',
        'city',
        'address_1',
        'address_2',
        'building',
        'phone',
        'email', 
        'password',
        'lang',
        'unsubscribe',
        'life'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){

        return $this->hasMany('App\Models\Order');

    }

    public function addresses(){

        return $this->hasMany('App\Models\Address');

    }

    //notifications
    public function sendOrderNotify($user, $order){
        $this->notify(new OrderNotify($user, $order));
    }

    public function sendOrderNotifyEng($user, $order){
        $this->notify(new OrderNotifyEng($user, $order));
    }

    //new password reset notification
    public function sendPasswordResetNotification($token)
    {
        $lang = app()->getLocale();

        // DD($locale);

        if($lang === 'ja'){
            $this->notify(new PasswordResetNotification($token, $lang));
        }else{
            $this->notify(new PasswordResetEnNotification($token, $lang));
        }
        
        
    }

    public function coupons(){
        return $this->hasMany('App\Models\Coupon');
    }
}
// 