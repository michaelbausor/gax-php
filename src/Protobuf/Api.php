<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/protobuf/api.proto

namespace Google\Protobuf;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Api is a light-weight descriptor for a protocol buffer service.
 *
 * Protobuf type <code>Google\Protobuf\Api</code>
 */
class Api extends \Google\Protobuf\Internal\Message
{
    /**
     * The fully qualified name of this api, including package name
     * followed by the api's simple name.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';
    /**
     * The methods of this api, in unspecified order.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Method methods = 2;</code>
     */
    private $methods;
    /**
     * Any metadata attached to the API.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
     */
    private $options;
    /**
     * A version string for this api. If specified, must have the form
     * `major-version.minor-version`, as in `1.10`. If the minor version
     * is omitted, it defaults to zero. If the entire version field is
     * empty, the major version is derived from the package name, as
     * outlined below. If the field is not empty, the version in the
     * package name will be verified to be consistent with what is
     * provided here.
     * The versioning schema uses [semantic
     * versioning](http://semver.org) where the major version number
     * indicates a breaking change and the minor version an additive,
     * non-breaking change. Both version numbers are signals to users
     * what to expect from different versions, and should be carefully
     * chosen based on the product plan.
     * The major version is also reflected in the package name of the
     * API, which must end in `v<major-version>`, as in
     * `google.feature.v1`. For major versions 0 and 1, the suffix can
     * be omitted. Zero major versions must only be used for
     * experimental, none-GA apis.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     */
    private $version = '';
    /**
     * Source context for the protocol buffer service represented by this
     * message.
     *
     * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
     */
    private $source_context = null;
    /**
     * Included APIs. See [Mixin][].
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Mixin mixins = 6;</code>
     */
    private $mixins;
    /**
     * The source syntax of the service.
     *
     * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
     */
    private $syntax = 0;

    public function __construct() {
        \GPBMetadata\Google\Protobuf\Api::initOnce();
        parent::__construct();
    }

    /**
     * The fully qualified name of this api, including package name
     * followed by the api's simple name.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The fully qualified name of this api, including package name
     * followed by the api's simple name.
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;
    }

    /**
     * The methods of this api, in unspecified order.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Method methods = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * The methods of this api, in unspecified order.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Method methods = 2;</code>
     * @param array|\Google\Protobuf\Internal\RepeatedField $var
     */
    public function setMethods(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Method::class);
        $this->methods = $arr;
    }

    /**
     * Any metadata attached to the API.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Any metadata attached to the API.
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Option options = 3;</code>
     * @param array|\Google\Protobuf\Internal\RepeatedField $var
     */
    public function setOptions(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Option::class);
        $this->options = $arr;
    }

    /**
     * A version string for this api. If specified, must have the form
     * `major-version.minor-version`, as in `1.10`. If the minor version
     * is omitted, it defaults to zero. If the entire version field is
     * empty, the major version is derived from the package name, as
     * outlined below. If the field is not empty, the version in the
     * package name will be verified to be consistent with what is
     * provided here.
     * The versioning schema uses [semantic
     * versioning](http://semver.org) where the major version number
     * indicates a breaking change and the minor version an additive,
     * non-breaking change. Both version numbers are signals to users
     * what to expect from different versions, and should be carefully
     * chosen based on the product plan.
     * The major version is also reflected in the package name of the
     * API, which must end in `v<major-version>`, as in
     * `google.feature.v1`. For major versions 0 and 1, the suffix can
     * be omitted. Zero major versions must only be used for
     * experimental, none-GA apis.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * A version string for this api. If specified, must have the form
     * `major-version.minor-version`, as in `1.10`. If the minor version
     * is omitted, it defaults to zero. If the entire version field is
     * empty, the major version is derived from the package name, as
     * outlined below. If the field is not empty, the version in the
     * package name will be verified to be consistent with what is
     * provided here.
     * The versioning schema uses [semantic
     * versioning](http://semver.org) where the major version number
     * indicates a breaking change and the minor version an additive,
     * non-breaking change. Both version numbers are signals to users
     * what to expect from different versions, and should be carefully
     * chosen based on the product plan.
     * The major version is also reflected in the package name of the
     * API, which must end in `v<major-version>`, as in
     * `google.feature.v1`. For major versions 0 and 1, the suffix can
     * be omitted. Zero major versions must only be used for
     * experimental, none-GA apis.
     *
     * Generated from protobuf field <code>string version = 4;</code>
     * @param string $var
     */
    public function setVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->version = $var;
    }

    /**
     * Source context for the protocol buffer service represented by this
     * message.
     *
     * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
     * @return \Google\Protobuf\SourceContext
     */
    public function getSourceContext()
    {
        return $this->source_context;
    }

    /**
     * Source context for the protocol buffer service represented by this
     * message.
     *
     * Generated from protobuf field <code>.google.protobuf.SourceContext source_context = 5;</code>
     * @param \Google\Protobuf\SourceContext $var
     */
    public function setSourceContext(&$var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\SourceContext::class);
        $this->source_context = $var;
    }

    /**
     * Included APIs. See [Mixin][].
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Mixin mixins = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMixins()
    {
        return $this->mixins;
    }

    /**
     * Included APIs. See [Mixin][].
     *
     * Generated from protobuf field <code>repeated .google.protobuf.Mixin mixins = 6;</code>
     * @param array|\Google\Protobuf\Internal\RepeatedField $var
     */
    public function setMixins(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Protobuf\Mixin::class);
        $this->mixins = $arr;
    }

    /**
     * The source syntax of the service.
     *
     * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
     * @return int
     */
    public function getSyntax()
    {
        return $this->syntax;
    }

    /**
     * The source syntax of the service.
     *
     * Generated from protobuf field <code>.google.protobuf.Syntax syntax = 7;</code>
     * @param int $var
     */
    public function setSyntax($var)
    {
        GPBUtil::checkEnum($var, \Google\Protobuf\Syntax::class);
        $this->syntax = $var;
    }

}
