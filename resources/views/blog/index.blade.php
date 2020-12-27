<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    ul li {
        list-style-type:none;
        float:left;
        margin:5px;
    } 
    a{
        text-decoration:none;
    }
    </style>
</head>
<body>
    <h1>List of posts</h1>
    <h2 style="color:green">{{Session::get("status")}}</h2>
<a href="{{route('blog.create')}}">Add new Post</a>
    @foreach($posts as $post)

    <h2>{{$post->title}}</h2>
    <ul>
    @foreach($post->categories as $category )
    <li><a href="{{route('category.filter',$category)}}">#{{$category->name}}</a></li>
    @endforeach
    </ul>
    <br>

    <img src="images/{{$post->image}}" alt="">
    <p>{{$post->content}}</p>
      <form action="{{route('blog.destroy',$post)}}" method="post">
      @csrf
      @method('DELETE')

      <input type="submit" value="Delete">
      </form>
    @endforeach
</body>
</html>