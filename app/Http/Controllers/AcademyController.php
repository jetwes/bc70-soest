<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 22.01.2019
 * Time: 10:27
 */

namespace App\Http\Controllers;

use Contentful\Delivery\Client as DeliveryClient;

class AcademyController extends Controller
{
    protected $client;

    public function __construct(DeliveryClient $client)
    {
        $this->client = $client;
        parent::__construct($client);
    }

    public function bc70()
    {

    }

    public function kinder()
    {

    }

}