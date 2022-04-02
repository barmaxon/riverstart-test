<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Route;

/**
 * @property integer id
 * @property string name
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['name', 'price', 'published'];

    protected $with = ['categories'];

    protected $casts = [
        'published' => 'bool',
        'deleted_at' => 'date:Y-m-d H:i:s'
    ];

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        return self::withTrashed()->where('id', $value)->firstOrFail();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
