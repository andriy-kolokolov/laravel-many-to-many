@extends('admin.layouts.base')

@section('contents')

    @include(
    'admin.includes.page-sub-header',
    [
    'pageTitle' => 'LANGUAGES',
    'managingEntity' => 'language',
    'addableEntity' => true
    ])

    @if (session('success'))
        <div class="alert alert-success">
            Language "{{ session('success')->name }}" was added successfully.
        </div>
    @endif

    @if (session('delete_success'))
        <div class="alert alert-danger">
            Language "{{ session('delete_success')->name }}" was deleted.
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr class="fs-5 text-center text-align">
                <th class="col-6">Title</th>
                <th class="col-6">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($languages as $language)
            <tr class="text-center text-align">
                <td class="text-align text-center fw-bold fs-6">{{ $language->name }}</td>
                <!--    CRUD ACTIONS     -->
                <td class="text-align text-center d-flex justify-content-center">
                    <div class="d-flex flex-row admin-action-buttons">
                        <div class="action-button">
                            <div type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                 data-bs-title="Delete {{ $language->name }} language from projects">
                                <div type="button" class="js-delete" data-bs-toggle="modal"
                                     data-bs-target="#deleteModal"
                                     data-id="{{ $language->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </div>
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
                    <span>DELETING LANGUAGE WILL DETACH IT FROM ALL PROJECTS THAT CONTAIN IT.</span>
                    <br> <span class="text-danger fw-bold">ARE YOU SURE?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.languages.destroy', ['language' => '*****']) }}"
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

    {{ $languages->links() }}

@endsection
