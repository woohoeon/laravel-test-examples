<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AgentAccountResetPasswordNotification;

class AgentAccount extends Authenticatable
{
    use Notifiable;

    protected $guard = 'agent';
    protected $table = 'agent_account';
    protected $primaryKey = 'login_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'login_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AgentAccountResetPasswordNotification($token));
    }
}
