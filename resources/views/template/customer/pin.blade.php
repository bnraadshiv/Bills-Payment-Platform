@extends('template.master')


@section('content')

<div class="row">
    <div class="col-lg-8">


        <!-- Pin Creation-->
        @if(empty($user->pin))
        <div class="card mb-4">
            <div class="card-header">Setup Transaction Pin</div>
            <div class="card-body">
                {!! Form::open(['route' => 'createPinAction']) !!}
                    <!-- Form Group (Enter Pin)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="pin">Enter Pin</label>
                        {!! Form::password('pin', ['class' => 'form-control']) !!}
                    </div>
                    <!-- Form Group (Enter Pin Again)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="pin_confirmation">Confirm Pin</label>
                        {!! Form::password('pin_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                {!! Form::close() !!}
            </div>
        </div>

        @else


        <!-- Pin Update-->
        <div class="card mb-4">
            <div class="card-header">Update Transaction Pin</div>
            <div class="card-body">
                {!! Form::open(['route' => 'customer_updatePin']) !!}
                    <!-- Form Group (current Pin)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="old_pin">Current Pin</label>
                        {!! Form::password('old_pin', ['class' => 'form-control']) !!}
                    </div>
                    <!-- Form Group (new Pin)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="new_pin">New Pin</label>
                        {!! Form::password('new_pin', ['class' => 'form-control']) !!}
                    </div>
                    <!-- Form Group (confirm Pin)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="new_pin_confirmation">Confirm New Pin</label>
                        {!! Form::password('new_pin_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                {!! Form::close() !!}
            </div>
        </div>

        @endif

    </div>
</div>


@endsection