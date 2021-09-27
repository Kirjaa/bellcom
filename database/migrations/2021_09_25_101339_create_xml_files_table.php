<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXmlFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xml_files', function (Blueprint $table) {
            // AI id
            $table->id();

            // Main fields
            $table->string('file_path');
            $table->string('file_name_full')->unique();
            $table->integer('file_name_numeric')->index();

            // created_at / updated_at
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
        Schema::dropIfExists('xml_files');
    }
}
