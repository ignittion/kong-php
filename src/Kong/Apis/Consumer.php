<?php

namespace Ignittion\Kong\Apis;

class Consumer extends AbstractApi
{
    /**
     * Allowed API options
     *
     * @var array
     */
    protected $allowedOptions = ['username', 'custom_id'];

    /**
     * List or get a specific consumer. $user can be id or username
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#list-consumers
     * @see https://getkong.org/docs/0.6.x/admin-api/#retrieve-consumer
     *
     * @param null|string $user
     * @param array $params
     * @return \stdClass
     */
    public function get($user = null, array $params = [])
    {
        $uri    = 'consumers' . ($user ? "/{$user}" : "");
        return $this->call('get', $uri, $params);
    }

    /**
     * Create a new consumer
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#create-consumer
     *
     * @param array $options
     * @return \stdClass
     */
    public function create(array $options = [])
    {
        $body   = $this->createRequestBody($options);
        return $this->call('post', 'consumers', [], $body);
    }

    /**
     * Update a Consumer
     *
     * @param string $user
     * @param array $options
     * @return \stdClass
     */
    public function update($user, array $options = [])
    {
        $body   = $this->createRequestBody($options);
        return $this->call('patch', "consumers/{$user}", [], $body);
    }

    /**
     * Update or Create a Consumer
     *
     * @param array $options
     * @return \stdClass
     */
    public function upsert(array $options = [])
    {
        $body   = $this->createRequestBody($options);
        return $this->call('put', "consumers", [], $body);
    }

    /**
     * Delete a Consumer
     *
     * @param string $user
     * @return boolean
     */
    public function delete($user)
    {
        $resp   = $this->call('delete', "consumers/{$user}");
        return ($resp->code == 204);
    }
}
