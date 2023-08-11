<?php
declare(strict_types = 1);
class Logger {

    const LOG_DIRECTORY = 'uploads';

    /**
     * @throws Exception
     */
    public function __call($method, $params) {
        if(count($params)) {
            self::writeLog($params[0], $method, $params[1] ?? '');
        }
    }

    /**
     * @throws Exception
     */
    public static function __callStatic($method, $params) {
        if(count($params)) {
            self::writeLog($params[0], $method, $params[1] ?? '');
        }
    }

    /**
     * @param $content
     * @param string $filename
     * @param string $filePath
     * @throws Exception
     * @todo Get method's class name and serialize it
     */
    public static function writeLog($content, string $filename = '', string $filePath = ''): void
    {
        if(!$filename)
            $filename = 'devel';
        if(!$filePath)
        {
            if (PHP_SAPI == 'cli')
                $filePath = Logger::LOG_DIRECTORY . '_cli';
            else
                $filePath = Logger::LOG_DIRECTORY . '_web';
            if (!is_dir($filePath))
                mkdir($filePath, 0777, true);
        }
        $msg = date('d.m.Y H:i:s ') . ' Logger.php' . $_SERVER['SCRIPT_FILENAME'] . "# Params: " . implode(';', $content) . PHP_EOL;
        $filePath .= '/' . $filename . '.log';
        if (!error_log($msg, 3, $filePath)) {
            throw new Exception('error_log crashed');
        }
    }

}