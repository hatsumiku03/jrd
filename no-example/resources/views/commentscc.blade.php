<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create comment</title>
</head>
<body>
    <h2>Make a comment</h2>

    <form method=POST action="/comments">
        @csrf
    <input type="text" name="comment">
    <input type="submit" value="Enviar">
    </form>
    <p>
        Back to the comments section
        <br>
        <a href="http://0.0.0.0/comments">click here</a>
    </p>
</body>
</html>
