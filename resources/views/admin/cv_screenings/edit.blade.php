@extends('layouts.master')

@section('title', 'Edit CV Screening')

@section('content')
    <div class="section-header">
        <h1>CV Screening</h1>
    </div>
    <div class="section-body">
        <div class="section-title-lead-wrapper">
            <div class="section-title">
                <span class="toggle-indicator inactive"></span>
                <h2 class="section-title-text">Screening CV</h2>
            </div>
            <p class="section-lead">In this section you can editing of the CV.</p>
        </div>

        <div class="card-body">
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
            <div class="row">
                <div class="col-12">
                    @if ($applicant->cv_file)
                        <div
                            style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                            @php
                                $filePath = Storage::url($applicant->cv_file);
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if ($fileExtension === 'pdf')
                                <iframe src="{{ $filePath }}" width="100%" height="1000px"
                                    style="border: none;"></iframe>
                            @elseif (in_array($fileExtension, ['doc', 'docx']))
                                <iframe src="https://docs.google.com/viewer?url={{ urlencode($filePath) }}&embedded=true"
                                    width="100%" height="700px" style="border: none;"></iframe>
                            @else
                                <p>Preview is not available for this file format.</p>
                                <a href="{{ url($filePath) }}" class="btn btn-primary" download>Download CV</a>
                            @endif
                        </div>
                    @else
                        <p class="text-center">No CV was uploaded.</p>
                    @endif
                </div>
            </div>

            <div class="section-header">
                <h1>Screening CV</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.cv_screenings.update', $cvScreening->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="score">Score</label>
                                <input type="text" class="form-control" id="score" name="score"
                                    value={{ $cvScreening->score }}>
                                @error('score')
                                    <i>{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Decision</label>
                                <select name="decision_id" class="form-control">
                                    @foreach ($decisions as $decision)
                                        <option value="{{ $decision->id }}"
                                            {{ isset($applicant->cvScreening) && $applicant->cvScreening->decision_id == $decision->id ? 'selected' : '' }}>
                                            {{ $decision->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('decision_id')
                                    <i>{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" style="height: 150px">{{ $cvScreening->notes }}</textarea>
                                @error('notes')
                                    <i>{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="buttons">
                                <a href="{{ route('admin.cv_screenings.index') }}" class="btn btn-primary">Back</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
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
    </style>
@endpush
