<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/texttospeech/v1/cloud_tts.proto

namespace Google\Cloud\TextToSpeech\V1\CustomVoiceParams;

use UnexpectedValueException;

/**
 * The usage of the synthesized audio. You must report your honest and
 * correct usage of the service as it's regulated by contract and will cause
 * significant difference in billing.
 *
 * Protobuf type <code>google.cloud.texttospeech.v1.CustomVoiceParams.ReportedUsage</code>
 */
class ReportedUsage
{
    /**
     * Request with reported usage unspecified will be rejected.
     *
     * Generated from protobuf enum <code>REPORTED_USAGE_UNSPECIFIED = 0;</code>
     */
    const REPORTED_USAGE_UNSPECIFIED = 0;
    /**
     * For scenarios where the synthesized audio is not downloadable and can
     * only be used once. For example, real-time request in IVR system.
     *
     * Generated from protobuf enum <code>REALTIME = 1;</code>
     */
    const REALTIME = 1;
    /**
     * For scenarios where the synthesized audio is downloadable and can be
     * reused. For example, the synthesized audio is downloaded, stored in
     * customer service system and played repeatedly.
     *
     * Generated from protobuf enum <code>OFFLINE = 2;</code>
     */
    const OFFLINE = 2;

    private static $valueToName = [
        self::REPORTED_USAGE_UNSPECIFIED => 'REPORTED_USAGE_UNSPECIFIED',
        self::REALTIME => 'REALTIME',
        self::OFFLINE => 'OFFLINE',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ReportedUsage::class, \Google\Cloud\TextToSpeech\V1\CustomVoiceParams_ReportedUsage::class);

