<?php

use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection('mongodb')->create('user_activity_logs', function (Blueprint $collection) {
            $collection->index('user_id');
            $collection->index('activity_type');
            $collection->index('details');
            // Add more indexes or schema modifications as needed
        });
    }

    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('user_activity_logs');
    }
};
