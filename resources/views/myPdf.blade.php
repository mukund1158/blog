<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-evenly">
            <div class="col-md-10">
    <h1>User Details</h1><br><br>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Image</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        @foreach($datas as $data)
        <tbody>
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>
                    @foreach($data->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </td>

                <td>
                    @if($data['image'])
                    <img src="{{public_path('storage/upload/user/'.$data['image'])}}" alt="Avtar" style="width: 50px; height: 50px">
                    @endif
                </td>

                <td>{{ $data['created_at'] }}</td>
                <td>{{ $data['updated_at'] }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>