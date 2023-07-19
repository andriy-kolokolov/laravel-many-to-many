@extends('admin.layouts.base')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Add New Project</h2>
                    <a href="{{ route('admin.projects.index') }}">
                        <button class="mt-3 btn btn-primary mt-2 mb-4">Back to Projects</button>
                    </a>
                    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

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
                            <label for="type">Project type:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Select a project type..</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type['name'] }}" {{ old('type') == $type['name'] ? 'selected' : '' }}>
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
                            <label for="programming_languages">Programming Languages (use comma for separation):</label>
                            <input type="text" class="form-control" id="programming_languages" name="programming_languages" value="{{ old('title') }}" required>
                            @error('programming_languages')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="technologies">Technologies:</label>
                            <input type="text" class="form-control" id="technologies" name="technologies" value="{{ old('title') }}" required>
                            @error('technologies')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="project_url">Project URL:</label>
                            <input type="url" class="form-control" id="project_url" name="project_url" value="{{ old('title') }}" required>
                            @error('project_url')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="mt-3 btn btn-success">Add Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
