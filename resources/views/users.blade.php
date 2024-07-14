@extends('layouts.master')

@section('title', 'User Management')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<section class="section">
    @livewire('user')
</section>
@endsection
