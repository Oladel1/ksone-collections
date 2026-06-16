@extends('admin.layouts.admin')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1 mb-6">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        Back to Dashboard
    </a>

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

    <form method="POST" action="{{ route('admin.password.change') }}" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6 space-y-5">
            <div>
                <h3 class="font-bold text-gray-900">Change Your Password</h3>
                <p class="text-sm text-gray-500 mt-1">Use a strong password with at least 8 characters.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Password *</label>
                <input type="password" name="current_password"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none"
                       required autofocus>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password *</label>
                <input type="password" name="password"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password *</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none"
                       required>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                Update Password
            </button>
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
        </div>
    </form>
</div>
@endsection
