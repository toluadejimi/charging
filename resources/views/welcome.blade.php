<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Box Grid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .box {
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            color: white;
            cursor: pointer;
            display: block; /* Ensures the whole box is clickable */
            text-decoration: none; /* Removes underline from links */
        }

        .occupied {
            background-color: red;
        }

        .available {
            background-color: green;
        }

        .maintenance {
            background-color: orange;
        }
    </style>
</head>
<body class="bg-light">





<div class="container my-5">
    <div class="row g-3">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif


        @foreach($boxes as $box)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="assign-box?id={{$box['id'] }}" class="box {{ $box['status'] }}">
                    <p>BOX {{ $box['id'] }}</p>
                    <small>{{ ucfirst($box['status']) }}</small>
                </a>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
