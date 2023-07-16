@extends('admin.layouts.base')

@section('contents')
    @php
        //dd($projects);
    @endphp

    <div class="d-flex align-items-center">
        <div class="icon_plus">
            <a class="text-dark" href="{{ route('admin.technologies.create') }}">
                <i class="fa-sharp fa-solid fa-plus"></i>
            </a>
        </div>
        <h1 class="page-title">TECHNOLOGIES</h1>
    </div>
    @if (session('delete_success'))
        <div class="alert alert-danger">
            Technology "{{ session('delete_success')->name }}" was deleted.
        </div>
    @endif

    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr class="fs-5 text-center text-align">
            <th class="col">Title</th>
            <th class="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($technologies as $technology)
            <tr>
                <td class="text-align text-center fw-bold fs-6">
                    {{ $technology->name }}
                </td>
                <!--    CRUD ACTIONS     -->
                <td class="text-align text-center">
{{--                    <a href="{{ route('admin.projects.edit', ['project' => $project->id]) }}" class="btn btn-warning btn-sm fs-6">Edit</a>--}}
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $technology->id }}">
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
                    <span>DELETING TECHNOLOGY WILL DETACH IT FROM ALL PROJECTS THAT CONTAIN THIS TECHNOLOGY.</span>
                    <br> <span class="text-danger fw-bold">ARE YOU SURE?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.technologies.destroy', ['technology' => '*****']) }}"
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

    {{ $technologies->links() }}

@endsection
