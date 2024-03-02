<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class TasksKanbanBoard extends KanbanBoard
{
    protected static ?string $title = 'Tasks';

    protected static string $headerView = 'kanban-board.header-count';

    protected static string $recordView = 'kanban-board.record';

    protected static string $statusView = 'kanban-board.status';

    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected function getEditModalCancelButtonLabel(): string
    {
        return __('Cancel');
    }

    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('title')
                    ->label(__('Title')),
            Textarea::make('description')
                    ->label(__('Description')),
            TextInput::make('progress')
                    ->label(__('Progress'))
                    ->numeric(),
        ];
    }

    protected function getEditModalSaveButtonLabel(): string
    {
        return __('Save');
    }

    protected function getEditModalTitle(): string
    {
        return __('Edit Record');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(fn (): string => __('filament-actions::create.single.label', ['label' => __('task')]))
                ->model(Task::class)
                ->form([
                    TextInput::make('title')
                        ->label(__('Title')),
                    Textarea::make('description')
                        ->label(__('Description')),
                ])
                ->mutateFormDataUsing(function ($data) {
                    $data['user_id'] = auth()->id();

                    return $data;
                })
        ];
    }

    public function getHeading(): string
    {
        return __('Tasks');
    }

    public static function getNavigationLabel(): string
    {
        return __('Tasks');
    }
}
