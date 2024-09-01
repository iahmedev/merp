<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Next of Kin Information') }}
        </h2>
    </x-slot>

    <div class="grid place-items-center">
        <ul class=" menu mt-8 bg-white md:menu-horizontal rounded-box">
            <li>
                <a href="{{ route('profile.edit') }}" class="font-medium text-base">
                    Profile
                </a>
            </li>
            <li>
                <a href="{{ $nextOfKin->user->userDetail ? route('userDetail.edit', $nextOfKin->user->userDetail) : route('userDetail.create', $nextOfKin->user) }}" class="font-medium text-base">
                    User Details
                </a>
            </li>
            <li>
                <a href="{{ $nextOfKin->user->employmentInfo ? route('employmentInfo.edit', $nextOfKin->user->employmentInfo) : route('employmentInfo.create', $nextOfKin->user) }}"
                    class="font-medium text-base">
                    Employment Info
                </a>
            </li>
        </ul>
    </div>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="w-1/3 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Next of Kin Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update your next of kin information.') }}
                        </p>
                    </header>

                    <form action="{{ route('nextOfKin.update', $nextOfKin) }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="flex flex-col mt-6 space-y-4">
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $nextOfKin->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email', $nextOfKin->email)" autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="input-md mt-1 block w-full"
                                    :value="old('phone', $nextOfKin->phone)" required autofocus autocomplete="phone" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" name="address" type="text" class="input-md mt-1 block w-full"
                                    :value="old('address', $nextOfKin->address)" required autofocus autocomplete="address" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>
                            <div>
                                <x-input-label for="relationship" :value="__('Relationship')" />
                                <x-text-input id="relationship" name="relationship" type="text" class="input-md mt-1 block w-full"
                                    :value="old('relationship', $nextOfKin->relationship)" required autofocus autocomplete="relationship" />
                                <x-input-error class="mt-2" :messages="$errors->get('relationship')" />
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'information-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
