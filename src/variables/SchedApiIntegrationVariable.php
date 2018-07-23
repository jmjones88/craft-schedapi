<?php
/**
 * Sched API Integration plugin for Craft CMS 3.x
 *
 * Integration with Sched API and Craft CMS
 *
 * @link      http://julianmjones.com
 * @copyright Copyright (c) 2018 Julian Jones
 */

namespace julianmjones\schedapiintegration\variables;

use julianmjones\schedapiintegration\SchedApiIntegration;

use Craft;

/**
 * Sched API Integration Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.schedApiIntegration }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Julian Jones
 * @package   SchedApiIntegration
 * @since     1.0.0
 */
class SchedApiIntegrationVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.schedApiIntegration.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.schedApiIntegration.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function sponsors($optional = null)
    {
        $result = SchedApiIntegration::$plugin->schedApiIntegrationService->getSponsors();
        return $result;
    }

    public function schedule($optional = null)
    {
        $result = SchedApiIntegration::$plugin->schedApiIntegrationService->getSchedule();
        return $result;
    }

    public function getUser($term, $by = 'username')
    {
        $result = SchedApiIntegration::$plugin->schedApiIntegrationService->getUser($term, $by);
        return $result;
    }
}
