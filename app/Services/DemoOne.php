<?php
namespace App\Services;

class DemoOne
{ 
  // public function doSomethingUseful()
  // {
  //   return 'Output from DemoOne';
  // }

  protected string $clientId;
    protected string $clientSecret;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function authenticate()
    {
        // ...
    }

    public function getSales(string $month)
    {
        // ...
    }
  
}