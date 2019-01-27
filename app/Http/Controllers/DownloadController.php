<?php
/**
 * Created by PhpStorm.
 * User: j.twesmann
 * Date: 17.01.2019
 * Time: 15:34
 */

namespace App\Http\Controllers;


use Contentful\Delivery\Client as DeliveryClient;
use Contentful\Delivery\Query;
use Contentful\RichText\Renderer;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    private $client;
    private $renderer;
    private $options;

    public function __construct(DeliveryClient $client, Renderer $renderer)
    {
        $this->client = $client;
        $this->renderer = $renderer;
        $this->options = (new \Contentful\Core\File\ImageOptions())
            ->setFormat('jpg')
            ->setHeight(635);
        parent::__construct($client);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $query = new Query();
        $query->setContentType('download');
        $query->orderBy('sys.createdAt',true);
        $downloads = $this->client->getEntries($query);
        return view('downloads',['title' => 'Download','downloads' => $downloads]);
    }

    public function download($id)
    {

    }
}