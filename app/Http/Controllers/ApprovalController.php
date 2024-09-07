<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\ApprovalAction;
use App\Models\ApprovalRequest;
use App\Models\ApprovalRequestStatus;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApprovalController extends Controller
{
    public function reject(ApprovalRequest $approvalRequest, Request $request)
    {
        $validated = $request->validate([
            'comment' => 'nullable|string'
        ]);

        $status = ApprovalRequestStatus::where('name', 'rejected')->firstOrFail();

        $approvalRequest->update([
            'approval_request_status_id' => $status->id,
            'final_approval' => true
        ]);

        $action = ApprovalAction::where('name', 'rejected')->firstOrFail();

        $approval = Approval::updateOrCreate(
            ['approval_request_id' => $approvalRequest->id],
            [
                'approver_id' => Auth::id(),
                'approval_action_id' => $action->id,
            ]
        );

        if (!empty($validated['comment'])) {
            $approvalRequest->comments()->create([
                'comment' => $validated['comment'],
                'created_by_id' => Auth::id(),
            ]);
        }

        Notification::make()
            ->title('Request Rejected')
            ->body('Your request has been rejected.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase($approvalRequest->createdBy);

        return Redirect::route('assignedRequests')->with('success', 'Request rejected.');
    }

    public function forward(ApprovalRequest $approvalRequest, Request $request)
    {
        $validated = $request->validate([
            'newApproverId' => 'required|exists:users,id',
            'comment' => 'nullable|string'
        ]);

        $approvalRequest->update([
            'current_approver_id' => $validated['newApproverId']
        ]);

        $action = ApprovalAction::where('name', 'forwarded')->firstOrFail();

        $approval = Approval::updateOrCreate(
            ['approval_request_id' => $approvalRequest->id],
            [
                'approver_id' => Auth::id(),
                'approval_action_id' => $action->id,
                'forwarded_to_id' => $validated['newApproverId']
            ]
        );

        if (!empty($validated['comment'])) {
            $approvalRequest->comments()->create([
                'comment' => $validated['comment'],
                'created_by_id' => Auth::id(),
            ]);
        }

        Notification::make()
            ->title('Request Forwarded')
            ->body('You have a new approval request to review.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase(User::find($validated['newApproverId']));

        return Redirect::route('assignedRequests')->with('success', 'Request forwarded succesfully.');
    }

    public function correction(ApprovalRequest $approvalRequest, Request $request)
    {
        $validated = $request->validate([
            'comment' => 'nullable|string'
        ]);

        $status = ApprovalRequestStatus::where('name', 'correction')->firstOrFail();

        $approvalRequest->update(['approval_request_status_id' => $status->id]);

        $action = ApprovalAction::where('name', 'correction')->firstOrFail();

        $approval = Approval::updateOrCreate(
            ['approval_request_id' => $approvalRequest->id],
            [
                'approver_id' => Auth::id(),
                'approval_action_id' => $action->id,
            ]
        );

        if (!empty($validated['comment'])) {
            $approvalRequest->comments()->create([
                'comment' => $validated['comment'],
                'created_by_id' => Auth::id(),
            ]);
        }

        Notification::make()
            ->title('Request returned')
            ->body('Your request has been returned for correction.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase($approvalRequest->createdBy);

        return Redirect::route('assignedRequests')->with('success', 'Request sent back.');
    }

    public function approve(ApprovalRequest $approvalRequest, Request $request)
    {
        $validated = $request->validate([
            'comment' => 'nullable|string'
        ]);

        $status = ApprovalRequestStatus::where('name', 'approved')->firstOrFail();

        $approvalRequest->update([
            'approval_request_status_id' => $status->id,
            'final_approval' => true
        ]);

        $action = ApprovalAction::where('name', 'approved')->firstOrFail();

        $approval = Approval::updateOrCreate(
            ['approval_request_id' => $approvalRequest->id],
            [
                'approver_id' => Auth::id(),
                'approval_action_id' => $action->id,
            ]
        );

        if (!empty($validated['comment'])) {
            $approvalRequest->comments()->create([
                'comment' => $validated['comment'],
                'created_by_id' => Auth::id(),
            ]);
        }

        Notification::make()
            ->title('Request Approved')
            ->body('Your request has been approved.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase($approvalRequest->createdBy);

        return Redirect::route('assignedRequests')->with('success', 'Request approved.');
    }

    public function resubmit(ApprovalRequest $approvalRequest, Request $request)
    {
        // Validate the request including attachments and comment
        $validated = $request->validate([
            'attachments.*' => 'nullable|mimes:jpg,jpeg,png,docx,xlsx,pdf|max:2048', // Validate each file in the attachments array
            'comment' => 'nullable|string'
        ]);

        $status = ApprovalRequestStatus::where('name', 'pending')->firstOrFail();
        $approvalRequest->update(['approval_request_status_id' => $status->id]);

        // Handle file uploads if any
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                // Store the file and create the attachment entry in the database
                $path = $attachment->store('attachments', 'public'); // Store file in 'public/attachments'
                $approvalRequest->attachments()->create([
                    'attachment' => $path,
                    'original_filename' => $attachment->getClientOriginalName()
                ]);
            }
        }

        if (!empty($validated['comment'])) {
            $approvalRequest->comments()->create([
                'comment' => $validated['comment'],
                'created_by_id' => Auth::id(),
            ]);
        }

        Notification::make()
            ->title('Request resent')
            ->body('You have a request that has been resent for review.')
            ->actions([
                Action::make('view')
                    ->button()
                    ->markAsRead()
                    ->url(route('singleApprovalRequest', $approvalRequest))
            ])
            ->sendToDatabase($approvalRequest->currentApprover);

        return Redirect::route('myApprovalRequests')->with('success', 'Request has been resent successfully.');
    }
}
