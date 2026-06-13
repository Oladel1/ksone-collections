@extends('admin.layouts.admin')

@section('title', 'Roles')
@section('page-title', 'Roles & Permissions')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Roles</h2>
            <p class="text-sm text-gray-500 mt-1">Manage roles and their permissions</p>
        </div>
        @if (auth()->user()->hasPermission('create-roles'))
            <a href="{{ route('admin.roles.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Role
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($roles as $role)
            <div class="bg-white rounded-xl border border-gray-200/80 p-5 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-gray-900">{{ $role->name }}</h3>
                        @if ($role->is_system)
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-700 uppercase">System</span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-400">{{ $role->users_count }} {{ Str::plural('user', $role->users_count) }}</span>
                </div>

                <p class="text-sm text-gray-500 mb-4">{{ $role->description ?? 'No description' }}</p>

                {{-- Permission badges --}}
                <div class="flex flex-wrap gap-1 mb-4">
                    @if ($role->slug === 'super-admin')
                        <span class="px-2 py-0.5 rounded-md text-xs font-medium bg-[#B8860B]/10 text-[#B8860B]">All Permissions</span>
                    @else
                        @foreach ($role->permissions->take(4) as $perm)
                            <span class="px-2 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-600">{{ $perm->name }}</span>
                        @endforeach
                        @if ($role->permissions->count() > 4)
                            <span class="px-2 py-0.5 rounded-md text-xs font-medium bg-gray-50 text-gray-400">+{{ $role->permissions->count() - 4 }} more</span>
                        @endif
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                    @if (auth()->user()->hasPermission('edit-roles'))
                        <a href="{{ route('admin.roles.edit', $role) }}"
                           class="text-xs font-semibold text-[#B8860B] hover:underline">Edit</a>
                    @endif
                    @if (auth()->user()->hasPermission('delete-roles') && !$role->is_system)
                        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                              onsubmit="return confirm('Delete role {{ $role->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-500 hover:underline">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
