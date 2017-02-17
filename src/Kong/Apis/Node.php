<?php

namespace Ignittion\Kong\Apis;

class Node extends AbstractApi
{
    /**
     * Get basic information about a node
     *
     * @return \stdClass
     */
    public function get()
    {
        $response   = $this->call('get', '');

        return $response;
    }

    /**
     * Retrieve node status
     *
     * @return \stdClass
     */
    public function status()
    {
        return $this->call('get', 'status');
    }

    /**
     * Retrieve cluster status
     *
     * @return \stdClass
     */
    public function cluster()
    {
        return $this->call('get', 'cluster');
    }

    /**
     * Remove this node from the cluster
     *
     * @return boolean
     */
    public function removeFromCluster()
    {
        $result = $this->call('delete', 'cluster');
        return ($result->code == 200);
    }
}
