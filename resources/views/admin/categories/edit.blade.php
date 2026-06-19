@extends('admin.layouts.admin')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
<div class="max-w-2xl">
    @include('admin.categories._form', ['category' => $category])
</div>
@endsection
