<?php

use App\Models\Tasks;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('status');
            $table->string('author');
            $table->timestamp('created_at');
        });

        Tasks::insert(
            array(
                [
                    'title' => 'Improving your programming skills',
                    'status' => 'At work',
                    'author' => 'pro3dwork',
                    'created_at' => '2020-07-27'
                ],
                [
                    'title' => 'Find a programmer',
                    'status' => 'Done',
                    'author' => 'PHP SUPPORT',
                    'created_at' => '2020-05-17'
                ],
                [
                    'title' => 'Get a job at PHP SUPPORT',
                    'status' => 'At work',
                    'author' => 'pro3dwork',
                    'created_at' => '2020-07-18'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
