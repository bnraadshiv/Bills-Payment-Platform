<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>All Products</h2>

    No of products: {{ $products_count }}

    <table>
        <thead>
            <th>Product Name</th>
            <th>Categories</th>
            <th>Image</th>
            <th>Status</th>
            <th>Provider API</th>
            <th>Descirption</th>
            <th>action</th>
        </thead>
    <tbody>
    @foreach ($products as $product)


        <tr>
            <td>{{ $product->product_name }}</td>
            {{--<td>{{ $product->category->name ? $product->category->name  : 'No Category Found' }}</td> --}}
            <td>{{ $product->category->name ??  'No Category Found' }}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->product_api->providerName ?? 'No API Provider'}}</td>
            
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{url('view-product', $product->id)}}">View</a>
                <a href="{{route('view-single-product', ['id' => $product->id])}}">View</a>
            </td>
        </tr>


        
        
    @endforeach

    </tbody>

</body>
</html>