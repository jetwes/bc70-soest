<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Contentful\Delivery\Client as DeliveryClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var DeliveryClient
     */
    private $client;

    /**
     * Controller constructor.
     * @param DeliveryClient $client
     */
    public function __construct(DeliveryClient $client)
    {
        $this->client = $client;
    }
}
