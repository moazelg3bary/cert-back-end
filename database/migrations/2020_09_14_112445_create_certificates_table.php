<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->integer('user_id');
            $table->string('property_type');
            $table->string('title');
            $table->string('title_ar');
            $table->string('description');
            $table->string('owner_type');
            $table->string('data');
            $table->string('status')->default(0);
            $table->string('company_logo')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
