<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <a href= "{{url('/login')}}">Login</a>

    @if(session('success'))
        <div class="alert alert-success"></div>
            {{session('success')}}
        </div>

    @endif

    {!! Form::open(['url' => 'register']) !!}

    <div>
        <label for="">name</label>
        {!!Form::text('name') !!}
    </div>

    <div>
        <label for="">Email</label>
        {!! Form::text('email')!!}
    </div>

    <div>
        <label for="">Phone Number</label>
        {!! Form::text('phone_number')!!}
    </div>

    <div>
        <label for="">Password</label>
        {!! Form::password('password') !!}
    </div>

    <div>
        <button type="submit">Register

        </button>
    </div>


    {!! Form::close() !!}

    <hr>

    No of users: {{$no_of_users}}

    <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>password</th>
        </thead>
    <tbody>
    @foreach ($users as $user)


        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->password }}</td>
        </tr>



        
    @endforeach

    </tbody>
</table>
    
</body>
</html>