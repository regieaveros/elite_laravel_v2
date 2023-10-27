@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Crew Profile') }}</div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <crew-show id="{{ $id }}" crew="{{ $crew }}"></crew-show>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
