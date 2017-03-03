<?php
/**
 * Created by PhpStorm.
 * User: Vladyslav
 * Date: 03.03.2017
 * Time: 14:57
 */

namespace components;


class SocialAuth
{
    /**
     * Service manager
     *
     * @var ServiceInterface
     */
    protected  $service = null;

    /**
     * @param ServiceInterface $service
     */
    public function __construct($service)
    {
        if ($service instanceof ServiceInterface) {
            $this->service = $service;
        } else {
            throw new \InvalidArgumentException(
                'SocialAuth only expects instance of the type AdapterInterface.'
            );
        }
    }
    /**
     * Call method authenticate() of service class
     *
     * @return bool
     */
    public function authenticate()
    {
        return $this->service->authenticate();
    }
}