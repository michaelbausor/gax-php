<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/rpc/error_details.proto

namespace Google\Rpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * A message type used to describe a single quota violation.  For example, a
 * daily quota or a custom quota that was exceeded.
 * </pre>
 *
 * Protobuf type <code>google.rpc.QuotaFailure.Violation</code>
 */
class QuotaFailure_Violation extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * The subject on which the quota check failed.
     * For example, "clientip:&lt;ip address of client&gt;" or "project:&lt;Google
     * developer project id&gt;".
     * </pre>
     *
     * <code>string subject = 1;</code>
     */
    private $subject = '';
    /**
     * <pre>
     * A description of how the quota check failed. Clients can use this
     * description to find more about the quota configuration in the service's
     * public documentation, or find the relevant quota limit to adjust through
     * developer console.
     * For example: "Service disabled" or "Daily Limit for read operations
     * exceeded".
     * </pre>
     *
     * <code>string description = 2;</code>
     */
    private $description = '';

    public function __construct() {
        \GPBMetadata\Google\Rpc\ErrorDetails::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * The subject on which the quota check failed.
     * For example, "clientip:&lt;ip address of client&gt;" or "project:&lt;Google
     * developer project id&gt;".
     * </pre>
     *
     * <code>string subject = 1;</code>
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * <pre>
     * The subject on which the quota check failed.
     * For example, "clientip:&lt;ip address of client&gt;" or "project:&lt;Google
     * developer project id&gt;".
     * </pre>
     *
     * <code>string subject = 1;</code>
     */
    public function setSubject($var)
    {
        GPBUtil::checkString($var, True);
        $this->subject = $var;
    }

    /**
     * <pre>
     * A description of how the quota check failed. Clients can use this
     * description to find more about the quota configuration in the service's
     * public documentation, or find the relevant quota limit to adjust through
     * developer console.
     * For example: "Service disabled" or "Daily Limit for read operations
     * exceeded".
     * </pre>
     *
     * <code>string description = 2;</code>
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * <pre>
     * A description of how the quota check failed. Clients can use this
     * description to find more about the quota configuration in the service's
     * public documentation, or find the relevant quota limit to adjust through
     * developer console.
     * For example: "Service disabled" or "Daily Limit for read operations
     * exceeded".
     * </pre>
     *
     * <code>string description = 2;</code>
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;
    }

}
