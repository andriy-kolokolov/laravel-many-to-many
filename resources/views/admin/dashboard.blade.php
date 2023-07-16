@php $user = Auth::user(); @endphp

@extends('admin.layouts.base')

@section('contents')

    <div class="text-center text-align">
        <h1 class="page-title">
            Welcome , {{ $user->name }} !
        </h1>
    </div>

@endsection
