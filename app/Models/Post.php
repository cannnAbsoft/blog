<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //Post::factory() call PostFactory;
    protected $fillable = ['title','excerpt','body'];
    protected $with = ['category','author'];

    public function scopeFilter($query, array $filters) //Post::newQuery->filter()
    {
        $query->when($filters['search'] ?? false, function ($query, $search){
            $query->where('title','like','%'.$search.'%')
                ->orWhere('body','like','%'.$search.'%');
        });
        $query->when($filters['category'] ?? false, fn($query, $category)=>
        $query
            ->whereHas('category', fn($query)=>
            $query->where('slug',$category))
        );

        $query->when($filters['author'] ?? false, fn($query, $author)=>
        $query
            ->whereHas('author', fn($query)=>
            $query->where('userName',$author))
        );
//        $query->when($filters['category'] ?? false, fn($query, $category)=>
//            $query
//                ->whereExists(fn($query)=>
//                    $query->from('categories')
//                        ->whereColumn('categories.id','posts.category_id')
//                        ->where('categories.slug', $category))
//        );
//        if($filters['search'] ?? false){
//            $query->where('title','like','%'.request('search').'%')
//                ->orWhere('body','like','%'.request('search').'%');
//        }
    }
    public function category() //category_id
    {
        return $this->belongsTo(Category::class);
    }

    public function author() //author_id
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
