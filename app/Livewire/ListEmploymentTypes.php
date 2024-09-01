<?php

namespace App\Livewire;

use App\Models\EmploymentType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class ListEmploymentTypes extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->string()
                            ->maxLength(255)
                    ])->successNotificationTitle('Employment type created.')
            ])
            ->striped()
            ->query(EmploymentType::query()->withCount('employmentInfo'))
            ->heading('All Employment Types')
            ->columns([
                TextColumn::make('index')
                    ->label('S/N')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employment_info_count')
                    ->label('Employee Count')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->string()
                            ->maxLength(255)
                    ])->successNotificationTitle('Employment type updated.')
            ]);
    }

    public function render()
    {
        return view('livewire.list-employment-types');
    }
}
