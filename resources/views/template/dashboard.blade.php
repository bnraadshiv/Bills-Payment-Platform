@extends('template.master')

{{--@section('title', 'Dashboard') --}}
@section('title', $title)

@section('content')

{!! $description !!}



@endsection




@section('js_script')

    <script>
        alert('holy');
    </script>
@endsection