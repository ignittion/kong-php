<?php

namespace Ignittion\Kong\Apis;

class OAuth2Plugin extends AbstractApi
{

  /**
   * Add OAuth2 tokens to Kong.
   *
   * @see https://getkong.org/plugins/oauth2-authentication/#migrating-access-tokens
   *
   * @param array $options
   * @return \stdClass
   */
  public function oauth2Tokens(array $options = [])
  {
      $body   = $this->createRequestBody($options);
      return $this->call('post', 'oauth2_tokens', [], $body);
  }
  
  /**
   * Get a specific client application.
   *
   * @see https://getkong.org/plugins/oauth2-authentication/#the-flow-explained
   *
   * @param string $clientId
   * @param array $params
   * @return \stdClass
   */
  public function oauth2($clientId, array $params = [])
  {
      return $this->call('get', 'oauth2?client_id=' . $clientId, $params);
  }
}
