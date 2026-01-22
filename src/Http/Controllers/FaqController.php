<?php

namespace Juzaweb\Modules\Faq\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Juzaweb\Modules\Core\Facades\Breadcrumb;
use Juzaweb\Modules\Core\Http\Controllers\AdminController;
use Juzaweb\Modules\Faq\Http\DataTables\FaqsDataTable;
use Juzaweb\Modules\Faq\Http\Requests\FaqActionsRequest;
use Juzaweb\Modules\Faq\Http\Requests\FaqRequest;
use Juzaweb\Modules\Faq\Models\Faq;

class FaqController extends AdminController
{
    public function index(FaqsDataTable $dataTable)
    {
        Breadcrumb::add(__('faq::translation.faqs'));

        $createUrl = action([static::class, 'create']);

        return $dataTable->render(
            'faq::faq.index',
            compact('createUrl')
        );
    }

    public function create()
    {
        Breadcrumb::add(__('faq::translation.faqs'), admin_url('faqs'));

        Breadcrumb::add(__('faq::translation.create_faq'));

        $backUrl = action([static::class, 'index']);
        $locale = $this->getFormLanguage();

        $model = new Faq();

        return view(
            'faq::faq.form',
            [
                'model' => $model,
                'action' => action([static::class, 'store']),
                'backUrl' => $backUrl,
                'locale' => $locale,
            ]
        );
    }

    public function edit(string $id)
    {
        Breadcrumb::add(__('faq::translation.faqs'), admin_url('faqs'));

        Breadcrumb::add(__('faq::translation.edit_faq'));

        $model = Faq::findOrFail($id);
        $backUrl = action([static::class, 'index']);
        $locale = $this->getFormLanguage();

        return view(
            'faq::faq.form',
            [
                'action' => action([static::class, 'update'], [$id]),
                'model' => $model,
                'backUrl' => $backUrl,
                'locale' => $locale,
            ]
        );
    }

    public function store(FaqRequest $request)
    {
        $model = DB::transaction(
            function () use ($request) {
                $data = $request->validated();

                return Faq::create($data);
            }
        );

        return $this->success([
            'redirect' => action([static::class, 'index']),
            'message' => __('faq::translation.faq_created_successfully'),
        ]);
    }

    public function update(FaqRequest $request, string $id)
    {
        $model = Faq::findOrFail($id);

        $model = DB::transaction(
            function () use ($request, $model) {
                $data = $request->validated();

                $model->update($data);

                return $model;
            }
        );

        return $this->success([
            'redirect' => action([static::class, 'index']),
            'message' => __('faq::translation.faq_updated_successfully'),
        ]);
    }

    public function bulk(FaqActionsRequest $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        $models = Faq::whereIn('id', $ids)->get();

        foreach ($models as $model) {
            if ($action === 'activate') {
                $model->update(['active' => true]);
            }

            if ($action === 'deactivate') {
                $model->update(['active' => false]);
            }

            if ($action === 'delete') {
                $model->delete();
            }
        }

        return $this->success([
            'message' => __('faq::translation.bulk_action_performed_successfully'),
        ]);
    }
}
