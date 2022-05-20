<?php

namespace App\Models;

use Database\Factories\UserFactory;
use williamcruzme\FCM\Traits\HasDevices;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Self_;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasDevices,Notifiable;
    use TwoFactorAuthenticatable;
    use HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'google_id',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public static function give_buy_email($email){
        return self::where(('email'),$email)->get();
    }
    public static function give_buy_eemail($email){
        return self::where(('email'),'!=',$email)->get();
    }
    public static function delete_this($id){
        return self::where(('id'),$id)->delete();
    }
    public static function give_buy($id){
        return self::where(('id'),$id)->get()->toArray();
    }
}
