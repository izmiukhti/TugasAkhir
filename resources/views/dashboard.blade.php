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
            <div class="col-3">
                @livewire('count-opportunity')
            </div>
        </div>
    </div>
</section>
@endsection
