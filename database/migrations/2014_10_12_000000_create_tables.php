<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Role;
use App\Models\Customer;
use App\Models\Room;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('rooms');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->foreignIdFor(Role::class);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone_number');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->integer('booked_nights');
            $table->dateTime('booked_start_date');
            $table->dateTime('booked_end_date');
            $table->foreignIdFor(Customer::class);
            $table->foreignIdFor(Room::class);
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('price_per_night');
            $table->integer('available_rooms');
            $table->integer('booked_rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
