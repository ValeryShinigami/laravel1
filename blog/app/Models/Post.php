<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    
    protected $guarded = []; //pour faire passer les informations des inputs
    protected $dates = ["created_at", "updated_at", "deleted_at", "published_at"]; //on redeclare toutes les dates de type post
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
