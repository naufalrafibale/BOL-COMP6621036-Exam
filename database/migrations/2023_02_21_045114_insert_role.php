<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roleAdmin = new Role;
        $roleStaff = new Role;
        $roleCustomer = new Role;

        $roleAdmin->name = "admin";
        $roleStaff->name = "staff";
        $roleCustomer->name = "customer";

        $roleAdmin->save();
        $roleStaff->save();
        $roleCustomer->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
