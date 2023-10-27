@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Crew') }}</div>
                    <div class="card-body">
                        <crew-create ranks="{{ $data }}"></crew-create>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
