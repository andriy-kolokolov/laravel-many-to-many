@php
$createRoot = str_replace(['index', 'create', 'edit'], 'create', Route::currentRouteName())
@endphp
<div class="d-flex flex-row justify-content-between">
    <div class="d-flex align-items-center">
        <h1 class="page-title">{{ $pageTitle }}</h1>
    </div>
    <div class="d-flex justify-content-center align-items-center" type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add new project">
        <div class="ms-3 icon_plus">
            <a href="{{ route($createRoot) }}">
                <i class="fa-sharp fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>
