<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid place-items-center">
        <ul class=" menu mt-8 bg-white md:menu-horizontal rounded-box">
            <li>
                <a href="{{ route('createApprovalRequest') }}" class="font-medium text-base">
                    Create Request
                </a>
            </li>
            <li>
                <a href="{{ route('myApprovalRequests') }}" class="font-medium text-base">
                    My Requests
                </a>
            </li>
            <li>
                <a href="{{ route('allApprovalRequests') }}" class="font-medium text-base">
                    All Requests
                </a>
            </li>
        </ul>
    </div>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    @livewire('list-users')
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
