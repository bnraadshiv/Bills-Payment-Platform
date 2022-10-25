@extends('template.master')



@section('content')
<h2>Profile Page</h2>


<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                <img class="img-account-profile rounded-circle mb-2" src="{{$user->avatar_url}}" alt="" style="width: 100px;"/>
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                <!-- Profile picture upload button-->
                {!! Form::open(['route' => 'customer_update_profile_image', 'files' => true] ) !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                    <button class="btn btn-primary" type="submit">Upload new image</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                {!! Form::open(['route' => 'customer_update_profile']) !!}
                        <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="first_name">First name</label>
                            {!! Form::text('first_name', $user->first_name, ['class' => 'form-control'])!!}
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="last_name">Last name</label>
                            {!! Form::text('last_name', $user->last_name, ['class' => 'form-control'])!!}
                        </div>
                    </div>
                    <!-- Form Row        -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">Email</label>
                            {!! Form::email('email', $user->email, ['class' => 'form-control'])!!}
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="email">Phone Number</label>
                            {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control'])!!}
                        </div>
                    </div>
                    
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection