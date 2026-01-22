@extends('core::layouts.admin')

@section('content')
    <form action="{{ $action }}" class="form-ajax" method="post">
        @if($model->exists)
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <a href="{{ $backUrl }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> {{ __('faq::translation.back') }}
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('faq::translation.save') }}
                </button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9">
                <x-card title="{{ __('faq::translation.information') }}">
                    {{ Field::text(__('faq::translation.question'), 'question', ['value' => $model->question, 'required' => true]) }}

                    {{ Field::textarea(__('faq::translation.answer'), 'answer', ['value' => $model->answer, 'required' => true, 'rows' => 5]) }}
                </x-card>
            </div>

            <div class="col-md-3">
                <x-language-card :label="$model" :locale="$locale" />

                <x-card title="{{ __('faq::translation.settings') }}">
                    {{ Field::text(__('faq::translation.display_order'), 'display_order', ['value' => $model->display_order ?? 1]) }}

                    {{ Field::checkbox(__('faq::translation.active'), 'active', ['value' => $model->active ?? true]) }}
                </x-card>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" nonce="{{ csp_script_nonce() }}">
        $(function () {
            //
        });
    </script>
@endsection
