<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service\SyncStream;

use Twilio\ListResource;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
class StreamMessageList extends ListResource {
    /**
     * Construct the StreamMessageList
     * 
     * @param Version $version Version that contains the resource
     * @param string $serviceSid Service Instance SID.
     * @param string $streamSid Stream SID.
     * @return \Twilio\Rest\Sync\V1\Service\SyncStream\StreamMessageList 
     */
    public function __construct(Version $version, $serviceSid, $streamSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array(
            'serviceSid' => $serviceSid,
            'streamSid' => $streamSid,
        );

        $this->uri = '/Services/' . rawurlencode($serviceSid) . '/Streams/' . rawurlencode($streamSid) . '/Messages';
    }

    /**
     * Create a new StreamMessageInstance
     * 
     * @param array $data Stream Message body.
     * @return StreamMessageInstance Newly created StreamMessageInstance
     */
    public function create($data) {
        $data = Values::of(array(
            'Data' => Serialize::json_object($data),
        ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new StreamMessageInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['streamSid']
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Sync.V1.StreamMessageList]';
    }
}