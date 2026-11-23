<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->string('linkYoutube')->nullable()->after('alamatWebsite');
            $table->string('linkFacebook')->nullable()->after('linkYoutube');
            $table->string('linkInstagram')->nullable()->after('linkFacebook');
            $table->string('linkTiktok')->nullable()->after('linkInstagram');
            $table->string('linkThreads')->nullable()->after('linkTiktok');
            $table->string('linkX')->nullable()->after('linkThreads');
        });
    }

    public function down()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->dropColumn([
                'linkYoutube',
                'linkFacebook',
                'linkInstagram',
                'linkTiktok',
                'linkThreads',
                'linkX',
            ]);
        });
    }
};
