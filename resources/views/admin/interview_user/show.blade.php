@extends('layouts.master')

@section('title', 'Show HR Interviews')

@section('content')
    <div class="section-header">
        <h1>Interview User</h1>
    </div>
    <div class="section-body">
        <div class="section-title-lead-wrapper">
            <div class="section-title">
                <span class="toggle-indicator inactive"></span>
                <h2 class="section-title-text">Interview User Detail</h2>
            </div>
            <p class="section-lead">In this section you can show details of the Interview User.</p>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label for="fullname">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $applicant->fullname ?? '') }}" disabled>
            </div>
            <div class="form-group">
                <label for="skor">Score</label>
                <input type="text" class="form-control" id="score" value="{{ $interviewUser->score }}" disabled>
            </div>
            <div class="form-group">
                <label>Decision</label>
                <input type="text" class="form-control" value="{{ $interviewUser->decision->name ?? '-' }}" disabled>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" style="height: 150px" disabled>{{ $interviewUser->notes }}</textarea>
            </div>
            <div class="form-group">
                <label>Interview Date:</label>
                <p>
                    {{ $interviewUser->event_date ? \Carbon\Carbon::parse($interviewUser->event_date)->format('d M Y, H:i') : '-' }}
                </p>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" value="{{ $interviewUser->location }}" disabled>
            </div>
            <div class="buttons">
                <a href="{{ route('admin.interview_user.index') }}" class="btn btn-primary">Back</a>
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
    </style>
@endpush
