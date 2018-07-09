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
    const DEMO = '/console/algorithm/demo';
    const MODULE_EQUIPMENT_COUNTALL = self::CONSOLE.'/equipment/countAll';
    const MODULE_EQUIPMENT_COUNT = self::CONSOLE.'/equipment/count';
    const MODULE_EQUIPMENT_MANAGE = self::CONSOLE.'/equipment/manage';
    const MODULE_EQUIPMENT_SAVE = self::CONSOLE.'/equipment/save';
    const MODULE_EQUIPMENT_DELETE = self::CONSOLE.'/equipment/delete';
    const MODULE_EQUIPMENT_RETRIEVEBYID = self::CONSOLE.'/equipment/retrieveById';

    const MODULE_COLLECTOR_RETRIEVEBYFIRMID = self::CONSOLE.'/collector/retrieveByFirmId';
    const MODULE_COLLECTOR_SAVE = self::CONSOLE.'/collector/save';
    const MODULE_COLLECTOR_MODIFY = self::CONSOLE.'/collector/modify';
    const MODULE_COLLECTOR_DELETE = self::CONSOLE.'/collector/delete';
    const MODULE_COLLECTOR_RETRIEVEBYID = self::CONSOLE.'/collector/retrieveById';
    const MODULE_COLLECTOR_COUNT = self::CONSOLE.'/collector/count';

    const MODULE_ALARM_RETRIEVEALARM= self::CONSOLE.'/alarm/retrieveAlarm';
    const MODULE_ALARM_RETRIEVEBYPARAMS = self::CONSOLE.'/alarm/retrieveByParams';
    const MODULE_ALARM_UPDATEBYID = self::CONSOLE.'/alarm/updateById';
    const MODULE_ALARM_COUNT = self::CONSOLE.'/alarm/count';
    const MODULE_ALARM_COUNTALARM = self::CONSOLE.'/alarm/countAlarm';

    const MODULE_THRESHOLD_RETRIEVE = self::CONSOLE.'/threshold/retrieve';
    const MODULE_THRESHOLD_DELETE = self::CONSOLE.'/threshold/delete';
    const MODULE_THRESHOLD_RETRIEVEBYID = self::CONSOLE.'/threshold/retrieveById';
    const MODULE_THRESHOLD_SAVEORUPDATE = self::CONSOLE.'/threshold/saveOrUpdate';

    const MODULE_COMPANY_LIST   = self::CONSOLE.'/company/list';
    const MODULE_COMPANY_DELETE = self::CONSOLE.'/company/delete';
    const MODULE_COMPANY_SAVE   = self::CONSOLE.'/company/save';
    const MODULE_COMPANY_RETRIEVEBYID   = self::CONSOLE.'/company/retrieveById';

    const MODULE_PERMISSION_LIST    = self::CONSOLE.'/permission/list';
    const MODULE_PERMISSION_DELETE  = self::CONSOLE.'/permission/delete';
    const MODULE_PERMISSION_SAVE    = self::CONSOLE.'/permission/save';
    const MODULE_PERMISSION_RETRIEVEBYID   = self::CONSOLE.'/permission/retrieveById';
    const MODULE_PERMISSION_ALLPERMISSIONS   = self::CONSOLE.'/permission/allPermissions';

    const MODULE_USER_LIST   = self::CONSOLE.'/user/list';
    const MODULE_USER_DELETE = self::CONSOLE.'/user/delete';
    const MODULE_USER_SAVE   = self::CONSOLE.'/user/save';
    const MODULE_USER_RETRIEVEBYID   = self::CONSOLE.'/user/retrieveById';
    const MODULE_USER_RETRIEVEALLADMINISTRATORS   = self::CONSOLE.'/user/retrieveAllAdministrators';

    const MODULE_ROLE_LIST   = self::CONSOLE.'/role/list';
    const MODULE_ROLE_DELETE = self::CONSOLE.'/role/delete';
    const MODULE_ROLE_SAVE   = self::CONSOLE.'/role/save';
    const MODULE_ROLE_RETRIEVEBYID   = self::CONSOLE.'/role/retrieveById';


    const MODULE_DEMO = self::DEMO;

}