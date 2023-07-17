@extends('admin.layouts.base')

@section('contents')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">ADD NEW LANGUAGE</h3>
                    <a href="{{ route('admin.projects.index') }}">
                        <button class="mt-3 btn btn-primary mt-2 mb-4">Back to Projects</button>
                    </a>
                    <form method="POST" action="{{ route('admin.languages.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="mt-3 btn btn-success">Add language</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
