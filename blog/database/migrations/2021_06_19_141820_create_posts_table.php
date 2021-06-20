<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id"); //pour lier l'identifiant de la category a laquelle appartiendra ce post
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable(); //pour suivre le chemin qui permet de recupérer une image (elles ne sont pas dans la BDD) NULLABLE permet de dire que ce n'est pas obligatoire
            $table->longText('content'); //longText permet une grande mémoire à la redaction des articles
            $table->boolean('published')->default(false); //donner la possibilité au redacteur de sauvegarder ses données avant de les publier FASLE = tout article ecrit ne sera pas publié
            $table->softDeletes(); //on ne supprime pas on le déplace comme une sorte de corbeil
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories'); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
