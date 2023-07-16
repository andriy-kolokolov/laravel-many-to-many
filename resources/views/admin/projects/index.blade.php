@extends('admin.layouts.base')

@section('contents')
    <div class="d-flex align-items-center">
        <div class="icon_plus">
            <a href="{{ route('admin.projects.create') }}">
                <i class="fa-sharp fa-solid fa-plus"></i>
            </a>
        </div>
        <h1 class="page-title">PROJECTS</h1>
    </div>
{{--    @php $project = session('delete_success') @endphp   --}}
    @if (session('delete_success'))
        <div class="alert alert-danger">
            Project "{{ session('delete_success')->title }}" was deleted.
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            Project "{{ session('success')->title }}" was added successfully.
        </div>
    @endif

    <table class="table table-striped table-rounded">
        <thead>
        <tr class="fs-5 text-center text-align">
            <th class="col">Title</th>
            <th class="col">Type</th>
            <th class="col">Programming Languages</th>
            <th class="col">Technologies</th>
            <th class="col">Description</th>
            <th class="col">Project URL</th>
            <th class="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td class="text-align text-center fw-bold fs-6">{{ $project->title }}</td>
                <td class="text-align text-center">
                    {{ $project->type->name }}
                </td>
                <td class="text-align text-center">
                    @foreach($project->programmingLanguages as $language)
                        {{ $language->name }}<br>
                    @endforeach
                </td>
                <td class="text-align text-center">
                    @foreach($project->technologies as $technology)
                        {{ $technology->name }}<br>
                    @endforeach
                </td>
                <td class="text-align">
                    @if (strlen($project->description) > 50)
                        <div type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $project->description }}">
                            <p class="text-center fw-bold">hover for description</p>
                        </div>
                    @else
                        <p class="text-center">{{ $project->description }}</p>
                    @endif
                </td>
                <td class="text-align text-center"><a href="{{ $project->project_url }}" target="_blank">Show on GitHub</a></td>
                <!--    CRUD ACTIONS     -->
                <td class="text-align text-center">
                    <div class="row justify-content-center align-items-center admin-action-buttons">
                        <div class="col-2 action-button">
                            <a href="{{ route('admin.projects.show', ['project' => $project->id]) }}" class=""><i class="fa-solid fa-eye"></i></a>
                        </div>
                        <div class="col-2 action-button">
                            <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class=""><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                        <div class="col-2 action-button">
                            <div type="button" class="js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </div>
                        </div>
                    </div>
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
