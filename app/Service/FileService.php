<?php

namespace App\Service;

class FileService
{
    const LOG_FILE = 'logReadMessage.txt';

    /**
     * @return int
     */
    public static function getLastMessage():int
    {
        $lastMessage = 0;
        $f = fopen(self::LOG_FILE, 'r') or die ('Unable to open file!');

        while (($s = fgets($f)) !== false){
            $lastMessage = $s;
        }

        fclose($f);
        return trim($lastMessage);
    }

    /**
     * @param int $messageId
     */
    public static function setLastMessage(int $messageId):void
    {
        $fd = fopen(self::LOG_FILE, 'a+') or die('Unable to open file!');
        fwrite($fd, $messageId. PHP_EOL);
        fclose($fd);
    }

}
