<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
</head>
<body>
<h1>Data</h1>
<ul>
    @foreach ($data as $item)
        <li>{{ $item->name }}</li>
    @endforeach
</ul>
</body>
</html>