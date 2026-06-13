@extends('admin.layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
<div class="max-w-3xl space-y-6">

    <div>
        <h2 class="text-xl font-bold text-gray-900">Site Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Edit all content sections of your website</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @foreach ($groups as $group => $settings)
            <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6" x-data="{ open: true }">
                <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between">
                    <h3 class="font-bold text-gray-900">{{ $groupLabels[$group] ?? ucfirst($group) }}</h3>
                    <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                    </svg>
                </button>

                <div x-show="open" x-transition class="mt-5 space-y-4">
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
        @endforeach

        <button type="submit"
                class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
            Save All Settings
        </button>
    </form>
</div>
@endsection
