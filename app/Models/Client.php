<?php

namespace App\Models;


use App\Models\Builders\ClientBuilder;
use App\Models\BaseModel;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property string phone
 * @property string national_id_img_front
 * @property string national_id_img_back
 * @property string national_id
 * @property string note
 * @property-read Bill[] bills
 * @property-read Bill[] disabledBills
 */
class Client extends BaseModel
{
    use FileUploadTrait;

    protected $fillable = [
        'name', 'phone', 'national_id_img_front', 'national_id_img_back', 'national_id', 'note',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [

    ];

    protected array $fileupload = [
        'national_id_img_front', 'national_id_img_back'
    ];


    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class, 'client_id');
    }
    public function disabledBills(): HasMany
    {
        return $this->hasMany(Bill::class, 'disabled_client_id');
    }

    /**
     * @return ClientBuilder
     */
    public static function query(): ClientBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return ClientBuilder
     */
    public function newEloquentBuilder($query): ClientBuilder
    {
        return new ClientBuilder($query);
    }
}
