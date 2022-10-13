<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
</head>
<body>

    @if(session('success'))

        <div class="alert alert-success">
            {{session('success')}}
        </div>

    @endif

    {!! Form::open(['route' => ['update-single-product', $product->id]]) !!}

    <div>
        <label for="">Product Name</label>
        {!! Form::text('product_name', $product->product_name) !!}
    </div>


    <div>
        <label for="">Image</label>
        {!! Form::text('image', $product->image) !!}
    </div>

    <div>
        <label for="">Status</label>
        {!! form::select('status', $statuses, $product->status) !!}
    </div>

    <div>
        <label for="">Description</label>
        {!! Form::text('description') !!}
    </div>
    
    <button type="submit">Create Product</button>


    {!! Form::close() !!}
    
</body>
</html>