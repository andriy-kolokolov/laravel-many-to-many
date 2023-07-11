@extends('admin.layouts.base')

@section('contents')
@php
//dd($projects);
@endphp
    <h1>Projects</h1>
{{--    @php $project = session('delete_success') @endphp   --}}
    @if (session('delete_success'))
        <div class="alert alert-danger">
            Project "{{ session('delete_success')->title }}" was deleted.
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            Project "{{ session('success') }}" was added successfully.
        </div>
    @endif

    <table class="table table-secondary table-hover table-rounded">
        <thead>
        <tr class="fs-5 text-center text-align">
            <th class="col-1">Title</th>
            <th class="col-2">Type <br><span class="text-success">(one-to-many)</span></th>
            <th class="col-2">Programming Languages <br><span class="text-success">(many-to-many)</span></th>
            <th class="col-1">Frameworks <br><span class="text-success">(one-to-many)</span></th>
            <th class="col-2">Description</th>
            <th class="col-1">Project URL</th>
            <th class="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr class="">
                <td class="text-align text-center fw-bold fs-6">{{ $project->title }}</td>
                <td class="text-align text-center">
{{--                    {{ $project->types->pluck('type')->implode(', ') }}--}}
                    @foreach($project->types as $type)
                        {{ $type->type }}<br>
                    @endforeach
                </td>
                <td class="text-align text-center">
{{--                    {{ $project->programmingLanguages->pluck('programming_language')->implode(', ') }}--}}
                    @foreach($project->programmingLanguages as $language)
                        {{ $language->programming_language }}<br>
                    @endforeach
                </td>
                <td class="text-align text-center">
{{--                    {{ $project->frameworks->pluck('framework')->implode(', ') }}--}}
                    @foreach($project->frameworks as $framework)
                        {{ $framework->framework }}<br>
                    @endforeach
                </td>
                <td class="text-align">{{ $project->description }}</td>
                <td class="text-align text-center"><a href="{{ $project->project_url }}" target="_blank">Show on GitHub</a></td>
                <!--    CRUD ACTIONS     -->
                <td class="text-align text-center">
                    <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}" class="btn btn-success btn-sm fs-6">View</a>
                    <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning btn-sm fs-6">Edit</a>
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->id }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{ $projects->links() }}

@endsection
