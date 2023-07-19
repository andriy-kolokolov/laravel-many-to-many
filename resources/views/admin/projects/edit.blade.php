@extends('admin.layouts.base')

@section('contents')
    <h1 class="text-center mb-3">EDIT PROJECT</h1>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header text-center fs-4 fw-bold text-secondary">{{ $project->title }}</div>
                <div class="card-body">
                    <a href="{{ route('admin.projects.index', ['$project' => $project]) }}">
                        <button class="mt-3 btn btn-primary mb-3">Back to Projects</button>
                    </a>
                    <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if($project->image)
                            <div class="mb-4 d-flex justify-content-center">
                                <div class="project-img-wrapper">
                                    <img src="{{ asset('storage/' . $project->image) }}">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="image" class="form-label">Project image:</label>
                            <input class="form-control" type="file" id="image" name="image">
                            @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                            value="{{ $project->title }}" required>
                            @error('title')
                            <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="type">Project type:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Select a project type..</option>

                                @foreach ($types as $type)
                                    <option value="{{ $type['name'] }}" {{ $project->type->name == $type['name'] ? 'selected' : '' }}>
                                        {{ $type['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="programming_languages">Programming Languages</label>
                            <input type="text" name="programming_languages" id="programming_languages"
                                   class="form-control"
                                   value="{{ implode(', ', $project->programmingLanguages()->pluck('name')->toArray()) }}"
                                   required>
                            @error('programming_languages')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="technologies">Technologies</label>
                            <input type="text" name="technologies" id="technologies"
                                   class="form-control"
                                   value="{{ implode(', ', $project->technologies()->pluck('name')->toArray()) }}"
                                   required>
                            @error('technologies')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4"
                                      required>{{ $project->description }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
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
