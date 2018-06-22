<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/17
 * Time: 下午5:38
 */
namespace App\Eloquent;

class ApiModuleModel extends AppModel
{
    const CONSOLE = '/console';
    const MODULE_EQUIPMENT_COUNTALL = self::CONSOLE.'/equipment/countAll';
    const MODULE_EQUIPMENT_COUNT = self::CONSOLE.'/equipment/count';
    const MODULE_COLLECTOR_COUNT = self::CONSOLE.'/collector/count';
    const MODULE_ALARM_COUNT = self::CONSOLE.'/alarm/count';
    const MODULE_ALARM_COUNTALARM = self::CONSOLE.'/alarm/countAlarm';
}