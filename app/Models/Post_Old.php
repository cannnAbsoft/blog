<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $slug;
    public $date;
    public $body;

    /**
     * @param $title
     * @param $excerpt
     * @param $slug
     * @param $date
     * @param $body
     */
//    public function __construct($title, $excerpt, $slug, $date, $body)
//    {
//        $this->title = $title;
//        $this->excerpt = $excerpt;
//        $this->slug = $slug;
//        $this->date = $date;
//        $this->body = $body;
//    }

    public static function all(){
//            $files =  File::files(public_path("/../resources/views/posts"));
//        $documents = array_map(function($file){
//            return YamlFrontMatter::parseFile(public_path("/../resources/views/posts/{$file->getFileName()}"));
//        }, $files);
//        return cache()->rememberForever('posts.all',function(){
//            return collect(File::files(public_path("/../resources/views/posts")))
//                ->map(fn($file) => YamlFrontMatter::parseFile(public_path("/../resources/views/posts/{$file->getFileName()}")))
//                ->map(fn($document)=>new Post($document->title,
//                    $document->excerpt,
//                    $document->slug,
//                    $document->date,
//                    $document->body()))->sortByDesc('date');
//        });

//        return array_map(function($file){
//            $document = YamlFrontMatter::parseFile(public_path("/../resources/views/posts/{$file->getFileName()}"));
//            return new Post($document->title,
//                $document->excerpt,
//                $document->slug,
//                $document->date,
//                $document->body());
//        }, $files);

//        return array_map(function($document){
//            return new Post($document->title,
//            $document->excerpt,
//            $document->slug,
//            $document->date,
//            $document->body());
//        }, $documents);

    }

    public static function find($slug){
        // pass slug, where get first element in array
        return self::all()->firstWhere('slug', $slug);
//        $path = public_path("/../resources/views/posts/{$slug}.blade.php");
//        if(!file_exists($path)){
//        throw new ModelNotFoundException();
//            }
//        return cache()->remember("posts.{$slug}",1200, fn() => file_get_contents($path));
    }

    public static function findOrFail($slug)
    {
        $post = self::all()->firstWhere('slug', $slug);
        if(!$post){
            throw new ModelNotFoundException();
        }
        return $post;
    }
}
