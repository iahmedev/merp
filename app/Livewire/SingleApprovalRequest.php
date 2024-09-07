<?php

namespace App\Livewire;

use App\Models\ApprovalRequest;
use Livewire\Component;

class SingleApprovalRequest extends Component
{
    public $approvalRequest;

    public function mount(ApprovalRequest $approvalRequest)
    {
        $this->approvalRequest = $approvalRequest->load(['attachments', 'comments.createdBy', 'currentApprover', 'status']); // Eager load necessary relations
    }

    public function render()
    {
        return view('livewire.single-approval-request', ['approvalRequest' => $this->approvalRequest]);
    }
}
