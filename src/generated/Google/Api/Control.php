<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/control.proto

namespace Google\Api;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Selects and configures the service controller used by the service.  The
 * service controller handles features like abuse, quota, billing, logging,
 * monitoring, etc.
 * </pre>
 *
 * Protobuf type <code>google.api.Control</code>
 */
class Control extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * The service control environment to use. If empty, no control plane
     * feature (like quota and billing) will be enabled.
     * </pre>
     *
     * <code>string environment = 1;</code>
     */
    private $environment = '';

    public function __construct() {
        \GPBMetadata\Google\Api\Control::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * The service control environment to use. If empty, no control plane
     * feature (like quota and billing) will be enabled.
     * </pre>
     *
     * <code>string environment = 1;</code>
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * <pre>
     * The service control environment to use. If empty, no control plane
     * feature (like quota and billing) will be enabled.
     * </pre>
     *
     * <code>string environment = 1;</code>
     */
    public function setEnvironment($var)
    {
        GPBUtil::checkString($var, True);
        $this->environment = $var;
    }

}

