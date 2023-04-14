<!DOCTPE html>
<html>
<head>
<title>View Student Records</title>
</head>
<body>
<table border="1">
<tr>
<td>Id</td>
<td>Title</td>
<td>Year</td>
<td>imdbID</td>
<td>Type</td>
<td>Poster</td>
</tr>
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
</table>
</body>
</html>