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
    <div class="section-header">
        <h1>User Management</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">User List</h2>
        <p class="section-lead">In this section you can manage system user data such as adding, changing and deleting.</p>
    </div>
</section>
@endsection
