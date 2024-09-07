<?php

namespace App\Livewire;

use App\Models\ApprovalRequest;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListApprovalRequests extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $header;

    // Method to dynamically adjust the query based on the route
    protected function getTableQuery()
    {
        // If the current route is 'approvalRequests', filter by the logged-in user's requests
        if (request()->routeIs('myApprovalRequests')) {
            $this->header = 'My Requests';
            return ApprovalRequest::where('created_by_id', Auth::id());
        } elseif (request()->routeIs('assignedRequests')) {
            $this->header = 'My Assigned Requests';
            return ApprovalRequest::where('current_approver_id', Auth::id());
        } else {
            $this->header = 'All Requests';
            // If it's the 'allApprovalRequests' route, show requests for all users
            return ApprovalRequest::query();
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->striped()
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('index')
                    ->label('S/N')
                    ->rowIndex(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('currentApprover.full_name')
                    ->label('Approver'),
                TextColumn::make('status.name')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (strtolower($state)) {
                        'approved' => 'success',
                        'pending' => 'info',
                        'rejected' => 'danger',
                        'correction' => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->since()
                    ->tooltip(fn($state) => \Carbon\Carbon::parse($state)->format('F j, Y'))  // Custom tooltip format
                    ->sortable()
            ])
            ->defaultSort('created_at', 'desc')
            ->recordUrl(
                fn(ApprovalRequest $record): string => route('singleApprovalRequest', $record)
            );
    }

    public function render()
    {
        return view('livewire.list-approval-requests', ['header' => $this->header]);
    }
}
