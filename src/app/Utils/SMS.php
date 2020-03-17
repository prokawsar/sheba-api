<?php
namespace Utils;

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

class SMS extends \Prefab
{
  private $opts;
  private $_sender;

  public function __construct($opts)
  {
    $this->opts = $opts;
  }

  public function send($to, $message)
  {
    $app = \Base::instance();
    try{
      $sender = $this->getSender();

      if (K_ENV != K_ENV_PRODUCTION) {
        //add a [DEV] flag when not in production mode
        $message = '[DEV] ' . $message;
      }

      $options = [
        "body" => $message,
        "from" => $this->opts['sender']
      ];
      if(isset($this->opts['service']) && !empty($this->opts['service'])){
        $options['messagingServiceSid'] = $this->opts['service'];
      }

      $ret = $sender->messages->create($to, $options);

      $app->get('LOGGER')->write($ret);

      return true;

    }catch (TwilioException $e){
      $app->get('LOGGER')->write($e->getMessage());
      return false;

    }
  }

  private function getSender()
  {
    if(!$this->_sender){
      $this->_sender = new Client(
        $this->opts['sid'],
        $this->opts['token']
      );
    }

    return $this->_sender;
  }
}