<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('tracking_code')->unique();
            $table->unsignedInteger('commune_id')->index();
            $table->foreignId('delivery_type_id')->constrained();
            $table->foreignId('status_id')->constrained('package_statuses');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->boolean('can_be_opened')->default(true);
            $table->string('name')->nullable();
            $table->string('client_first_name');
            $table->string('client_last_name');
            $table->string('client_phone');
            $table->string('client_phone2')->nullable();
            $table->double('cod_to_pay')->default(0);
            $table->double('commission')->default(0);
            $table->dateTime('status_updated_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->double('delivery_price')->unsigned();
            $table->unsignedInteger('extra_weight_price')->default(0)->comment('Prix extra poids');
            $table->boolean('free_delivery');
            $table->unsignedInteger('packaging_price')->default(0);
            $table->double('partner_cod_price')->default(0);
            $table->unsignedInteger('partner_delivery_price')->default(0)->comment('price to pay company partner');
            $table->double('partner_return')->default(0);
            $table->double('price');
            $table->double('price_to_pay');
            $table->unsignedInteger('return_price')->default(0);
            $table->double('total_price');
            $table->unsignedInteger('weight')->default(1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
