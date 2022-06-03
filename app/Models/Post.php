<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $slug
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $excerpt
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $published_at
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $thumbnail
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereThumbnail($value)
 */
class Post extends Model
{
    use HasFactory; //Post::factory() call PostFactory;
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
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
