<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <h1>{{$post->title}}</h1>
  <ul>
  @foreach($post->categories as $cat)
  <li>{{$cat->name}}</li>
  @endforeach
  </ul>  
  
</body>
</html>