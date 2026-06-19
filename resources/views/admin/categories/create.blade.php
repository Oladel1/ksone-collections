@extends('admin.layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('content')
<div class="max-w-2xl">
    @include('admin.categories._form', ['category' => null])
</div>
@endsection
