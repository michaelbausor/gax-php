<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/backend.proto

namespace Google\Api;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * A backend rule provides configuration for an individual API element.
 * </pre>
 *
 * Protobuf type <code>google.api.BackendRule</code>
 */
class BackendRule extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Selects the methods to which this rule applies.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax details.
     * </pre>
     *
     * <code>string selector = 1;</code>
     */
    private $selector = '';
    /**
     * <pre>
     * The address of the API backend.
     * </pre>
     *
     * <code>string address = 2;</code>
     */
    private $address = '';
    /**
     * <pre>
     * The number of seconds to wait for a response from a request.  The
     * default depends on the deployment context.
     * </pre>
     *
     * <code>double deadline = 3;</code>
     */
    private $deadline = 0.0;

    public function __construct() {
        \GPBMetadata\Google\Api\Backend::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Selects the methods to which this rule applies.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax details.
     * </pre>
     *
     * <code>string selector = 1;</code>
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * <pre>
     * Selects the methods to which this rule applies.
     * Refer to [selector][google.api.DocumentationRule.selector] for syntax details.
     * </pre>
     *
     * <code>string selector = 1;</code>
     */
    public function setSelector($var)
    {
        GPBUtil::checkString($var, True);
        $this->selector = $var;
    }

    /**
     * <pre>
     * The address of the API backend.
     * </pre>
     *
     * <code>string address = 2;</code>
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * <pre>
     * The address of the API backend.
     * </pre>
     *
     * <code>string address = 2;</code>
     */
    public function setAddress($var)
    {
        GPBUtil::checkString($var, True);
        $this->address = $var;
    }

    /**
     * <pre>
     * The number of seconds to wait for a response from a request.  The
     * default depends on the deployment context.
     * </pre>
     *
     * <code>double deadline = 3;</code>
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * <pre>
     * The number of seconds to wait for a response from a request.  The
     * default depends on the deployment context.
     * </pre>
     *
     * <code>double deadline = 3;</code>
     */
    public function setDeadline($var)
    {
        GPBUtil::checkDouble($var);
        $this->deadline = $var;
    }

}

