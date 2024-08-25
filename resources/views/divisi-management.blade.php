@extends('layouts.master')

@section('title', 'Division Management')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<section class="section">
    @livewire('divisi-menu')
</section>
@endsection
