@extends('admin.layouts.base')

@section('contents')
    @include(
    'admin.includes.page-sub-header',
    [
    'pageTitle' => 'TYPES',
    'managingEntity' => 'type',
    'addableEntity' => false
    ])
    @if (session('delete_success'))
        @dd(session('delete_success')->type)
        <div class="alert alert-danger">
            Type "{{ session('delete_success')->type }}" was deleted.
        </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr class="fs-5 text-center text-align">
                <th class="col-6">Title</th>
            </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr class="text-center text-align">
                <td class="text-align text-center fw-bold fs-6">
                    {{ $type->name }}
                </td>
        @endforeach
        </tbody>
    </table>

    {{ $types->links() }}

@endsection
