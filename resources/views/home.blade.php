@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Crew Lists | Dashboard') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <dashboard-view></dashboard-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
