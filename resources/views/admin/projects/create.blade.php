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
                    <form method="POST" action="{{ route('admin.projects.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" name="type">
                            @error('type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="programming_languages">Programming Languages:</label>
                            <input type="text" class="form-control" id="programming_languages" name="programming_languages" required>
                            @error('programming_languages')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="frameworks">Frameworks:</label>
                            <input type="text" class="form-control" id="frameworks" name="frameworks">
                            @error('frameworks')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="project_url">Project URL:</label>
                            <input type="url" class="form-control" id="project_url" name="project_url" required>
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
