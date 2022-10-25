@extends('template.master')


@section('content')

<div class="row">
    <div class="col-lg-8">
        <!-- Change password card-->
        <div class="card mb-4">
            <div class="card-header">Change Password</div>
            <div class="card-body">
                {!! Form::open(['route' => 'customer_update_passwordAction']) !!}
                    <!-- Form Group (current password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="old_password">Current Password</label>
                        {!! Form::password('old_password', ['class' => 'form-control']) !!}
                    </div>
                    <!-- Form Group (new password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="new_password">New Password</label>
                        {!! Form::password('new_password', ['class' => 'form-control']) !!}
                    </div>
                    <!-- Form Group (confirm password)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="new_password_confirmation">Confirm New Password</label>
                        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <div class="col-lg-4">
        <!-- Two factor authentication card-->
        <div class="card mb-4">
            <div class="card-header">Two-Factor Authentication</div>
            <div class="card-body">
                <p>Add another level of security to your account by enabling two-factor authentication. We will send you a text message to verify your login attempts on unrecognized devices and browsers.</p>
                <form>
                    <div class="form-check">
                        <input class="form-check-input" id="twoFactorOn" type="radio" name="twoFactor" checked="">
                        <label class="form-check-label" for="twoFactorOn">On</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" id="twoFactorOff" type="radio" name="twoFactor">
                        <label class="form-check-label" for="twoFactorOff">Off</label>
                    </div>
                    <div class="mt-3">
                        <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                        <input class="form-control" id="twoFactorSMS" type="tel" placeholder="Enter a phone number" value="555-123-4567">
                    </div>
                </form>
            </div>
        </div>
        <!-- Delete account card-->
        <div class="card mb-4">
            <div class="card-header">Delete Account</div>
            <div class="card-body">
                <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my account</button>
            </div>
        </div>
    </div>
</div>


@endsection