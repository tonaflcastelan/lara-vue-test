<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->integer('status')->unsigned();
            $table->timestamps();
        });

        $roles = array('Administrador', 'Usuario', 'Vendedor');

        foreach ($roles as $rol){
            DB::table('roles')->insert(
                [
                    'name'      => $rol,
                    'status'    => 1,
                    'created_at' => date('Y-m-d H:s:i'),
                    'updated_at' => date('Y-m-d H:s:i'),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
