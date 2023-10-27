@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Crew List | Documents') }}</div>
                    <div class="card-body">
                        <dashboard-show id="{{ $id }}" crew="{{ $crew }}"></dashboard-show>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
