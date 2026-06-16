@extends('admin.layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Admin Users</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $users->total() }} users</p>
        </div>
        @if (auth()->user()->hasPermission('create-users'))
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add User
            </a>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">User</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Role</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Last Login</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50/50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#B8860B]/10 flex items-center justify-center">
                                    <span class="text-xs font-bold text-[#B8860B]">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                {{ $user->role->slug === 'super-admin' ? 'bg-purple-100 text-purple-800' : ($user->role->slug === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $user->role->name }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            @if ($user->is_active)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span> Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500 text-xs">
                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                @if (auth()->user()->hasPermission('edit-users'))
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-xs font-semibold text-[#B8860B] hover:underline">Edit</a>
                                @endif
                                @if (auth()->user()->hasPermission('edit-users') && $user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.reset-password', $user) }}"
                                          onsubmit="return confirm('Reset password for {{ $user->name }}? A temporary password will be generated.')">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold text-blue-500 hover:underline">Reset PW</button>
                                    </form>
                                @endif
                                @if (auth()->user()->hasPermission('delete-users') && $user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Delete user {{ $user->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-red-500 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $users->links() }}</div>
</div>
@endsection
