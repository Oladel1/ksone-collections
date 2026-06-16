@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="max-w-4xl" x-data="{ activeTab: '{{ array_key_first($groups->toArray()) }}' }">

    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Site Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Edit each section of your website</p>
    </div>

    @if (session('success'))
        <div class="mb-5 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-800">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200 mb-6 overflow-x-auto">
        <nav class="flex gap-1 -mb-px min-w-max">
            @foreach ($groups as $group => $settings)
                <button type="button"
                        @click="activeTab = '{{ $group }}'"
                        :class="activeTab === '{{ $group }}'
                            ? 'border-[#B8860B] text-[#B8860B]'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="px-4 py-3 text-sm font-medium border-b-2 transition-colors whitespace-nowrap">
                    {{ $groupLabels[$group] ?? ucfirst($group) }}
                </button>
            @endforeach
        </nav>
    </div>

    {{-- Tab Content --}}
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        @foreach ($groups as $group => $settings)
            <div x-show="activeTab === '{{ $group }}'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-6">

                <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6">
                    <div class="mb-5">
                        <h3 class="font-bold text-gray-900">{{ $groupLabels[$group] ?? ucfirst($group) }}</h3>
                        <p class="text-sm text-gray-400 mt-1">Manage the {{ strtolower($groupLabels[$group] ?? $group) }} content</p>
                    </div>

                    <div class="space-y-5">
                        @foreach ($settings as $setting)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ $setting->label }}</label>

                                @if ($setting->type === 'textarea')
                                    <textarea name="settings[{{ $setting->key }}]" rows="3"
                                              class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none resize-vertical">{{ $setting->value }}</textarea>
                                @elseif ($setting->type === 'image')
                                    @if ($setting->value)
                                        <div class="flex items-center gap-3 mb-2">
                                            <img src="{{ asset('images/' . $setting->value) }}" alt="Current" class="w-16 h-16 rounded-lg object-cover border">
                                            <span class="text-xs text-gray-400">{{ $setting->value }}</span>
                                        </div>
                                    @endif
                                    <input type="file" name="setting_files[{{ $setting->key }}]" accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#B8860B]/10 file:text-[#B8860B]">
                                    {{-- Keep existing value if no new upload --}}
                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                @else
                                    <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}"
                                           class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                        Save Settings
                    </button>
                    <span class="text-xs text-gray-400">Saves all sections at once</span>
                </div>
            </div>
        @endforeach
    </form>
</div>
@endsection
