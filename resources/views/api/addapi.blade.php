<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Add API</h2>

    @if(session('success')) 
        {{session('success')}}
    
    @elseif(session('failed'))
        {{session('failed')}}    
    
    @endif

    
    {!! Form::open(['route' => 'apiadder']) !!}

        {!! Form::label('providerName', 'Provider Name') !!}
        {!! Form::text('providerName') !!}


        {!! Form::submit('Click Me!') !!}
    
    {!! Form::close() !!}
    


</body>
</html>