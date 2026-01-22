<?php

use Juzaweb\Modules\Core\Facades\RouteResource;
use Juzaweb\Modules\Faq\Http\Controllers\FaqController;

RouteResource::admin('faqs', FaqController::class);
