<?php

namespace App\Traits;

use Spatie\Activitylog\Traits\LogsActivity;

trait MakeLog{

    use LogsActivity;

    /**
     * Enabled all attributes to be logged.
     *
     * @var boolean
     */
    protected static $logFillable = true;

    /**
     * Log only changed attributes.
     *
     * @var boolean
     */
    protected static $logOnlyDirty = true;

    /**
     * Use model name if log name is not defined
     *
     * @return string
     */
    public function getLogNameToUse(string $eventName = ''): string
    {
        if (isset(static::$logName)) {
            return static::$logName;
        }

        $classname = static::class;
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return $pos;
    }

    /**
     * Get activities related to model
     */
    public function activityLogs(){
        return $this->hasMany('App\ActivityLog', 'subject_id')->where('subject_type', static::class);
    }
}
