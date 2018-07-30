<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license https://vistart.name/license/
 */

namespace common\models\rhoone;

/**
 * Server demo for rho one extension.
 *
 * @author vistart <i@vistart.name>
 */
class Server extends \rhoone\extension\Server
{
    /**
     * Server name.
     * @throws NotSupportedException
     */
    public static function name()
    {
        return 'local.rho.ren';
    }

    /**
     * Trusted hosts (hostname or IP address).
     * @throws NotSupportedException
     */
    public static function getHosts()
    {
        return ['local.rho.ren'];
    }

    /**
     * Trusted search endpoints.
     * @throws NotSupportedException
     */
    public static function getSearchEndpoints()
    {
        return ['local.rho.ren/rho.one/rho.one/search'];
    }

    /**
     * Trusted administration endpoint.
     * @throws NotSupportedException
     */
    public static function getAdminEndpoint()
    {
        return ['local.rho.ren/rho.one/rho.one/admin'];
    }

    public function search($keywords)
    {
        return $keywords;
    }
}
