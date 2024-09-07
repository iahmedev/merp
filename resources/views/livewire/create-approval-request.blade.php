<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Create Request') }}
    </h2>
</x-slot>

<div class="py-4">
    <div class="flex justify-center">
        <div class="w-full md:w-1/3 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Create New Request') }}
                    </h2>
                </header>
                <form wire:submit.prevent="save">
                    @csrf

                    <div class="flex flex-col mt-6 space-y-4">
                        <div>
                            <x-input-label for="form.title" :value="__('Title')" />
                            <x-text-input wire:model="form.title" type="text" class="mt-1 block w-full" />
                            @error('form.title')
                                {{-- <span class="error text-danger-500">{{ $message }}</span> --}}
                                <x-input-error class="mt-2" :messages="$errors->get('form.title')" />
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="form.description" :value="__('Description')" />
                            <x-text-input wire:model="form.description" type="text" class="mt-1 block w-full" />
                            @error('form.description')
                                {{-- <span class="error">{{ $message }}</span> --}}
                                <x-input-error class="mt-2" :messages="$errors->get('form.description')" />
                            @enderror
                        </div>

                        <div>
                            <x-input-label for="approver" :value="__('Approver')" />
                            <x-text-input wire:model.live="search" type="text" class="mt-1 block w-full"
                                placeholder="Search for an approver..." />

                            @if ($approvers)
                                <ul class="bg-white border border-gray-200 rounded mt-1">
                                    @foreach ($approvers as $approver)
                                        <li wire:click="selectApprover({{ $approver->id }})"
                                            class="cursor-pointer p-2 hover:bg-gray-100">
                                            {{ $approver->full_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @error('form.current_approver_id')
                                {{-- <span class="error text-danger-500">{{ $message }}</span> --}}
                                <x-input-error class="mt-2" :messages="$errors->get('form.current_approver_id')" />
                            @enderror

                            <div class="mt-4">
                                <x-input-label for="attachments" :value="__('Attachments')" />
                                <input type="file" wire:model="form.attachments" multiple
                                    class="file-input file-input-bordered w-full mt-1 block">
                                @error('form.attachments.*')
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>

                            <div class="mt-4">
                                <x-input-label for="comment" :value="__('Comment')" />
                                <textarea wire:model="form.comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"></textarea>
                                @error('form.comment')
                                    <x-input-error class="mt-2" :messages="$message" />
                                @enderror
                            </div>


                            <!-- Hidden input to store the selected approver ID -->
                            <input type="hidden" wire:model="form.current_approver_id">
                        </div>

                        <div class="flex items-center mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
