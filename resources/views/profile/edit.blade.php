@extends('layouts.dashboard')
@section('title', 'Account Settings')

@section('content')

<section class="py-20 max-w-4xl mx-auto px-6 space-y-16">

    <!-- Header -->
    <header class="space-y-6 max-w-4xl">
        <p class="text-xs uppercase tracking-widest text-muted">
            dashboard / account
        </p>

        <h1 class="text-[clamp(2.5rem,6vw,3.5rem)] font-semibold leading-tight">
            Account Settings
            <span class="block text-muted font-normal text-lg mt-2">
                Manage your profile information and security
            </span>
        </h1>
    </header>

    <!-- Profile Information -->
    <div class="border border-border bg-surface p-8 space-y-6">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Update Password -->
    <div class="border border-border bg-surface p-8 space-y-6">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete Account -->
    <div class="border border-red-500/40 bg-surface p-8 space-y-6">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</section>

@endsection
