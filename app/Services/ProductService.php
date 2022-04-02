<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{
    public function filter(array $data): Collection|array
    {
        $query = Product::withTrashed(!@$data['withoutTrashed']);

        if (isset($data['name'])) {
            $query->where('name', 'like', "%{$data['name']}%");
        }

        if (isset($data['categoryId'])) {
            $query->whereHas(
                'categories',
                fn(Builder $many) => $many->where('id', $data['categoryId'])
            );
        }

        if (isset($data['categoryName'])) {
            $catName = '%' . Str::lower($data['categoryName']) . '%';
            $query->whereHas(
                'categories',
                fn(Builder $many) => $many->where(DB::raw('lower(name)'), 'like', $catName)
            );
        }

        if (isset($data['priceFrom'])) {
            $query->where('price', '>=', $data['priceFrom']);
        }

        if (isset($data['priceTo'])) {
            $query->where('price', '<=', $data['priceTo']);
        }

        if (isset($data['published'])) {
            $query->where('published', $data['published']);
        }

        return $query->get();
    }
}
