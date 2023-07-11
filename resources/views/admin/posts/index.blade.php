@extends('admin.layouts.base')

@section('contents')

    <h1>Projects</h1>

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

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Image url</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->url_image }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post]) }}">Edit</a>
                        <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $post->id }}">
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
