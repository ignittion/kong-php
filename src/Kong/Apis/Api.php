<?php

namespace Ignittion\Kong\Apis;

class Api extends AbstractApi
{
    /**
     * Allowed API options
     *
     * @var array
     */
    protected $allowedOptions = ['name', 'request_host', 'request_path', 'strip_request_path', 'preserve_host'];

    /**
     * List all APIs or get a specific one. $api can be the APIs name or id
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#list-apis
     * @see https://getkong.org/docs/0.6.x/admin-api/#retrieve-api
     *
     * @param null|string $api
     * @return \stdClass
     */
    public function get($api = null, array $params = [])
    {
        $uri    = 'apis' . ($api !== null ? "/{$api}" : "");
        return $this->call('get', $uri, $params);
    }

    /**
     * Register a new API in Kong
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#add-api
     *
     * @param string $upstreamUrl
     * @param array $options
     * @return \stdClass
     */
    public function add($upstreamUrl, array $options = [])
    {
        $body   = $this->createRequestBody($options, ['upstream_url' => $upstreamUrl]);
        return $this->call('post', 'apis', [], $body);
    }

    /**
     * Update an existing API. $api can be the APIs name or id
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#update-api
     *
     * @param string $name
     * @param array $options
     * @return \stdClass
     */
    public function update($api, array $options)
    {
        $body   = $this->createRequestBody($options);
        return $this->call('patch', "apis/{$api}", [], $body);
    }

    /**
     * Update or Insert an API. $api can be the APIs name or id
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#update-or-create-api
     *
     * @param string $api
     * @param array $options
     * @return \stdClass
     */
    public function upsert($api, array $options)
    {
        $body   = $this->createRequestBody($options);
        return $this->call('put', "apis/{$api}", [], $body);
    }

    /**
     * Delete an API. $api can be the APIs name or id
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#delete-api
     *
     * @param string $api
     * @return \stdClass
     */
    public function delete($api)
    {
        return $this->call('delete', "apis/{$api}", [], $body);
    }
}
