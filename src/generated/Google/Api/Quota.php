<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/api/quota.proto

namespace Google\Api;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Quota configuration helps to achieve fairness and budgeting in service
 * usage.
 * The quota configuration works this way:
 * - The service configuration defines a set of metrics.
 * - For API calls, the quota.metric_rules maps methods to metrics with
 *   corresponding costs.
 * - The quota.limits defines limits on the metrics, which will be used for
 *   quota checks at runtime.
 * An example quota configuration in yaml format:
 *    quota:
 *      limits:
 *      - name: apiWriteQpsPerProject
 *        metric: library.googleapis.com/write_calls
 *        unit: "1/min/{project}"  # rate limit for consumer projects
 *        values:
 *          STANDARD: 10000
 *      # The metric rules bind all methods to the read_calls metric,
 *      # except for the UpdateBook and DeleteBook methods. These two methods
 *      # are mapped to the write_calls metric, with the UpdateBook method
 *      # consuming at twice rate as the DeleteBook method.
 *      metric_rules:
 *      - selector: "*"
 *        metric_costs:
 *          library.googleapis.com/read_calls: 1
 *      - selector: google.example.library.v1.LibraryService.UpdateBook
 *        metric_costs:
 *          library.googleapis.com/write_calls: 2
 *      - selector: google.example.library.v1.LibraryService.DeleteBook
 *        metric_costs:
 *          library.googleapis.com/write_calls: 1
 *  Corresponding Metric definition:
 *      metrics:
 *      - name: library.googleapis.com/read_calls
 *        display_name: Read requests
 *        metric_kind: DELTA
 *        value_type: INT64
 *      - name: library.googleapis.com/write_calls
 *        display_name: Write requests
 *        metric_kind: DELTA
 *        value_type: INT64
 * </pre>
 *
 * Protobuf type <code>google.api.Quota</code>
 */
class Quota extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * List of `QuotaLimit` definitions for the service.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.QuotaLimit limits = 3;</code>
     */
    private $limits;
    /**
     * <pre>
     * List of `MetricRule` definitions, each one mapping a selected method to one
     * or more metrics.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.MetricRule metric_rules = 4;</code>
     */
    private $metric_rules;

    public function __construct() {
        \GPBMetadata\Google\Api\Quota::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * List of `QuotaLimit` definitions for the service.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.QuotaLimit limits = 3;</code>
     */
    public function getLimits()
    {
        return $this->limits;
    }

    /**
     * <pre>
     * List of `QuotaLimit` definitions for the service.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.QuotaLimit limits = 3;</code>
     */
    public function setLimits(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Api\QuotaLimit::class);
        $this->limits = $arr;
    }

    /**
     * <pre>
     * List of `MetricRule` definitions, each one mapping a selected method to one
     * or more metrics.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.MetricRule metric_rules = 4;</code>
     */
    public function getMetricRules()
    {
        return $this->metric_rules;
    }

    /**
     * <pre>
     * List of `MetricRule` definitions, each one mapping a selected method to one
     * or more metrics.
     * Used by metric-based quotas only.
     * </pre>
     *
     * <code>repeated .google.api.MetricRule metric_rules = 4;</code>
     */
    public function setMetricRules(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Api\MetricRule::class);
        $this->metric_rules = $arr;
    }

}

