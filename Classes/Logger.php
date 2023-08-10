<?php
declare(strict_types = 1);
const LOG_DIRECTORY = 'uploads';
class Logger {

    /**
     * @throws Exception
     */
    public function __call($method, $params) {
        if(count($params)) {
            self::writeLog($params[0],$method,$params[1]);
        }
    }

    /**
     * @throws Exception
     */
    public static function __callStatic($method, $params) {
        if(count($params)) {
            self::writeLog($params[0],$method,$params[1]);
        }
    }

    /**
     * @param $content
     * @param string $filename
     * @param string $filePath
     * @throws Exception
     */
    public static function writeLog($content, string $filename='', string|null $filePath=''): void
    {
        if(!$filename)
            $filename = 'devel';
        if(!$filePath)
        {
            $is_console = PHP_SAPI == 'cli';
            if ($is_console)
                $filePath = LOG_DIRECTORY . '_cli';
            else
                $filePath = $_SERVER["DOCUMENT_ROOT"] . LOG_DIRECTORY . '_web';
            if (!is_dir($filePath))
                mkdir($filePath, 0777, true);
        }
        //maybe i can somehow get method's class name?
        $msg = date('d.m.Y H:i:s ') . ' ' . $_SERVER['SCRIPT_FILENAME'] . "# Params: " . implode(';', $content) . PHP_EOL;
        $fullFileName = $filePath.'/'.$filename.'.log';
        if (!error_log($msg, 3, $fullFileName)) {
            throw new Exception('error_log crashed');
        }
    }

}