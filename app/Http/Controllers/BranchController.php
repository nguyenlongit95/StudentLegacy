<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{
    //get id branh by hashtag
    public function getIdBranchBy($hashTag) {
        $branches = Branch::get();

        foreach ($branches as $item) {
            $hashTags = json_decode($item->hash_tags);
            foreach ($hashTags as $tag) {
                if (strpos($tag, $hashTag) !== false) {
                    return $item->id;
                }
            }
        }

        return -1;
    }

    public function checkSameBranch($hash1, $hash2) {
        $id1 = $this->getIdBranchBy($hash1);
        $id2 = $this->getIdBranchBy($hash2);

        if ($id1 == -1 || $id2 == -1 || $id1 != $id2 ) {
            return false;
        }

        return true;
    }
}
