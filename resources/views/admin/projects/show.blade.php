@extends('admin.layouts.base')

@section('contents')

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header fs-4 fw-bold">Project Details</div>
                <div class="card-body">
                    @if($project->image)
                    <div class="mb-4 d-flex justify-content-center">
                        <div class="project-img-wrapper">
                              <img src="{{ asset('storage/' . $project->image) }}">
                        </div>
                    </div>
                    @endif
                    <div class="mb-4">
                        <strong>Title:</strong> {{ $project->title }}
                    </div>
                    <div class="mb-4">
                        <strong>Type:</strong> {{ $project->type->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Programming Languages:</strong>
                        {{ implode(', ', $project->programmingLanguages->pluck('name')->toArray()) }}
                    </div>
                    <div class="mb-4">
                        <strong>Technologies:</strong>
                        {{ implode(', ', $project->technologies->pluck('name')->toArray()) }}
                    </div>
                    <div class="mb-4">
                        <strong>Description:</strong> {{ $project->description }}
                    </div>
                    <div class="mb-4">
                        <strong>Project URL:</strong> <a href="{{ $project->project_url }}">{{ $project->project_url }}</a>
                    </div>
                    <a href="{{ route('admin.projects.index') }}">
                        <button class="mt-3 btn btn-primary mt-2 mb-4">Back to Projects</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
