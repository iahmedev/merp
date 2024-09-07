<div>
    <x-input-label for="approver_search" :value="__('New Approver')" />
    <x-text-input wire:model.live="search" type="text" class="mt-1 block w-full" placeholder="Search for an approver..." required/>
    @if ($approvers)
        <ul class="bg-white border border-gray-200 rounded mt-1">
            @foreach ($approvers as $approver)
                <li wire:click="selectApprover({{ $approver->id }})" class="cursor-pointer p-2 hover:bg-gray-100">
                    {{ $approver->full_name }}
                </li>
            @endforeach
        </ul>
    @endif
    <input type="hidden" wire:model="newApproverId" name="newApproverId">
</div>
