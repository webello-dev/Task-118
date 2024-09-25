<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline_name')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('airplane')->nullable();
            $table->string('class')->nullable();
            $table->decimal('adult_fare', 15, 0)->nullable();
            $table->decimal('adult_tax', 15, 0)->nullable();
            $table->decimal('child_fare', 15, 0)->nullable();
            $table->decimal('infant_fare', 15, 0)->nullable();
            $table->string('departure_city')->nullable();
            $table->string('departure_location_code')->nullable();
            $table->string('departure_airport')->nullable();
            $table->date('departure_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->string('arrival_city')->nullable();
            $table->string('arrival_location_code')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->date('arrival_date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('baggage_quantity')->nullable();
            $table->string('baggage_unit')->nullable();
            $table->string('duration')->nullable();
            $table->string(column: 'price')->nullable();

            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->dropColumn([
                'airline_name',
                'flight_number',
                'airplane',
                'class',
                'adult_fare',
                'adult_tax',
                'child_fare',
                'infant_fare',
                'departure_city',
                'departure_location_code',
                'departure_airport',
                'departure_date',
                'departure_time',
                'arrival_city',
                'arrival_location_code',
                'arrival_airport',
                'arrival_date',
                'arrival_time',
                'baggage_quantity',
                'baggage_unit',
                'duration',
                'price',
            ]);
        });
    }
};
