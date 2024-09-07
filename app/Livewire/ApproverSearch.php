<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApproverSearch extends Component
{
    public $search = '';
    public $approvers = [];
    public $newApproverId = null;
    public $approvalRequest;

    public function mount($approvalRequest)
    {
        $this->approvalRequest = $approvalRequest;
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->approvers = User::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })->where('id', '!=', Auth::id())
                ->where('id', '!=', $this->approvalRequest->created_by_id)
                ->limit(10)->get();
        } else {
            $this->approvers = [];
        }
    }

    public function selectApprover($approverId)
    {
        $this->newApproverId = $approverId;
        $this->search = User::find($approverId)->full_name;
        $this->approvers = [];

        // Use dispatch() in Livewire 3.x to send an event to the parent component
        $this->dispatch('approverSelected', newApproverId: $this->newApproverId);
    }

    public function render()
    {
        return view('livewire.approver-search', ['approvers' => $this->approvers]);
    }
}
