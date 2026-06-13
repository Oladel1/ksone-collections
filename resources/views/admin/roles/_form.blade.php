@php $isEdit = !is_null($role); @endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
      class="space-y-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    @if ($errors->any())
        <div class="px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-800">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6 space-y-5">
        <h3 class="font-bold text-gray-900">{{ $isEdit ? 'Edit' : 'Create' }} Role</h3>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role Name *</label>
            <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="2"
                      class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none resize-vertical">{{ old('description', $role->description ?? '') }}</textarea>
        </div>
    </div>

    {{-- Permissions --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6">
        <h3 class="font-bold text-gray-900 mb-4">Permissions</h3>

        <div class="space-y-6">
            @foreach ($permissions as $group => $perms)
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">{{ ucfirst($group) }}</h4>
                    <div class="space-y-2">
                        @foreach ($perms as $perm)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                       {{ in_array($perm->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-gray-300 text-[#B8860B] focus:ring-[#B8860B]/20">
                                <span class="text-sm text-gray-700">{{ $perm->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
            {{ $isEdit ? 'Update Role' : 'Create Role' }}
        </button>
        <a href="{{ route('admin.roles.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>
