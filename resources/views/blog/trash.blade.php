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
<h1>View all trashes</h1>
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

      <td>
      <a href="{{route('blog.restore',$post)}}">Restore</a>
      <a href="{{route('blog.remove',$post)}}">Delete</a>
      </td>
        </tr>
        @endforeach
    </table>
</body>
</html>