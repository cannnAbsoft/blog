@extends('layout')

@section('content')
    <div x-data="{show:false}">
        <button @click="show =! show">
            {{isset($currentCategory) ? $currentCategory->name : 'Categories'}}
            </button>
        <div x-show="show">
            @foreach($categories as $category)
            <a href="/?category={{$category->slug}}&{{http_build_query(request()->except('category','page'))}}" class="{{isset($currentCategory) && $currentCategory->id === $category->id ? 'toi da duoc chon' : ''}}">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
    <form method="get" action="/">
        @if(request('category'))
            <input type="hidden" name="category" value="{{request('category')}}">
        @endif
        <input type="text" name="search" placeholder="Find Something" value="{{request('search')}}">
    </form>
    @foreach ($posts as $post)
        <h1><a href="/post/{{ $post->slug }}" class="{{$loop->even ? 'foo' : ''}}" style="color: #2ca02c">{{$post->title}}</a></h1>
        <p>By <a href="/?author={{$post->author->userName}}" style="color: rebeccapurple">{{$post->author->userName}}</a> in <a href="/categories/{{$post->category->slug}}" style="color: #82AAFF;">{{$post->category->name}}</a> </p>
        <div>
            {!! $post->excerpt !!}
        </div>
        <hr>
    @endforeach
    {{$posts->links()}}
@endsection
