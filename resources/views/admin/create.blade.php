<!doctype html>
<html>
<head>
    <title>Login Form</title>
    <style type="text/css">
        .error-message { color: red; }
    </style>
</head>

<body>
    @if (count($errors) > 0)
    <div class="error-message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="create">
        @csrf
        <p>Title<br>
            <input type="text" name="title" value=""></p>

        <p>Description<br>
            <textarea rows="5" cols="40" name="description"></textarea></p>

        <p><button type="submit">Submit</button></p>
    </form>
</body>
</html>
