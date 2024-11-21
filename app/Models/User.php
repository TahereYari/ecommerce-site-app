<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email',
        'national_code',
        'tel',
        'image'
    ];


    public function tickets()
    {
        return $this->hasMany(Ticket::class)->get();
    }

    public function Message()
    {
        return $this->hasMany(TicketMessages::class)->get();
    }

    public function requests()
    {
        return $this->hasMany(requestProduct::class)->get();
    }

    public function competiotionsAnswers()
    {
        return $this->hasMany(CompetiotionsAnswer::class);
    }

    public function competiotionsWiners()
    {
        return $this->hasMany(CompetetionWiner::class);
    }
    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updating(function ($user) {
    //         // حذف نقش‌های کاربر اگر deleteStatus برابر 0 شود
    //         if ($user->isDirty('deleteStatus') && $user->deleteStatus == 1) {
    //             $user->roles()->detach();
    //         }
    //     });
    // }
}
