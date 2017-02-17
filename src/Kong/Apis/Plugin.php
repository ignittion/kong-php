<?php

namespace Ignittion\Kong\Apis;

class Plugin extends AbstractApi
{
    /**
     * List all plugins
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#list-all-plugins
     *
     * @param array $params
     * @return \stdClass
     */
    public function all(array $params = [])
    {
        return $this->call('get', 'plugins', $params);
    }

    /**
     * Get information about a specific plugin
     *
     * @param string $id
     * @param array $params
     * @return \stdClass
     */
    public function get($id, array $params = [])
    {
        return $this->call('get', "plugins/{$id}", $params);
    }

    /**
     * List plugins for a specific API
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#list-plugins-per-api
     *
     * @param string $api
     * @param array $params
     * @return \stdClass
     */
    public function perApi($api, array $params = [])
    {
        return $this->call('get', "apis/{$api}/plugins", $params);
    }

    /**
     * Get enabled plugins for the node
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#retrieve-enabled-plugins
     *
     * @return \stdClass
     */
    public function enabled()
    {
        return $this->call('get', 'plugins/enabled');
    }

    /**
     * Get plugin schema
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#retrieve-plugin-schema
     *
     * @param string $plugin
     * @return \stdClass
     */
    public function schema($plugin)
    {
        return $this->call('get', "plugins/schema/{$plugin}");
    }

    /**
     * Add a new plugin to the API
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#add-plugin
     *
     * @param string $api
     * @param string $plugin
     * @param array $body
     */
    public function add($api, $plugin, array $body = [])
    {
        $body['name']   = $plugin;
        return $this->call('post', "apis/{$api}/plugins", [], $body);
    }

    /**
     * Update a plugin
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#update-plugin
     *
     * @param string $api
     * @param string $plugin
     * @param array $body
     * @return \stdClass
     */
    public function update($api, $plugin, array $body = [])
    {
        return $this->call('patch', "apis/{$api}/plugins/{$id}", [], $body);
    }

    /**
     * Add or Update a plugin for an API
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#update-or-add-plugin
     *
     * @param string $api
     * @param array $body
     * @return \stdClass
     */
    public function upsert($api, array $body = [])
    {
        return $this->call('put', "apis/{$api}/plugins", [], $body);
    }

    /**
     * Remove a plugin from an API
     *
     * @see https://getkong.org/docs/0.6.x/admin-api/#delete-plugin
     *
     * @param string $api
     * @param string $plugin
     * @return \stdClass
     */
    public function delete($api, $plugin)
    {
        return $this->call('delete', "apis/{$api}/plugin/{$plugin}");
    }
}
