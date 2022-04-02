<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer id
 * @property Collection|Product[] products
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
