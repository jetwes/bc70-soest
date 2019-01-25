<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 17.01.2019
 * Time: 15:34
 */

namespace App\Http\Controllers;


use Contentful\Delivery\Client as DeliveryClient;
use Illuminate\Http\Request;

class CampController extends Controller
{
    private $client;

    /**
     * CampController constructor.
     * @param DeliveryClient $client
     */
    public function __construct(DeliveryClient $client)
    {
        $this->client = $client;
        parent::__construct($client);
    }

    /**
     * @param Request $request
     */
    public function showCamp($id)
    {
        $entry = $this->client->getEntry($id);

        if (!$entry) {
            abort(404);
        }

        return dd($entry);

    }
}