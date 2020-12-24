<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{route('blog.store')}}" method="post">
@csrf
@foreach ($categories as $category)
<span>{{$category->name}}:</span>&nbsp;<input type="checkbox" name="categories[]" value="{{$category->id}}" id=""><br>
@endforeach
<p>Title:</p>
<input type="text" name="title" id=""><br>

<p>content:</p>
<textarea name="content" id="" cols="30" rows="10"></textarea><br>
<input type="submit" value="Submit">
</form>
</body>
</html>
