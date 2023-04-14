<!DOCTYPE html>
<html>
<head>
    <title>View Student Records</title>
</head>

<body>
    <table>
    <thead>
    <tr>
    <th scope='col'>Id</th>
    <th scope='col'>Title</th>
    <th scope='col'>Year</th>
    <th scope='col'>imdbID</th>
    <th scope='col'>Type</th>
    <th scope='col'>Poster</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($movies as $movie)
    <tr>
    <td>{{ $movie->id }}</td>
    <td>{{ $movie->title }}</td>
    <td>{{ $movie->year }}</td>
    <td>{{ $movie->imdbID }}</td>
    <td>{{ $movie->type }}</td>
    <td>{{ $movie->poster }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
</body>
</html> 