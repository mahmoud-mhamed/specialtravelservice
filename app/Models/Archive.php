<?php

namespace App\Models;


use App\Classes\Helpmate;
use App\Models\Builders\ArchiveBuilder;
use App\Enums\ArchiveCollectionNameEnum;
use App\Traits\BelongsToBillTrait;
use App\Traits\BelongsToClientTrait;
use App\Traits\FileUploadTrait;

/**
 * @property string name
 * @property string collection_name
 * @property int bill_id
 * @property int client_id
 * @property int disabled_client_id
 * @property string file
 * @property string mimetype
 * @property-read string $collection_name_text
 * @property-read string size_text
 * @property-read Client $disabledClient
 */
class Archive extends BaseModel
{
    use BelongsToClientTrait, BelongsToBillTrait;
    use FileUploadTrait;

    protected $fillable = [
        'name', 'collection_name', 'bill_id', 'client_id', 'disabled_client_id', 'file', 'mimetype',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'collection_name' => ArchiveCollectionNameEnum::class,

    ];

    protected array $fileupload = [
        'file'
    ];

    protected $appends=[
        'size_text'
    ];
    public function disabledClient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class, 'disabled_client_id');
    }


    /**
     * @return ArchiveBuilder
     */
    public static function query(): ArchiveBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @return ArchiveBuilder
     */
    public function newEloquentBuilder($query): ArchiveBuilder
    {
        return new ArchiveBuilder($query);
    }

    public function callBackUploadFile($file): void
    {
        $this->mimetype = $file->getClientOriginalExtension();
        if (!$this->name)
            $this->name = $file->getClientOriginalName();
        $this->size = $file->getSize();
    }

    public function getSizeTextAttribute(): ?string
    {
        if (!$this->size)
            return null;
        return Helpmate::convertSizeToReadFormat($this->size);
    }
    public function getAllowPreviewAttribute(): bool
    {
        if (!$this->mimetype)
            return false;
        return in_array($this->mimetype, ['png', 'jpg', 'pdf', 'JPG', 'jpeg', 'svg']);
    }
}
