<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employment Information') }}
        </h2>
    </x-slot>

    <div class="grid place-items-center">
        <ul class="menu mt-8 bg-white md:menu-horizontal rounded-box">
            <li>
                <a href="{{ route('profile.edit') }}" class="font-medium text-base">
                    Profile
                </a>
            </li>
            <li>
                <a href="{{ $employmentInfo->user->userDetail ? route('userDetail.edit', $employmentInfo->user->userDetail) : route('userDetail.create', $employmentInfo->user) }}"
                    class="font-medium text-base">
                    User Details
                </a>
            </li>
            <li>
                <a href="{{ $employmentInfo->user->nextOfKin ? route('nextOfKin.edit', $employmentInfo->user->nextOfKin) : route('nextOfKin.create', $employmentInfo->user) }}"
                    class="font-medium text-base">
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
                            {{ __('Employment Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Update your employment information.') }}
                        </p>
                    </header>

                    <form action="{{ route('employmentInfo.update', $employmentInfo) }}" method="post" class="">
                        @csrf
                        @method('patch')

                        <div class="flex flex-col md:flex-row mt-6 gap-x-4">
                            <div class="w-full md:w-1/2 space-y-4">
                                <div>
                                    <x-input-label for="employee_id" :value="__('Employee ID')" />
                                    <x-text-input id="employee_id" name="employee_id" type="text"
                                        class="input-md mt-1 block w-full" :value="old('employee_id', $employmentInfo->employee_id)" required autofocus
                                        autocomplete="employee_id" />
                                    <x-input-error class="mt-2" :messages="$errors->get('employee_id')" />
                                </div>
                                <div>
                                    <x-input-label for="employment_type_id" :value="__('Employment Type')" />
                                    <select class="select select-bordered mt-1 block w-full" name="employment_type_id"
                                        required autofocus autocomplete="employment_type_id">
                                        <option disabled
                                            {{ old('employment_type_id', $employmentInfo->employment_type_id) ? '' : 'selected' }}>
                                            Select Employment Type
                                        </option>
                                        @foreach ($emp_types as $emp_type)
                                            <option value="{{ $emp_type->id }}"
                                                {{ old('employment_type_id', $employmentInfo->employment_type_id) == $emp_type->id ? 'selected' : '' }}>
                                                {{ $emp_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('employment_type_id')" />
                                </div>
                                <div>
                                    <x-input-label for="employment_status_id" :value="__('Employment Status')" />
                                    <select class="select select-bordered mt-1 block w-full" name="employment_status_id"
                                        required autofocus autocomplete="employment_status_id">
                                        <option disabled
                                            {{ old('employment_status_id', $employmentInfo->employment_status_id) ? '' : 'selected' }}>
                                            Select Employment Status
                                        </option>
                                        @foreach ($emp_status as $emp_status)
                                            <option value="{{ $emp_status->id }}"
                                                {{ old('employment_status_id', $employmentInfo->employment_status_id) == $emp_status->id ? 'selected' : '' }}>
                                                {{ $emp_status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('employment_status_id')" />
                                </div>
                                <div>
                                    <x-input-label for="date_of_employment" :value="__('Date of Employment')" />
                                    <x-text-input id="date_of_employment" name="date_of_employment" type="date"
                                        class="input-md mt-1 block w-full" :value="old('date_of_employment', $employmentInfo->date_of_employment)" required autofocus
                                        autocomplete="date_of_employment" />
                                    <x-input-error class="mt-2" :messages="$errors->get('date_of_employment')" />
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 space-y-4">
                                <div>
                                    <x-input-label for="department_id" :value="__('Department')" />
                                    <select class="select select-bordered mt-1 block w-full" name="department_id"
                                        required autofocus autocomplete="department_id">
                                        <option disabled
                                            {{ old('department_id', $employmentInfo->department_id) ? '' : 'selected' }}>
                                            Select Department
                                        </option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id', $employmentInfo->department_id) == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('department_id')" />

                                </div>
                                <div>
                                    <x-input-label for="designation_id" :value="__('Designation')" />
                                    <select class="select select-bordered mt-1 block w-full" name="designation_id"
                                        required autofocus autocomplete="designation_id">
                                        <option disabled
                                            {{ old('designation_id', $employmentInfo->designation_id) ? '' : 'selected' }}>
                                            Select Designation
                                        </option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}"
                                                {{ old('designation_id', $employmentInfo->designation_id) == $designation->id ? 'selected' : '' }}>
                                                {{ $designation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('designation_id')" />
                                </div>
                                <div>
                                    <x-input-label for="date_of_last_promotion" :value="__('Date of Last Promotion')" />
                                    <x-text-input id="date_of_last_promotion" name="date_of_last_promotion"
                                        type="date" class="mt-1 block w-full" :value="old(
                                            'date_of_last_promotion',
                                            $employmentInfo->date_of_last_promotion ?? '',
                                        )" autofocus
                                        autocomplete="date_of_last_promotion" />
                                    <x-input-error class="mt-2" :messages="$errors->get('date_of_last_promotion')" />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'information-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="ml-2 text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
