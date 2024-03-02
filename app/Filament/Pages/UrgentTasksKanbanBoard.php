<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Collection;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class UrgentTasksKanbanBoard extends KanbanBoard
{
    protected static ?string $title = 'Urgent Tasks';

    protected static string $headerView = 'kanban-board.header';

    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected function records(): Collection
    {
        return Task::where('urgent', true)->ordered()->get();
    }

    public function getHeading(): string
    {
        return __('Urgent Tasks');
    }

    public static function getNavigationLabel(): string
    {
        return __('Urgent Tasks');
    }
}
