@extends('admin.layouts.base')

@section('contents')

    @include(
    'admin.includes.page-sub-header',
    [
    'pageTitle' => 'POSTS',
    'managingEntity' => 'post',
    'addableEntity' => true
    ])
    @if (session('delete_success'))
        @php $post = session('delete_success') @endphp
        <div class="alert alert-danger">
            Post "{{ $post->title }}" was deleted.
            {{-- <form
                action="{{ route("admin.posts.restore", ['post' => $post]) }}"
                    method="post"
                    class="d-inline-block"
                >
                @csrf
                <button class="btn btn-warning">Ripristina</button>
            </form> --}}
        </div>
    @endif

    {{-- @if (session('restore_success'))
        @php $post = session('restore_success') @endphp
        <div class="alert alert-success">
            La post "{{ $post->title }}" è stata ripristinata
        </div>
    @endif --}}

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" class="col-3 text-center text-align">Title</th>
                <th scope="col" class="text-center text-align">Image url</th>
                <th scope="col" class="text-center text-align">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td class="text-center text-align fw-bold">{{ $post->title }}</td>
                    <td class="text-center text-align">{{ $post->url_image }}</td>
                    <!--    CRUD ACTIONS     -->
                    <td class="text-align text-center d-flex justify-content-center">
                        <div class="d-flex flex-row admin-action-buttons">
                            <div class="action-button">
                                <div type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                     data-bs-title="Show post details">
                                    <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="action-button">
                                <div type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                     data-bs-title="Edit post">
                                    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="action-button">
                                <div type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                     data-bs-title="Delete post">
                                    <div type="button" class="js-delete" data-bs-toggle="modal"
                                         data-bs-target="#deleteModal"
                                         data-id="{{ $post->id }}">
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
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action=""
                        data-template="{{ route('admin.posts.destroy', ['post' => '*****']) }}"
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

    {{ $posts->links() }}

@endsection
