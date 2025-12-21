<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Admin;   

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function avatarName(): Attribute
    {
        return new Attribute(
            get: fn() => $this->name,
        );
    }

    use HasRoles;
    protected $guard_name = 'web';

    #Agregasi ke model Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    #Agregasi ke model Owner
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
    public function canAccessPanel(Panel $panel): bool
    {

        if ($this->hasRole('super_admin')) {
            return true;
        }

        return str_ends_with($this->email, '@kilaubuild.com');

        // TOLAK AKSES
        // return false;
    }
}
