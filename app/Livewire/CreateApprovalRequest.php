<?php

namespace App\Livewire;

use App\Livewire\Forms\ApprovalRequestForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateApprovalRequest extends Component
{
    use WithFileUploads;

    public ApprovalRequestForm $form;

    public $search = '';
    public $approvers = [];
    public $approver;

    public function updatedSearch()
    {
        // If the search input is cleared, reset the approver ID
        if (empty($this->search)) {
            $this->form->current_approver_id = null;
        }

        if (strlen($this->search) >= 2) { // Only search if more than 2 characters
            $this->approvers = User::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })->where('id', '!=', Auth::id()) // Exclude the requester
                ->limit(10) // Limit results for performance
                ->get();
        } else {
            $this->approvers = [];
        }
    }

    public function selectApprover($userId)
    {
        $approver = User::find($userId);
        $this->form->current_approver_id = $userId;
        $this->search = $approver->full_name; // Set the text box with the full name
        $this->approvers = []; // Clear the dropdown
    }

    public function save()
    {
        // Ensure the approver ID is cleared if the search field is empty
        if (empty($this->search)) {
            $this->form->current_approver_id = null;
        }
        $this->form->store();

        session()->flash('success', 'Request created successfully.');
        return redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.create-approval-request');
    }
}
