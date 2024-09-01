<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="grid place-items-center">
        <ul class=" menu mt-8 bg-white md:menu-horizontal rounded-box">
            <li>
                <a href="{{ $user->userDetail ? route('userDetail.edit', $user->userDetail) : route('userDetail.create', $user) }}" class="font-medium text-base">
                    User Details
                </a>
            </li>
            <li>
                <a href="{{ $user->employmentInfo ? route('employmentInfo.edit', $user->employmentInfo) : route('employmentInfo.create', $user) }}" class="font-medium text-base">
                    Employment Info
                </a>
            </li>
            <li>
                <a href="{{ $user->nextOfKin ? route('nextOfKin.edit', $user->nextOfKin) : route('nextOfKin.create', $user) }}" class="font-medium text-base">
                    Next of Kin
                </a>
            </li>
        </ul>
    </div>


    <div class="py-8">
        <div class="flex flex-col md:flex-row justify-center md:space-x-8">
            <div class="md:w-1/3 p-8 m-4 md:m-0 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="md:w-1/3 p-8 m-4 md:m-0 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('profile.partials.update-password-form')
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
