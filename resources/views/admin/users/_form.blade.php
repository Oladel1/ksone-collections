@php $isEdit = !is_null($user); @endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}"
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
        <h3 class="font-bold text-gray-900">{{ $isEdit ? 'Edit' : 'Create' }} User</h3>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
            <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none"
                   placeholder="e.g. johndoe" required>
            <p class="text-xs text-gray-400 mt-1">Used for login. Letters, numbers, dots, and underscores only.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password {{ $isEdit ? '(leave blank to keep current)' : '*' }}
            </label>
            <input type="password" name="password"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none"
                   {{ $isEdit ? '' : 'required' }}>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
            <select name="role_id" class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}
                        {{ $role->slug === 'super-admin' && !auth()->user()->isSuperAdmin() ? 'disabled' : '' }}>
                        {{ $role->name }} — {{ $role->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <label class="flex items-center gap-2 cursor-pointer">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-gray-300 text-[#B8860B] focus:ring-[#B8860B]/20">
            <span class="text-sm font-medium text-gray-700">Active</span>
        </label>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
            {{ $isEdit ? 'Update User' : 'Create User' }}
        </button>
        <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>
