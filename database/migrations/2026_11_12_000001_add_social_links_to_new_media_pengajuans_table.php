<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('new_media_pengajuans', function (Blueprint $table) {
            $table->text('linkYoutube')->nullable()->after('alamatWebsite');
            $table->text('linkFacebook')->nullable()->after('linkYoutube');
            $table->text('linkInstagram')->nullable()->after('linkFacebook');
            $table->text('linkTiktok')->nullable()->after('linkInstagram');
            $table->text('linkThreads')->nullable()->after('linkTiktok');
            $table->text('linkX')->nullable()->after('linkThreads');
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
