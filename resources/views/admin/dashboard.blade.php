@php $user = Auth::user(); @endphp

@extends('admin.layouts.base')

@section('contents')

    <h2 class="">
        Welcome , {{ $user->name }} !
    </h2>

@endsection
