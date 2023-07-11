@extends('admin.layouts.base')

@section('contents')
    <h1 class="text-center mb-3">EDIT PROJECT</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center fs-4 fw-bold text-secondary">{{ $project->title }}</div>
                <div class="card-body">
                    <a href="{{ route('admin.projects.index') }}">
                        <button class="mt-3 btn btn-primary mb-3">Back to Projects</button>
                    </a>
                    <form method="POST" action="{{ route('admin.projects.update', $project->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   value="{{ $project->title }}" required>
                            @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" name="type" id="type" class="form-control"
                                   value="{{ implode(', ', $project->types()->pluck('type')->toArray()) }}">
                            @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="programming_languages">Programming Languages</label>
                            <input type="text" name="programming_languages" id="programming_languages"
                                   class="form-control"
                                   value="{{ implode(', ', $project->programmingLanguages()->pluck('programming_language')->toArray()) }}"
                                   required>
                            @error('programming_languages')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="frameworks">Frameworks</label>
                            <input type="text" name="frameworks" id="frameworks" class="form-control"
                                   value="{{ implode(', ', $project->frameworks()->pluck('framework')->toArray()) }}">
                            @error('frameworks')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4"
                                      required>{{ $project->description }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="project_url">Project URL</label>
                            <input type="text" name="project_url" id="project_url" class="form-control"
                                   value="{{ $project->project_url }}" required>
                            @error('project_url')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update Project</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
