@extends('layouts.master')

@section('title', 'Dashboard')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                @livewire('count-opportunity')
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                @livewire('count-active-opportunity')
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                @livewire('count-deactive-opportunity')
            </div>
        </div>
    </div>
</section>
@endsection
