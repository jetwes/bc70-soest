<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 18.01.2019
 * Time: 12:30
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Contentful\Delivery\Client as DeliveryClient;
use Illuminate\Http\Request;
use Spatie\Menu\Laravel\Facades\Menu;

class HomepageController extends Controller
{

    /**
     * @var DeliveryClient
     */
    protected $client;

    /**
     * HomepageController constructor.
     * @param DeliveryClient $client
     */
    public function __construct(DeliveryClient $client)
    {
        $this->client = $client;
        parent::__construct($client);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // news
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('news')
            ->orderBy('sys.createdAt',true)
            ->setLimit(10);
        //->setLocale('*');
        $news = $this->client->getEntries($query);
        $query = new \Contentful\Delivery\Query();
        $query->setContentType('termin')
            ->where('fields.datum[gte]',Carbon::now()->format('Y-m-d H:i'))
            ->orderBy('fields.datum')
            ->setLimit(10);
        $termine = $this->client->getEntries($query);
        $options = (new \Contentful\Core\File\ImageOptions())
        ->setFormat('jpg')
        ->setHeight(301);

        $query = new \Contentful\Delivery\Query();
        $query->setContentType('sponsor');
        //->setLocale('*');
        $sponsoren = $this->client->getEntries($query);

        $query = new \Contentful\Delivery\Query();
        $query->setContentType('person');
        $query->where('fields.typ','Vorstand');
        $query->where('fields.bild[ne]',null);
        $query->orderBy('fields.name');
        //->setLocale('*');
        $vorstand = $this->client->getEntries($query);

        $startseite = $this->client->getEntry('53C6HEqBvCTjFkYILU9yUr');
        return view('welcome',compact('news','termine','options','sponsoren','startseite','vorstand'));

    }

}