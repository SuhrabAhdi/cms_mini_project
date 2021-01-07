<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit your profile</h1>

    <form action="{{route('profile.update',$user)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
     <p>Name:</p>
    <input type="text" name="name" value="{{$user->profile->name ?? ''}}"><br>

    <p>Expertise:</p>
    <input type="text" name="expertise" value="{{$user->profile->expertise ?? ''}}"><br>
    <p>Description:</p>
    <textarea name="desc" id="" cols="30" rows="10">
 {{$user->profile->name ?? ''}}
    </textarea>
    <br>
    <input type="file" name="image" id=""><br>
    <input type="submit" value="Submit">
    </form>
</body>
</html>