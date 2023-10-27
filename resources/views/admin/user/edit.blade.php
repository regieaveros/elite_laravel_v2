@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit User Type') }}</div>
                    <div class="card-body">
                        <user-edit 
                            user="{{ $user }}" 
                            usertypes="{{ $usertypes }}"
                        ></user-edit>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
