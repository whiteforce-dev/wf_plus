<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('send-to-learn4good') }}" method="post">
        @csrf
        @method('POST')
        <button type="submit">send to learn4good</button>
    </form>
</body>
</html>
