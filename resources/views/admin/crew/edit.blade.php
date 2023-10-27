@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Crew') }}</div>
                    <div class="card-body">
                        <crew-edit ranks="{{ $ranks }}" crew="{{ $crew }}"></crew-edit>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
