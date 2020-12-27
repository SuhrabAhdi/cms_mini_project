<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Create a new post</h1>
<h2 style="color:red">{{Session::get("error")}}</h2>
    <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  <p>Title:</p>  
  <input type="text" name="title" id=""><br>
  <span>{{$errors->first('title')}}</span>
  <p>contetn:</p>  
 <textarea name="content" id="" cols="30" rows="10"></textarea><br>
 <span>{{$errors->first('content')}}</span>
  <p>Image:</p>  
  <input type="file" name="image" id=""><br>
  <span>{{$errors->first('image')}}</span><br>
<button type="submit">Submit</button>
    </form>
</body>
</html>