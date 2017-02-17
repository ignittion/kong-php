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
}
