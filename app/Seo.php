<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    //
    protected $table="seo";

    protected $fillable = [
        "id",
        "link",
        "checksum",
        "title",
        "keywords",
        "description",
        "h1",
        "noindex",
        "avatar",
        "language",
        "created_at",
        "updated_at"
    ];

    // Function render seo to pages
    public function seo_render($checksum){
        $SeoLinks = DB::table('seo')->where('checksum',$checksum)
            ->where('link','!=', null)->first();
        return $SeoLinks;
    }
}
