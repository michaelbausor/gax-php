<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/wrappers.proto

namespace Google\Protobuf;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Wrapper message for `uint32`.
 * The JSON representation for `UInt32Value` is JSON number.
 * </pre>
 *
 * Protobuf type <code>google.protobuf.UInt32Value</code>
 */
class UInt32Value extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * The uint32 value.
     * </pre>
     *
     * <code>uint32 value = 1;</code>
     */
    private $value = 0;

    public function __construct() {
        \GPBMetadata\Google\Protobuf\Wrappers::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * The uint32 value.
     * </pre>
     *
     * <code>uint32 value = 1;</code>
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * <pre>
     * The uint32 value.
     * </pre>
     *
     * <code>uint32 value = 1;</code>
     */
    public function setValue($var)
    {
        GPBUtil::checkUint32($var);
        $this->value = $var;
    }

}
