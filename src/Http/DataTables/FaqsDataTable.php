<?php

namespace Juzaweb\Modules\Faq\Http\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Juzaweb\Modules\Core\DataTables\Action;
use Juzaweb\Modules\Core\DataTables\BulkAction;
use Juzaweb\Modules\Core\DataTables\Column;
use Juzaweb\Modules\Core\DataTables\DataTable;
use Juzaweb\Modules\Faq\Models\Faq;

class FaqsDataTable extends DataTable
{
    protected string $actionUrl = 'faqs/bulk';

    public function query(Faq $model): Builder
    {
        return $model->newQuery()->filter(request()->all());
    }

    public function getColumns(): array
    {
        return [
            Column::checkbox(),
            Column::id(),
            Column::editLink('question', admin_url('faqs/{id}/edit'), __('faq::translation.question')),
            Column::make('display_order', __('faq::translation.display_order'))->center()->width(100),
            Column::make('active', __('faq::translation.active'))->center()->width(100),
            Column::createdAt(),
            Column::actions(),
        ];
    }

    public function actions(Model $model): array
    {
        return [
            Action::edit(admin_url("faqs/{$model->id}/edit"))->can('faqs.edit'),
            Action::delete()->can('faqs.delete'),
        ];
    }

    public function bulkActions(): array
    {
        return [
            BulkAction::make('activate', __('faq::translation.activate'))->can('faqs.edit'),
            BulkAction::make('deactivate', __('faq::translation.deactivate'))->can('faqs.edit'),
            BulkAction::delete()->can('faqs.delete'),
        ];
    }
}
