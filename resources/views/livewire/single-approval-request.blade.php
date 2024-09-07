<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Approval Request') }}
    </h2>
</x-slot>

<div class="py-4">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2 p-8 m-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <section>
                <div>

                    <div class="mt-4 space-y-4">
                        <!-- Request Details -->
                        <h3 class="text-lg font-medium mb-1">Details</h3>
                        <div class="flex justify-center mt-4 space-x-3 bg-white p-4 shadow rounded-lg">
                            <div class="w-full space-y-3">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input value="{{ $approvalRequest->title }}" type="text"
                                    class="mt-1 block w-full" readonly />
                                {{-- <p><strong>Title:</strong> {{ $approvalRequest->title }}</p> --}}
                                {{-- <p class="prose"><strong>Description:</strong> {{ $approvalRequest->description }}</p> --}}
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input value="{{ $approvalRequest->description }}" type="text"
                                    class="mt-1 input-lg block w-full" readonly />
                                <p class="pt-3"><strong>Status:</strong>
                                    @if ($approvalRequest->status->name == 'approved')
                                        <span class="badge badge-lg badge-success">
                                            {{ $approvalRequest->status->name }}
                                        </span>
                                    @elseif ($approvalRequest->status->name == 'pending')
                                        <span class="badge badge-lg badge-info">
                                            {{ $approvalRequest->status->name }}
                                        </span>
                                    @elseif ($approvalRequest->status->name == 'rejected')
                                        <span class="badge badge-lg badge-error">
                                            {{ $approvalRequest->status->name }}
                                        </span>
                                    @elseif ($approvalRequest->status->name == 'correction')
                                        <span class="badge badge-lg badge-warning">
                                            {{ $approvalRequest->status->name }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="w-full space-y-3">
                                <x-input-label for="full_name" :value="__('Created By')" />
                                <x-text-input value="{{ $approvalRequest->createdBy->full_name ?? 'N/A' }}"
                                    type="text" class="mt-1 block w-full" readonly />

                                <x-input-label for="created_at" :value="__('Created On')" />
                                <x-text-input value="{{ $approvalRequest->created_at->format('F j, Y') }}"
                                    type="text" class="mt-1 block w-full" readonly />

                                <x-input-label for="full_name" :value="__('Approver')" />
                                <x-text-input value="{{ $approvalRequest->currentApprover->full_name }}" type="text"
                                    class="mt-1 block w-full" readonly />
                            </div>
                        </div>

                        <!-- Attachments -->
                        @if ($approvalRequest->attachments->count())
                            <div class="bg-white p-4 shadow rounded-lg">
                                <h3 class="text-lg font-medium">Attachments</h3>
                                <ul>
                                    @foreach ($approvalRequest->attachments as $attachment)
                                        <li>
                                            <a href="{{ asset('storage/' . $attachment->attachment) }}" target="_blank"
                                                class="text-blue-500">
                                                {{ $attachment->original_filename }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Comments -->
                        @if ($approvalRequest->comments->count())
                            <div class="bg-white p-4 shadow rounded-lg">
                                <h3 class="text-lg font-medium mb-2">Comments</h3>
                                <ul>
                                    @foreach ($approvalRequest->comments as $comment)
                                        <div class="chat chat-start">
                                            <div class="chat-header">
                                                {{ $comment->createdBy->full_name ?? 'Unknown' }}
                                                <time
                                                    class="text-xs opacity-50">{{ $comment->created_at->diffForHumans() }}</time>
                                            </div>
                                            <div class="chat-bubble mt-2">{{ $comment->comment }}</div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Actions --}}
                        @if ($approvalRequest->currentApprover == auth()->user())
                            @if ($approvalRequest->status->name == 'pending')
                                <div class="flex flex-row items-center mt-2 space-x-3">
                                    <form id="approve_form" action="{{ route('approval.approve', $approvalRequest) }}"
                                        method="post">
                                        @csrf
                                        <!-- approve Button to Open Modal -->
                                        <button type="button" class="btn btn-sm btn-success"
                                            onclick="document.getElementById('approve').showModal()">{{ __('Approve') }}</button>
                                        <!-- Modal for Comment -->
                                        <dialog id="approve" class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                {{-- <h3 class="text-lg font-bold">Hello!</h3> --}}
                                                <div class="mt-2">
                                                    <x-input-label for="comment" :value="__('Comment')" />
                                                    <textarea id="comment" name="comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"
                                                        placeholder="Please enter reason for approval"></textarea>
                                                </div>
                                                <div class="modal-action">
                                                    <x-primary-Button
                                                        form="approve_form">{{ __('Submit') }}</x-primary-Button>
                                                    <button type="button" class="btn"
                                                        onclick="document.getElementById('approve').close()">Cancel</button>
                                                </div>
                                            </div>
                                        </dialog>
                                    </form>
                                    <form id="correction_form"
                                        action="{{ route('approval.correction', $approvalRequest) }}" method="post">
                                        @csrf
                                        <!-- correction Button to Open Modal -->
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="document.getElementById('correction').showModal()">{{ __('Send Back') }}</button>
                                        <!-- Modal for Comment -->
                                        <dialog id="correction" class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                {{-- <h3 class="text-lg font-bold">Hello!</h3> --}}
                                                <div class="mt-2">
                                                    <x-input-label for="comment" :value="__('Comment')" />
                                                    <textarea id="comment" name="comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"
                                                        placeholder="Please enter reason for sending back request"></textarea>
                                                </div>
                                                <div class="modal-action">
                                                    <x-primary-Button
                                                        form="correction_form">{{ __('Submit') }}</x-primary-Button>
                                                    <button type="button" class="btn"
                                                        onclick="document.getElementById('correction').close()">Cancel</button>
                                                </div>
                                            </div>
                                        </dialog>
                                    </form>
                                    <form id="forward_form" action="{{ route('approval.forward', $approvalRequest) }}"
                                        method="post">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-neutral"
                                            onclick="document.getElementById('forward').showModal()">{{ __('Forward') }}</button>
                                        <!-- Modal for Comment and Next Approver -->
                                        <dialog id="forward" class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                <!-- Reusable Approver Search Component -->
                                                @livewire('approver-search', ['approvalRequest' => $approvalRequest])
                                                <!-- Hidden input to store the selected approver ID -->
                                                <input type="hidden" id="newApproverId" name="newApproverId">
                                                <div class="mt-4">
                                                    <x-input-label for="comment" :value="__('Comment')" />
                                                    <textarea id="comment" name="comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"
                                                        placeholder="Please enter reason for request rejection"></textarea>
                                                </div>
                                                <div class="modal-action">
                                                    <x-primary-Button
                                                        form="forward_form">{{ __('Submit') }}</x-primary-Button>
                                                    <button type="button" class="btn"
                                                        onclick="document.getElementById('forward').close()">Cancel</button>
                                                </div>
                                            </div>
                                        </dialog>
                                    </form>
                                    <form id="reject_form" action="{{ route('approval.reject', $approvalRequest) }}"
                                        method="post">
                                        @csrf
                                        <!-- Reject Button to Open Modal -->
                                        <button type="button" class="btn btn-sm btn-error"
                                            onclick="document.getElementById('reject').showModal()">{{ __('Reject') }}</button>
                                        <!-- Modal for Comment -->
                                        <dialog id="reject" class="modal modal-bottom sm:modal-middle">
                                            <div class="modal-box">
                                                {{-- <h3 class="text-lg font-bold">Hello!</h3> --}}
                                                <div class="mt-2">
                                                    <x-input-label for="comment" :value="__('Comment')" />
                                                    <textarea id="comment" name="comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"
                                                        placeholder="Please enter reason for request rejection"></textarea>
                                                </div>
                                                <div class="modal-action">
                                                    <x-primary-Button
                                                        form="reject_form">{{ __('Submit') }}</x-primary-Button>
                                                    <button type="button" class="btn"
                                                        onclick="document.getElementById('reject').close()">Cancel</button>
                                                </div>
                                            </div>
                                        </dialog>
                                    </form>
                                </div>
                            @elseif ($approvalRequest->status->name == 'correction' && $approvalRequest->currentApprover == auth()->user())
                                <p class="text-info">The request is pending correction. Waiting for requester to
                                    resubmit.</p>
                            @else
                                <p class="text-neutral">This request has already been processed.</p>
                            @endif
                        @endif

                        {{-- Actions for the Requester (Upload After Correction) --}}
                        @if ($approvalRequest->status->name == 'correction' && auth()->id() == $approvalRequest->created_by_id)
                            <form id="resubmit_form" action="{{ route('approval.resubmit', $approvalRequest) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- resubmit Button to Open Modal -->
                                <button type="button" class="btn btn-md btn-neutral"
                                    onclick="document.getElementById('resubmit').showModal()">{{ __('Resend') }}</button>
                                <!-- Modal for Comment -->
                                <dialog id="resubmit" class="modal modal-bottom sm:modal-middle">
                                    <div class="modal-box">
                                        <div class="mt-4">
                                            <x-input-label for="attachments" :value="__('Attachments')" />
                                            <input type="file" name="attachments[]" id="attachments" multiple
                                                class="file-input file-input-bordered w-full mt-2 block">
                                            @error('attachments.*')
                                                <x-input-error class="mt-2" :messages="$message" />
                                            @enderror
                                        </div>
                                        <div class="mt-4">
                                            <x-input-label for="comment" :value="__('Comment')" />
                                            <textarea id="comment" name="comment" class="textarea textarea-bordered textarea-md mt-1 block w-full"
                                                placeholder="Please add comments if any"></textarea>
                                        </div>
                                        <div class="modal-action">
                                            <x-primary-Button
                                                form="resubmit_form">{{ __('Submit') }}</x-primary-Button>
                                            <button type="button" class="btn"
                                                onclick="document.getElementById('resubmit').close()">Cancel</button>
                                        </div>
                                    </div>
                                </dialog>
                            </form>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Use Alpine.js to handle the dispatched event -->
<script>
    document.addEventListener('approverSelected', event => {
        document.getElementById('newApproverId').value = event.detail.newApproverId;
    });
</script>
