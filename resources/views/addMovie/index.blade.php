<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="addMovie">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="card bg-white shadow-lg">
                            <div class="card-body p-5">

                                @if(Session::get('success'))
                                <div class="alert alert-primary" role="alert">
                                    {{(Session::get('success'))}}
                                </div>
                                @endif

                                @if(Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{(Session::get('error'))}}
                                </div>
                                @endif

                                <form action="addMovie" id="addMovie" class="mb-3 mt-md-2" method="post">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase mb-4">Add a Movie</h2>
                                    <div class="mb-3">
                                        <label for="title" class="form-label ">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            placeholder="Enter title" value="{{ old('title')}}">
                                        <span style="color:red">@error('title'){{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="year" class="form-label ">Year</label>
                                        <input type="text" class="form-control" id="year" name="year"
                                            placeholder="Enter year" value="{{ old('year')}}">
                                        <span style="color:red">@error('year'){{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="imdbID" class="form-label ">ImdbID</label>
                                        <input type="text" class="form-control" id="imdbID" name="imdbID"
                                            placeholder="Enter imdbID" value="{{ old('imdbID')}}">
                                        <span style="color:red">@error('imdbID'){{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label ">Type</label>
                                        <input type="text" class="form-control" id="type" name="type"
                                            placeholder="Enter type" value="{{ old('type')}}">
                                        <span style="color:red">@error('type'){{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="poster" class="form-label ">Link</label>
                                        <input type="text" class="form-control" id="poster" name="poster"
                                            placeholder="Enter link" value="{{ old('poster')}}">
                                        <span style="color:red">@error('poster'){{ $message }} @enderror</span>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-outline-dark" type="submit">Add Movie</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>