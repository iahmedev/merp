<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class ListUsers extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->form([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->string()
                            ->maxLength(255),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->string()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->string()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique('users', 'email')
                    ])
                    ->mutateFormDataUsing(function (array $data) {
                        $data['password'] = bcrypt('1234');
                        return $data;
                    })
            ])
            ->striped()
            ->heading('All Staff')
            ->query(User::query())
            ->columns([
                TextColumn::make('index')
                    ->label('S/N')
                    ->rowIndex(),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employmentInfo.employee_id')
                    ->label('Staff ID')
                    ->searchable(),
                TextColumn::make('employmentInfo.designation.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employmentInfo.department.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employmentInfo.employmentStatus.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (strtolower($state)) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),
                TextColumn::make('employmentInfo.employmentType.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (strtolower($state)) {
                        'permanent' => 'success',
                        'contract' => 'info',
                        'probation' => 'warning',
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('userDetailAction')  // Unique action name
                        ->label(fn(User $record): string => $record->userDetail ? 'Edit User Detail' : 'Create User Detail')  // Dynamic label
                        ->url(
                            fn(User $record): string => $record->userDetail
                                ? route('userDetail.edit', ['userDetail' => $record->userDetail])
                                : route('userDetail.create', ['user' => $record])
                        ),
                    Action::make('employmentInfoAction')  // Unique action name
                        ->label(fn(User $record): string => $record->employmentInfo ? 'Edit Employment Info' : 'Create Employment Info')  // Dynamic label
                        ->url(
                            fn(User $record): string => $record->employmentInfo
                                ? route('employmentInfo.edit', ['employmentInfo' => $record->employmentInfo])
                                : route('employmentInfo.create', ['user' => $record])
                        ),
                    Action::make('nextOfKinAction')  // Unique action name
                        ->label(fn(User $record): string => $record->nextOfKin ? 'Edit Next Of Kin' : 'Create Next Of Kin')  // Dynamic label
                        ->url(
                            fn(User $record): string => $record->nextOfKin
                                ? route('nextOfKin.edit', ['nextOfKin' => $record->nextOfKin])
                                : route('nextOfKin.create', ['user' => $record])
                        )
                ])
                    ->link()
                    ->label('Actions')

            ]);
    }

    public function render()
    {
        return view('livewire.list-users');
    }
}
