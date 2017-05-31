<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/iam/v1/policy.proto

namespace Google\Iam\V1;

/**
 * <pre>
 * The type of action performed on a Binding in a policy.
 * </pre>
 *
 * Protobuf enum <code>google.iam.v1.BindingDelta.Action</code>
 */
class BindingDelta_Action
{
    /**
     * <pre>
     * Unspecified.
     * </pre>
     *
     * <code>ACTION_UNSPECIFIED = 0;</code>
     */
    const ACTION_UNSPECIFIED = 0;
    /**
     * <pre>
     * Addition of a Binding.
     * </pre>
     *
     * <code>ADD = 1;</code>
     */
    const ADD = 1;
    /**
     * <pre>
     * Removal of a Binding.
     * </pre>
     *
     * <code>REMOVE = 2;</code>
     */
    const REMOVE = 2;
}
