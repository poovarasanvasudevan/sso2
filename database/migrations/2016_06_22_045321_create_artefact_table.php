<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtefactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('artefacttypes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('artefact_type');
            $table->string('artefact_type_description')->default('No Description found');
            $table->string('artefact_type_long_description')->default('Contains many artefact that can be managed');
            $table->boolean('active')->default(TRUE);
            $table->integer('created_by')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
        });

        Schema::create('archivelocations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('archive_location_name');
            $table->string('archive_location_desc');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('artefacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artefact_type')->unsigned();
            $table->string('old_id');
            $table->string('artefact_name');
            $table->integer('artefact_parent')->unsigned()->nullable();
            $table->integer('location')->unsigned()->default(1);
            $table->integer('created_by')->unsigned();
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('location')->references('id')->on('archivelocations');
            $table->foreign('artefact_type')->references('id')->on('artefacttypes');
            $table->foreign('artefact_parent')->references('id')->on('artefacts');
        });

        Schema::create('artefactvalues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artefact_id')->unsigned();
            $table->json('artefact_values')->nullable();
            $table->timestamps();

            $table->foreign('artefact_id')->references('id')->on('artefacts');
        });

        Schema::create('listvalues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('list_code');
            $table->string('list_desc');
            $table->string('list_value');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attrcode');
            $table->integer('artefact_type')->unsigned();
            $table->string('list_code')->nullable();
            $table->string('attr_value');
            $table->boolean('pickflag')->nullable()->default(FALSE);
            $table->boolean('is_searchable')->nullable()->default(TRUE);
            $table->boolean('is_maintainable')->nullable()->default(TRUE);
            $table->integer('sequence_number')->nullable()->default(1);
            $table->string('html_type')->nullable()->default('text');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('artefact_type')->references('id')->on('artefacttypes');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::drop('artefactvalues');
        Schema::drop('artefacts');

        Schema::drop('attributes');
        Schema::drop('listvalues');
        Schema::drop('artefacttypes');
        Schema::drop('archivelocations');
        //Schema::drop('users');
    }
}
