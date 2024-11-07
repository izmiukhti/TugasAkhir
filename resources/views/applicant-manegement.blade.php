@extends('layouts.master')

@section('title', 'Applicant Management')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
<section class="section">
    @livewire('applicants')
</section>
@endsection
