<?php

namespace App\Models;


use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductImage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasSlug;
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'published',
        'inStock',
        'price',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    //filter logic for price,category and brand

    public function scopeFiltered(Builder $query){
        $query -> when(request('brands'), function (Builder $q) {
            $q->whereIn('brand_id', request ('brands'));

        })
        ->when(request('categories'), function (Builder $q){
            $q->whereIn('category_id', request ('categories'));

        })
        ->when(request('prices'), function (Builder $q){
                $q->whereBetween('price',[
                    request('prices.from',0),
                    request('prices.to',10000),
                ]);
            });
        

    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'product_id');
}
   
}
