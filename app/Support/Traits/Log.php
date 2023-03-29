<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log as FacadesLog;

trait Log
{

    /** Create an activity log register at database 
     * 
     * @param string $log Log message
     * @param Model $where Model where the action happened
     * @param mixed $who Model or Id of User who caused the action
     * @param string $type Action type, snake case is recommended, eg. create_user, change_permissions - Default: default
     * 
     * @return void
     */
    public function activity_log($log, Model $where, $who, $type = 'default')
    {
        activity($type)
            ->by($who)
            ->on($where)
            ->withProperties(["ipAddress" => $_SERVER['REMOTE_ADDR'], "userAgent" => $_SERVER['HTTP_USER_AGENT']])
            ->log($log);
    }

    /** Create a error log */
    public function error_log($exception, $class = null)
    {
        FacadesLog::error($exception->getMessage(), [
            'Class' => $class,
            'Line' => $exception->getLine(),
            'Trace' => $exception->getTraceAsString(),
        ]);
    }

    /** Create a debug log */
    public function debug_log($exception, $class = null)
    {
        FacadesLog::debug($exception->getMessage(), [
            'Class' => $class,
            'Line' => $exception->getLine(),
            'Trace' => $exception->getTraceAsString(),
        ]);
    }

    /** Create a alert log */
    public function alert_log($exception, $class = null)
    {
        FacadesLog::alert($exception->getMessage(), [
            'Class' => $class,
            'Line' => $exception->getLine(),
            'Trace' => $exception->getTraceAsString(),
        ]);
    }

    /** Create a info log */
    public function info_log($exception, $class = null)
    {
        FacadesLog::info($exception->getMessage(), [
            'Class' => $class,
            'Line' => $exception->getLine(),
            'Trace' => $exception->getTraceAsString(),
        ]);
    }
}
