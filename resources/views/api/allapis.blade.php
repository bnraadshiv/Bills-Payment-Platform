<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2>All API</h2>

    No of APIs: {{ count($apis)}}

    <table>
        <thead>
            <th>API ID</th>
            <th>Provider Name</th>
            <th>Date Created</th>
        </thead>
    <tbody>
    @foreach ($apis as $api)


        <tr>
            <td>{{ $api->id }}</td>
            {{--<td>{{ $product->category->name ? $product->category->name  : 'No Category Found' }}</td> --}}
            <td>{{ $api->providerName }}</td>
            <td>{{ $api->created_at }}</td>
            <td><a href="{{ route('singleApi', [$api->id]) }}">View</a></td>
        </tr>


        
        
    @endforeach

    </tbody>
    
</body>
</html>