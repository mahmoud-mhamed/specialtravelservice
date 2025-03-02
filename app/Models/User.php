<?php

namespace App\Models;


use App\Models\Builders\UserBuilder;
use App\Traits\EnumCastAppendAttributeTrait;
use App\Traits\FileUploadTrait;
use App\Traits\LogsTrait;
use App\Traits\ModelDateTextTrait;
use App\Traits\MorphModelTriggerTrait;
use App\Traits\PaginatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * @property string name
 * @property string email
 * @property string avatar
 * @property string phone
 * @property bool is_active
 * @property-read string avatar_url
 * @property-read string is_active_text
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRolesAndAbilities;

    //from base model
    use PaginatableTrait, EnumCastAppendAttributeTrait,
        SoftDeletes, ModelDateTextTrait, MorphModelTriggerTrait;
    use LogsTrait;
    use FileUploadTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'avatar', 'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected array $fileupload = [
        'avatar' => [
            'default_asset' => 'images/avatar.jpg'
        ],
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return UserBuilder
     */
    public static function query(): UserBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return UserBuilder
     */
    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
