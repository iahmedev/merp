<?php

namespace App\Livewire\Forms;

use App\Models\ApprovalRequest;
use App\Models\ApprovalRequestStatus;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class ApprovalRequestForm extends Form
{
    use WithFileUploads;

    // #[Validate('required|string|max:255')]
    public $title = '';

    // #[Validate('nullable|string')]
    public $description = '';

    // #[Validate('required', message: 'You must select an approver')]
    // #[Validate('exists:users,id')]
    public $current_approver_id;

    // #[Validate('nullable|array')] // Validate that it's an array
    public $attachments = [];

    // #[Validate('nullable|string')]
    public $comment = '';

    public function validationAttributes()
    {
        return [
            'attachments.*' => 'attachments',
        ];
    }

    // Define validation rules
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'current_approver_id' => 'required|exists:users,id',
            'attachments.*' => 'nullable', // Each file must match these rules
            'comment' => 'nullable|string',
        ];
    }

    public function store()
    {
        $this->validate();

        // Validate each file in the attachments array
        foreach ($this->attachments as $key => $attachment) {
            $this->validate([
                'attachments.' . $key => 'mimes:jpg,jpeg,png,docx,xlsx,pdf|max:2048', // 20KB for testing
            ]);
        }

        $status = ApprovalRequestStatus::where('name', 'pending')->firstOrFail();

        $approvalRequest = ApprovalRequest::create([
            'title' => $this->title,
            'description' => $this->description ?? null,
            'approval_request_status_id' => $status->id,
            'current_approver_id' => $this->current_approver_id,
            'created_by_id' => Auth::user()->id
        ]);

        // Handle file uploads
        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $path = $attachment->store('attachments', 'public');
                $approvalRequest->attachments()->create([
                    'attachment' => $path,
                    'original_filename' => $attachment->getClientOriginalName()
                ]);
            }
        }

        // Handle comment
        if ($this->comment) {
            $approvalRequest->comments()->create([
                'comment' => $this->comment,
                'created_by_id' => Auth::id(),
            ]);
        }

        // Retrieve the approver using current_approver_id
        $approver = User::find($this->current_approver_id);

        // Use Filament Notifications to notify the approver
        Notification::make()
            ->title('Request Created')
            ->body('A new approval request has been assigned to you.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase($approver);
    }
}
