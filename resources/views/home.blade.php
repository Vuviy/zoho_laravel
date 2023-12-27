<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body class="antialiased">


    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
            {{session('error')}}
    @endif
    <form action="{{ route('authorization') }}" method="post">
        @csrf
        <div>
            <label for="code">Code</label>
            <input type="text" id ="code" name="code">
        </div>
        <div>
            <label for="client_id">Client Id</label>
            <input type="text" id ="client_id" name="client_id">
        </div>
        <div>
            <label for="client_secret">Client Secter</label>
            <input type="text" id ="client_secret" name="client_secret">
        </div>
        <button type="submit">send</button>
    </form>
</body>
</html>
