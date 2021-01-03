<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
        with:70%;
        border: 1px solid #333;
        border-collapse:collapse;
        
    }
td , th {
        border: 1px solid #333;
        padding:8px;
    }

    </style>
</head>
<body>
@if($trash)
<h1>View all trashes</h1>
<hr>
<a href="{{route('blog.index')}}">View blog posts</a><br>
@else
<h1>View all posts</h1>
<hr>
<a href="{{route('blog.trash')}}">View trashes</a><br>
    <a href="{{route('blog.create')}}">Add new posts</a><br>
    @endif
    <table>
        <tr>
        <th>#</th>
        <th>Title</th>
        <th>content</th>
        <th>Actions</th>
        </tr>
        @php $no =0 @endphp
@foreach($posts as $post)
        <tr>
            <td>{{++$no}}</td>
            <td>{{$post->title}}</td>
            <td>{{Str::limit($post->content,100)}}</td>
 
 @if($trash)
      <td>
      <a href="{{route('blog.restore',$post)}}">Restore</a>
      <a href="{{route('blog.remove',$post)}}">Delete</a>
      </td>
      @else
      <td>
      <a href="{{route('blog.edit',$post)}}">Edit</a>
       <form action="{{route('blog.destroy',$post)}}" method="post">
       @csrf
       @method('DELETE')
       <input type="submit" value="Delete">
       </form>
      </td>
      @endif
        </tr>
        @endforeach
    </table>
</body>
</html>