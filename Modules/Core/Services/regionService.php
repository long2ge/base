<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/12
 * Time: 10:12 PM
 */

namespace Modules\Core\Services;


use Modules\Core\Models\region;

class regionService
{

    public function getRegions()
    {
        return Region::all();
    }



}