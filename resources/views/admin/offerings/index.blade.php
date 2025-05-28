@extends('layouts.master')

@section('title', 'Offering')

@section('content')
    <div class="section-header">
        <h1>Offering</h1>
    </div>
    <div class="section-body">
        <div class="section-title-lead-wrapper">
            <div class="section-title">
                <span class="toggle-indicator inactive"></span>
                <h2 class="section-title-text">Offering List</h2>
            </div>
            <p class="section-lead">
                In this section you can manage system Offering data such as editing and show detail.
            </p>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('admin.offerings.index') }}" method="GET" id="searchForm">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Search Applicant" value="{{ $search ?? '' }}">
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Opportunity</th>
                            <th>Action</th>
                            <th>Notification</th>
                            <th>Staff</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $index => $applicant)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $applicant->fullname }}</td>
                                <td>{{ $applicant->opportunity->name ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.offerings.show', $applicant->id) }}"
                                        class="btn btn-icon btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.offerings.edit', $applicant->id) }}"
                                        class="btn btn-icon btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    @if (
                                        $applicant->Offering &&
                                            $applicant->Offering->benefit !== '-' &&
                                            $applicant->Offering->selection_result !== '-' &&
                                            !empty($applicant->Offering->deadline_offering) &&
                                            $applicant->Offering->offering_result !== '-')
                                        <form action="{{ route('admin.offerings.sendNotification', $applicant->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Kirim notifikasi untuk {{ $applicant->fullname }}?');">
                                            @csrf
                                            <button class="btn btn-sm btn-success" type="submit">
                                                Send Notification
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $applicant->offering?->staff?->name ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Pagination --}}
                <div class="custom-pagination-wrapper">
                    {{ $applicants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .section-header {
            background-color: white;
            color: rgb(59, 59, 59);
            font-weight: bold;
            padding: 1.1rem;
            vertical-align: middle;
            height: 80px;
        }

        .section-header h1 {
            font-size: 24px;
            line-height: 50px;
        }

        .section-title-lead-wrapper {
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            margin-top: 1rem;
        }

        .toggle-indicator {
            width: 28px;
            height: 8px;
            background-color: rgb(122, 138, 227);
            border-radius: 7.5px;
            margin-right: 0.5rem;
        }

        .section-title-text {
            font-size: 18px;
            font-weight: normal;
            color: #020202;
            margin-bottom: 0;
        }

        .section-lead {
            font-size: 1rem;
            color: #868e96;
            margin-bottom: 0;
            margin-left: calc(28px + 0.5rem);
            /* Margin kiri sebesar lebar toggle + jaraknya */
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 0.25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .badge {
            border-radius: 0.25rem;
            font-size: 0.875rem;
            padding: 0.35em 0.65em;
        }

        /* Wrapper untuk pagination Laravel bawaan */
        .custom-pagination-wrapper nav {
            display: flex;
            justify-content: right;
            align-items: right;
        }

        .custom-pagination-wrapper .page-item {
            margin: 0 4px;
            /* Jarak antar tombol */
        }

        .custom-pagination-wrapper .page-link {
            display: flex;
            min-width: 40px;
            /* Lebar minimum tombol */
            height: 40px;
            /* Tinggi tombol */
            padding: 0;
            /* Hapus padding default */
            border-radius: 8px !important;
            /* Sudut membulat */
            color: #ffffff !important;
            /* Warna teks default */
            background-color: #6a5acd !important;
            /* Warna latar belakang default */
            border: 1px solid #6a5acd !important;
            /* Border tipis */
            transition: all 0.3s ease;
            /* Transisi halus untuk hover */
            font-weight: 500;
            font-size: 16px;
            /* Ukuran font untuk angka */
            line-height: 1;
            /* Penting untuk memastikan teks/ikon tidak terlalu besar */
        }

        /* Gaya untuk tombol aktif */
        .custom-pagination-wrapper .page-item.active .page-link {
            /* .relative { */
            background-color: #ffffff !important;
            border-color: #ffffff !important;
            color: #6a5acd !important;
        }

        /* Sembunyikan tombol pagination versi mobile */
        .flex.justify-between.flex-1.sm\:hidden {
            display: none !important;
        }

        .dataTables_info {
            display: none !important;
        }


        /* Untuk Font Awesome */
        span.icon,
        /* Untuk ikon generik */
        svg

        /* Untuk ikon SVG */
            {
            font-size: inherit;
            /* Mengambil ukuran font dari parent */
            width: 1em;
            /* Mengatur ulang lebar */
            height: 1em;
            /* Mengatur ulang tinggi */
            max-width: 100%;
            /* Batasi agar tidak melebihi parent */
            max-height: 100%;
            /* Batasi agar tidak melebihi parent */
        }
    </style>
@endpush
