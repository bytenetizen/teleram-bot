<?php


namespace App\Service;


class PerformerService
{

    /**
     * @param array $getUpdates
     */
    public static function do(array $getUpdates)
    {
        $setLastMessage = 0;
        foreach ($getUpdates as $getUpdate){

            $workArr = $getUpdate->toArray();

            self::doMessage($workArr);

            ArrService::searchKey('update_id', $workArr, $setLastMessage);

        }

        FileService::setLastMessage($setLastMessage);

    }


    /**
     * @param array $workArr
     */

    private static function doMessage(array $workArr)
    {
        $result = '';
        ArrService::searchKey('text', $workArr, $result);

        //Так вказано в ТЗ, просто виконнання кода
        $checkArr = ['Привет', 'Hi', 'Hello', 'привіт'];

        if(in_array($result,$checkArr)){
            self::doCommand('php -v');
        }

        $checkStr = mb_substr($result, 0, 3);

        if($checkStr === 'XXX'){
            $command = trim(preg_replace('/[XXX]{3}/', '', $result));
            self::doCommand($command);
        }

    }

    /**
     * @param string $command
     */
    private static function doCommand(string $command)
    {
        $command = escapeshellcmd($command);
        $exec = exec($command);
    }

}
