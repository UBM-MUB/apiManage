<?php
include_once './classes/dbclass.php';
include_once './classes/apiLogs.php';
include_once './classes/configuration.php';
/**
 * Class Throttle.
 */
class Throttle{
    /**
     * Is access granted to this reequest?
     *
     * @param string $request Requested api 
     *
     * @return bool Whether access is granted
     *
     * @throws Exception
     */
    public static function trafficControll($request){
        $dbclass = new DBClass();
        $connection = $dbclass->getConnection();
        $apiLogs = new ApiLogs($connection);
        $lastRow = $apiLogs->readRow($request);
        $config = new Configuration($connection);
        //value is considered in seconds
        $duration = $config->duration();
        // $duration = 1;
        $requestLimits = $config->requestLimit();
        $currentDate = date("Y-m-d h:i:s");
        $currentTime = strtotime($currentDate);
        if(!empty($lastRow)){
            $lastRequestedTime = $lastRow['called_at'];
            $token = $lastRow['token'];
            $differenceInSeconds = $currentTime - strtotime($lastRequestedTime);
            if($duration > $differenceInSeconds){
                $counts = $apiLogs->readCountsByToken($token);
                if($counts >= $requestLimits){
                    return false;
                }

            }else{
                unset($token);
            }
        }
        if(empty($token))
        {
            $token = $currentTime;
        }
        $result = $apiLogs->create($request,$token,$currentDate);
        return true;
    }

}