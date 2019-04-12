<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/12
 * Time: 10:16 PM
 */

namespace Modules\Core\Http\Controllers\V1;


use Modules\Core\Http\Controllers\BaseCoreController;
use Modules\Core\Models\region;
use Modules\Core\Services\regionService;

class RegionController extends BaseCoreController
{
    /**
     * @var RegionService 地区服务
     */
    private $regionService;

    /**
     * 构造函数
     * RegionService constructor.
     * @param RegionService $regionService
     */
    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    public function index(int $provinceId, int $cityId)
    {

    }
}