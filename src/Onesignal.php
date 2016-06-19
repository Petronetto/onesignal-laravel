<?php

namespace greedchikara\Onesignal;

/**
 * 
 */
class Onesignal
{

    protected $config;
    protected $userAuthKey;

    protected $appName;
    protected $appKeys;
    protected $appId;
    protected $appRestApiKey;

    protected $viewAppsLink;
    protected $viewDevicesLink;
    protected $viewNotificationLink;

    /**
     * Create a new Onesignal Instance
     */
    public function __construct($config = [])
    {

        $this->config = $config;

        // Checking the Config file values
        $this->checkConfigFile();

        // Setting Keys
        $this->userAuthKey = $this->config['user_auth_key'];

        $this->appName = $this->config['first_app_name'];

        // Setting API Routes
        $this->viewAppsLink         = $this->config['view_apps'];
        $this->viewDevicesLink      = $this->config['view_devices'];
        $this->viewNotificationLink = $this->config['view_notifications'];

        // Setting the App
        $this->setApp($this->appName);
    }

    /**
     * Set keys for the Onesignal App
     * @param string $appName
     */
    public function setApp($appName)
    {
        $this->appKeys = $this->config[$appName];
        $this->appId   = $this->appKeys['app_id'];
        $this->appRestApiKey = $this->appKeys['rest_api_key'];

        // Checking the properties required by the Onesignal
        $this->checkProperties();
    }

    /**
     * View the details of all of your current OneSignal apps
     * @return mixed
     */
    public function viewApps()
    {
        $apiUrl  = $this->viewAppsLink;

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->userAuthKey}"
        ];

        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View the details of a single OneSignal app
     * @return json
     */
    public function viewApp()
    {
        $apiUrl  = "{$this->viewAppsLink}/{$this->appId}";

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->userAuthKey}"
        ];

        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View the details of all of your current Onesignal Devices
     * NOT AVAILABLE FOR APPS WITH OVER 100,000 USERS.
     * For performance reasons, this method is not available for larger apps. 
     * Larger apps should use the /players/csv_export API endpoint is available, which it's also much faster.
     * @param  integer $limit  
     * @param  integer $offset 
     * @return mixed
     */
    public function viewDevices($limit=10, $offset=0)
    {

        $apiUrl = "{$this->viewDevicesLink}?app_id={$this->appId}&limit={$limit}&offset={$offset}";

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->appRestApiKey}"
        ];
        
        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View the details of single Onesignal Device
     * @param  string $playerId registered Onesignal Device Id
     * @return json
     */
    public function viewDevice($playerId)
    {
       $apiUrl = "{$this->viewDevicesLink}/{$playerId}";

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->appRestApiKey}"
        ];
        
        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View the details of all the notification
     * @param  integer $limit
     * @param  integer $offset
     * @return mixed
     */
    public function viewNotifications($limit=10, $offset=0)
    {
        $apiUrl = "{$this->viewNotificationLink}?app_id={$this->appId}&limit={$limit}&offset={$offset}";

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->appRestApiKey}"
        ];
        
        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View the details of a notification
     * @param  string $notificationId
     * @return json
     */
    public function viewNotification($notificationId)
    {
        $apiUrl = "{$this->viewNotificationLink}/{$notificationId}?app_id={$this->appId}";
        
        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic {$this->appRestApiKey}"
        ];
        
        return $this->makeGetApiCall($apiUrl, $headers);
    }

    /**
     * View Open Track of a notification
     * @param  $string
     * @return json
     */
    public function notificationOpenTrack($notificationId)
    {
        $apiUrl = "{$this->viewNotificationLink}/{$notificationId}";

        $headers = [
            "Content-Type: application/json"
        ];

        $data = [
            "opened" => true, 
            "app_id" => $this->appId
        ];

        return $this->makePutApiCall($apiUrl, $headers, $data);
    }

    /**
     * Executing the GET API call
     * @param  string $apiUrl  API URL
     * @param  array  $headers 
     * @return mixed
     */
    private function makeGetApiCall($apiUrl, $headers)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * Executing the PUT API call
     * @param  string $apiUrl  API URL
     * @param  array  $headers
     * @param  array  $data
     * @return mixed
     */
    private function makePutApiCall($apiUrl, $headers, $data)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * Checks the key of the config files
     * @param  array $this->config 
     * @return throws Exception
     */
    private function checkConfigFile()
    {

        $partialErrorString = "Look's like you have messed up the Onesignal config.";

        if( !isset($this->config['user_auth_key']) )
        {
            throw new \Exception("{$partialErrorString} Check User Auth Key - user_auth_key.", 1);
        }

        if( !isset($this->config['first_app_name']) )
        {
            throw new \Exception("{$partialErrorString} Check App Name key - first_app_name.", 1);   
        }

        if( !isset($this->config[$this->config['first_app_name']]) )
        {
            throw new \Exception("{$partialErrorString} Check First App Name key - first_app_name.", 1);
        }

        if( !isset($this->config[$this->config['first_app_name']]['app_id']) )
        {
            throw new \Exception("{$partialErrorString} Check App Id key - app_id.", 1);    
        }

        if( !isset($this->config[$this->config['first_app_name']]['rest_api_key']) )
        {
            throw new \Exception("{$partialErrorString} Check Rest Api Key - rest_api_key.", 1);
        }

        if( !isset($this->config['view_apps']) )
        {
            throw new \Exception("{$partialErrorString} Check View App link key - view_apps.", 1);
        }

        if( !isset($this->config['view_devices']) )
        {
            throw new \Exception("{$partialErrorString} Check View Devices Link key - view_devices.", 1);
        }

        if( !isset($this->config['view_notifications']) )
        {
            throw new \Exception("{$partialErrorString} Check View Notification Link key - view_notifications.", 1);
        }

        return $this;
    }

    /**
     * Checks the Properties required for One Signal to work
     * @return throws Exception
     */
    private function checkProperties()
    {

        $partialErrorString = "Please update your onesignal config file.";

        if( !isset($this->userAuthKey) )
        {
            throw new \Exception("User Auth Key is not set. {$partialErrorString}", 1);
        }

        if( !isset($this->appName) )
        {
            throw new \Exception("App Name is not set. {$partialErrorString}", 1);   
        }

        if( !isset($this->appKeys) )
        {
            throw new \Exception("App Keys not set. {$partialErrorString}", 1);
        }

        if( !isset($this->appId) )
        {
            throw new \Exception("App Id is not set. {$partialErrorString}", 1);    
        }

        if( !isset($this->appRestApiKey) )
        {
            throw new \Exception("Rest Api Key is not set. {$partialErrorString}", 1);
        }

        if( !isset($this->viewAppsLink) )
        {
            throw new \Exception("View App link is not set. {$partialErrorString}", 1);
        }

        if( !isset($this->viewDevicesLink) )
        {
            throw new \Exception("View Devices Link is not set. {$partialErrorString}", 1);
        }

        if( !isset($this->viewNotificationLink) )
        {
            throw new \Exception("View Notification Link is not set. {$partialErrorString}", 1);
        }
    }
}
