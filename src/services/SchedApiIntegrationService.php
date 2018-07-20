<?php
/**
 * Sched API Integration plugin for Craft CMS 3.x
 *
 * Integration with Sched API and Craft CMS
 *
 * @link      http://julianmjones.com
 * @copyright Copyright (c) 2018 Julian Jones
 */

namespace julianmjones\schedapiintegration\services;

use julianmjones\schedapiintegration\SchedApiIntegration;

use Craft;
use craft\base\Component;
use GuzzleHttp\Client;
use Yii;

/**
 * SchedApiIntegrationService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Julian Jones
 * @package   SchedApiIntegration
 * @since     1.0.0
 */
class SchedApiIntegrationService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function gets the Sponsors from the Sched API
     *
     * From any other plugin file, call it like this:
     *
     *     SchedApiIntegration::$plugin->schedApiIntegrationService->getSponsors()
     *
     * @return mixed
     */

    public function getSponsors()
    {
        $cache = Yii::$app->cache;
        $guzzleClient = new \GuzzleHttp\Client();
        //Get the attributes for the plugin
        $apiKey = SchedApiIntegration::$plugin->getSettings()->schedApiKey;
        $conferenceId = SchedApiIntegration::$plugin->getSettings()->conferenceId;

        if ($apiKey && $conferenceId) {
            $url = 'https://'.$conferenceId
            .'.sched.com/api/role/export?api_key='.$apiKey
            .'&role=sponsor&format=json&strip_html=Y';
            $response = $guzzleClient->request('POST', $url);
            if($response->getStatusCode() == "200") {
                $json = json_decode($response->getBody(), true);
                return $json;
            } else {
                return false;
            }
        } 
        return false;
    }
}
