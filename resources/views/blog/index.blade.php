@extends('layouts.default')

@section('title','Home')

@section('content')
<div class="container mx-auto flex flex-wrap py-6">

<!-- Posts Section -->
<section class="w-full md:w-2/3 flex flex-col items-center px-3">
    @foreach($posts as $post)
    <article class="flex flex-col shadow my-4">
        <!-- Article Image -->
        <a href="#" class="hover:opacity-75">
            <img src="images/{{$post->image}}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            @foreach($post->categories as $cat)
            <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$cat->name}}</a>
            @endforeach

            <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{$post->title}}</a>
            <p href="#" class="text-sm pb-3">
                By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Published on {{$post->getDate()}}
            </p>
            <a href="#" class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis porta dui. Ut eu iaculis massa. Sed ornare ligula lacus, quis iaculis dui porta volutpat. In sit amet posuere magna..</a>
            @can('view',$post)
            <a href="{{route('blog.show',$post)}}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
            @endcan
        </div>
    </article>
@endforeach
  

  


</section>


</div>

@endsection