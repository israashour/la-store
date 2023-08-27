<?php

namespace App\Models;

use App\Traits\Funcs;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Product extends Model
{
    use HasFactory, SoftDeletes, Scopes, Funcs;

    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('products', 'name')->ignore($id),
            ],
            'category_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'store_id' => [
                'nullable', 'int', 'exists:stores,id'
            ],
            'description' => 'string|required',
            'image' => [
                'mimes:png,jpg', 'max:1048576', 'dimensions:min_width=100,min_height=100'
            ],
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'options' => 'nullable|json',
            'rating' => 'required|numeric|min:0|max:5',
            'featured' => 'required|boolean',
            'is_active' => 'required|in:active,unactive',
        ];
    }
}
