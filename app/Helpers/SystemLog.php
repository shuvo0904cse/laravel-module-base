<?php


namespace App\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SystemLog
{
    /**
     * Info Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function info($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->info( $message , $value);
        }
    }

    /**
     * Error Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function error($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->error( $message , $value );
        }
    }

    /**
     * Alert Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function alert($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->alert( $message , $value);
        }
    }

    /**
     * Warning Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function warning($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->warning( $message , $value);
        }
    }

    /**
     * Critical Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function critical($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->critical( $message , $value);
        }
    }

    /**
     * Emergency Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function emergency($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->emergency( $message , $value);
        }
    }

    /**
     * Debug Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function debug($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->debug( $message , $value);
        }
    }

    /**
     * Notice Log File
     *
     * @param $labelName
     * @param string $message
     * @param null $channelName
     * @param array $value
     */
    public static function notice($labelName, $message = "Change", $channelName = null, $value = [])
    {
        $logger = self::setLogFile( $labelName, $channelName );
        if( $logger ){
            $logger->notice( $message , $value);
        }
    }

    /**
     * Set Log File
     *
     * @param null $labelName
     * @param null $channel
     * @return Logger
     */
    protected static function setLogFile($labelName = null, $channel = null)
    {
        $log = new Logger($labelName);

        $directory = self::getLogDirectory()."/".self::getLogFileName($channel);
        $log->pushHandler(new StreamHandler($directory), 0777);

        return $log;
    }

    /**
     * Get Log Directory
     *
     * @return string
     */
    protected static function getLogDirectory()
    {
        $dir =  storage_path('logs');
        if(!is_dir($dir))UtilsHelper::makeDirectory($dir);
        return $dir;
    }

    /**
     * Get Log File Name
     *
     * @param null $channel
     * @return string|string[]
     */
    protected static function getLogFileName($channel = null)
    {
        $fileName = self::getFileName($channel).'_'.date('Y-m-d').'.log';
        $fileName = str_replace("-", "_", $fileName);
        return $fileName;
    }

    /**
     * @param $channel
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected static function getFileName($channel)
    {
        switch ($channel) {
            case config("settings.passport_log"):
                return config("settings.passport_log");
            default:
                return config("settings.system_log");
        }
    }
}