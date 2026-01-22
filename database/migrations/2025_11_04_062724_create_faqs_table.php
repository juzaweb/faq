<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('active')->index()->default(true);
            $table->datetimes();
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->uuid('faq_id')->index();
            $table->string('locale', 5)->index();
            $table->string('question');
            $table->text('answer');
            $table->unique(['faq_id', 'locale']);
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faqs');
    }
};
