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
        Schema::table('designs', function (Blueprint $table) {
            if (!Schema::hasColumn('designs', 'photo')) {
                $table->string('photo')->nullable()->after('description');
            }
            if (!Schema::hasColumn('designs', 'design_date')) {
                $table->date('design_date')->nullable()->after('photo');
            }
            if (!Schema::hasColumn('designs', 'fabric_type')) {
                $table->string('fabric_type')->nullable()->after('design_date');
            }
            if (!Schema::hasColumn('designs', 'color')) {
                $table->string('color')->nullable()->after('fabric_type');
            }
            if (!Schema::hasColumn('designs', 'style')) {
                $table->string('style')->nullable()->after('color');
            }
            if (!Schema::hasColumn('designs', 'occasion')) {
                $table->string('occasion')->nullable()->after('style');
            }
            if (!Schema::hasColumn('designs', 'special_instructions')) {
                $table->text('special_instructions')->nullable()->after('occasion');
            }
            if (!Schema::hasColumn('designs', 'first_fitting')) {
                $table->date('first_fitting')->nullable()->after('special_instructions');
            }
            if (!Schema::hasColumn('designs', 'final_fitting')) {
                $table->date('final_fitting')->nullable()->after('first_fitting');
            }
            if (!Schema::hasColumn('designs', 'completion_date')) {
                $table->date('completion_date')->nullable()->after('final_fitting');
            }
            if (!Schema::hasColumn('designs', 'delivery_date')) {
                $table->date('delivery_date')->nullable()->after('completion_date');
            }
            if (!Schema::hasColumn('designs', 'estimated_price')) {
                $table->decimal('estimated_price', 8, 2)->nullable()->after('delivery_date');
            }
            if (!Schema::hasColumn('designs', 'final_price')) {
                $table->decimal('final_price', 8, 2)->nullable()->after('estimated_price');
            }
              if (!Schema::hasColumn('designs', 'part_payment')) {
                $table->decimal('part_payment', 8, 2)->nullable()->after('final_price');
            }
                 if (!Schema::hasColumn('designs', 'balance')) {
                $table->decimal('balance', 8, 2)->nullable()->after('part_payment');
            }
            if (!Schema::hasColumn('designs', 'notes')) {
                $table->text('notes')->nullable()->after('final_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->dropColumn([
                'photo',
                'design_date',
                'fabric_type',
                'color',
                'style',
                'occasion',
                'special_instructions',
                'first_fitting',
                'final_fitting',
                'completion_date',
                'delivery_date',
                'estimated_price',
                'final_price',
                'part_payment',
                'balance',
                'notes'
            ]);
        });
    }
};