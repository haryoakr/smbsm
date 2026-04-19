<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create a Jurnal</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>


        @endif
    </div>
    <form method="post" action="{{route('jurnal.store')}}">
        @csrf 
        @method('post')
        <div>
            <label>Judul</label>
            <br>
            <input type="text" name="judul" size="130"/>
        </div>
        <div>
            <label>Abstrak</label>
            <br>
            <textarea type="text" class="form-control" name="abstrak" rows="20" cols="120"></textarea>

        </div>
        <div>
            <input type="submit" value="Save a New Jurnal" />
        </div>
    </form>
</body>
</html>