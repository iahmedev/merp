<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
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
                <a href="{{ $userDetail->user->employmentInfo ? route('employmentInfo.edit', $userDetail->user->employmentInfo) : route('employmentInfo.create', $userDetail->user) }}" class="font-medium text-base">
                    Employment Info
                </a>
            </li>
            <li>
                <a href="{{ $userDetail->user->nextOfKin ? route('nextOfKin.edit', $userDetail->user->nextOfKin) : route('nextOfKin.create', $userDetail->user) }}" class="font-medium text-base">
                    Next of Kin
                </a>
            </li>
        </ul>
    </div>

    <div class="py-4">
        <div class="flex justify-center">
            <div class="w-1/2 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('User Details') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update user details.') }}
                        </p>
                    </header>

                    <form action="{{ route('userDetail.update', $userDetail) }}" method="post" class="">
                        @csrf
                        @method('patch')

                        <div class="flex flex-col md:flex-row mt-6 gap-x-4">
                            <div class="w-full md:w-1/2 space-y-4">
                                <div>
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" name="phone" type="text" class="input-md mt-1 block w-full"
                                        :value="old('phone', $userDetail->phone)" required autofocus autocomplete="phone" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                                <div>
                                    <x-input-label for="state" :value="__('State')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full"
                                        :value="old('state', $userDetail->state)" required autofocus autocomplete="state" />
                                    <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                </div>
                                <div>
                                    <x-input-label for="lga" :value="__('LGA')" />
                                    <x-text-input id="lga" name="lga" type="text" class="mt-1 block w-full"
                                        :value="old('lga', $userDetail->lga)" required autofocus autocomplete="lga" />
                                    <x-input-error class="mt-2" :messages="$errors->get('lga')" />
                                </div>
                                <div>
                                    <x-input-label for="address" :value="__('Address')" />
                                    <x-text-input id="address" name="address" type="text" class="input-md mt-1 block w-full"
                                        :value="old('address', $userDetail->address)" required autofocus autocomplete="address" />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 space-y-4">
                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select class="select select-bordered mt-1 block w-full" name="gender" required
                                        autofocus autocomplete="gender">
                                        <option disabled {{ old('gender', $userDetail->gender) ? '' : 'selected' }}>
                                            Select Gender</option>
                                        <option value="male"
                                            {{ old('gender', $userDetail->gender) == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $userDetail->gender) == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                </div>
                                <div>
                                    <x-input-label for="marital_status" :value="__('Marital Status')" />
                                    <select class="select select-bordered mt-1 block w-full" name="marital_status" required
                                        autofocus autocomplete="marital_status">
                                        <option disabled {{ old('marital_status', $userDetail->marital_status) ? '' : 'selected' }}>
                                            Select Marital Status</option>
                                        <option value="single"
                                            {{ old('marital_status', $userDetail->marital_status) == 'single' ? 'selected' : '' }}>single
                                        </option>
                                        <option value="married"
                                            {{ old('marital_status', $userDetail->marital_status) == 'married' ? 'selected' : '' }}>
                                            married</option>
                                        <option value="widowed"
                                            {{ old('marital_status', $userDetail->marital_status) == 'widowed' ? 'selected' : '' }}>
                                            widowed</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('marital_status')" />
                                </div>
                                <div>
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                        class="mt-1 block w-full" :value="old('date_of_birth', $userDetail->date_of_birth)" required autofocus
                                        autocomplete="date_of_birth" />
                                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                                </div>
                                <div>
                                    <x-input-label for="nin" :value="__('NIN')" />
                                    <x-text-input id="nin" name="nin" type="text" class="mt-1 block w-full"
                                        :value="old('nin', $userDetail->nin)" required autofocus autocomplete="nin" />
                                    <x-input-error class="mt-2" :messages="$errors->get('nin')" />
                                </div>
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
