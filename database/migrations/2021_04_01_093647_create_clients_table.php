<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('contact_number', 20);
            $table->string('address')->nullable();
            $table->enum('service_type', ['Both', 'Hosting', 'Domain'])->default('Both');
            $table->string('domain_name')->nullable();
            $table->integer('domain_renewal')->nullable();
            $table->enum('domain_renewal_type', ['Month', 'Year'])->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->integer('hosting_renewal')->nullable();
            $table->enum('hosting_renewal_type', ['Month', 'Year'])->nullable();
            $table->enum('annual_maintenance_cost_type', ['p', 'f'])->nullable();
            $table->decimal('annual_maintenance_cost', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
