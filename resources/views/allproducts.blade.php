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

    <table border="1">
        <thead>
            <th></th>
            <th>Product Name</th>
            <th>Categories</th>
            <th>Status</th>
            <th>Provider </th>
            <th>Descirption</th>
            <th>action</th>
        </thead>
    <tbody>
    @foreach ($products as $product)


        <tr>
            <td>
                <img src="{{ $product->image_url }}" alt="" width="100">
            </td>
            <td>{{ $product->name }}
                @if(!empty($product->deleted_at))
                    <span style="color: red">[Deleted]</span>
                @endif
                </td>
            {{--<td>{{ $product->category->name ? $product->category->name  : 'No Category Found' }}</td> --}}
            {{-- <td>{{ $product->category->name ??  'No Category Found' }}</td> --}}
            <td>{{ $product->category_name ??  'No Category Found' }}</td> {{--Mutated this attribute from the model--}}
            <td>{{ $product->status }}</td>
            <td>{{ $product->provider->name ?? 'No API Provider'}}</td>
            
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{url('view-product', $product->id)}}">View</a>
                <a href="{{route('view-single-product', ['id' => $product->id])}}">View</a>
                <a href="{{route('delete-single-product', ['id' => $product->id])}}">Delete</a>
            </td>
        </tr>


        
        
    @endforeach

    </tbody>

</body>
</html>