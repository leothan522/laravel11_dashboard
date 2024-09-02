<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'plataforma',
        'estatus',
        'role',
        'roles_id',
        'permisos',
        'token_recuperacion',
        'times_recuperacion',
        'rowquid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //AdminLTE
    public function adminlte_image()
    {
        //return 'https://picsum.photos/300/300';
        //return "https://ui-avatars.com/api/?name=".Auth::user()->name."&color=7F9CF5&background=EBF4FF";
        //return verImagen(auth()->user()->profile_photo_path, auth()->user()->name);
        return verImagen(Auth::user()->profile_photo_path, true);
    }

    public function adminlte_desc()
    {
        return Auth::user()->email." [".verRole(Auth::user()->role, Auth::user()->roles_id)."]";
    }

    public function adminlte_profile_url()
    {
        return 'dashboard/perfil';
    }

    public function scopeBuscar($query, $keyword)
    {
        return $query->where('name', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->orWhere('id', 'LIKE', "%$keyword%")
            ;
    }

    public function fcm(): HasMany
    {
        return $this->hasMany(Fcm::class, 'users_id', 'id');
    }

}
