<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Guzzle\Http\Client;
use Guzzle\Plugin\Oauth\OauthPlugin;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /* Testing api connection */
        $client   = $this->get('eight_points_guzzle.client.api_meetup');
        $response = $client->get('/find/locations?photo-host=public&sig_id=241706216&sig=c769c936d88d4e9b75dddfc4c92f1c9a578b1e13');

        $currentLocation = json_decode($response->getBody());

        return $this->render('default/index.html.twig', [
            'currentLocation'=> $currentLocation,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("/{eventId}/latitude/{lat}/longitude/{lon}/{city}/events",
     *      requirements={"lat"=".+", "lon"=".+", "city"=".+"},name="events")
     */
    public function eventsAction($eventId, $lat, $lon, $city)
    {
        $client   = $this->get('eight_points_guzzle.client.api_meetup');
        $response = $client->get('/2/open_events?&sign=true&photo-host=public&lat='.$lat.'&zip='.$eventId.'&city='.$city.'&lon='.$lon.'&page=20'.'&key=2476191577a1c3d5d6141f536c6d2b');
        dump($response->getStatusCode());
        $jsonResponse = json_decode($response->getBody());

        dump($jsonResponse);



        return $this->render('default/events.html.twig', [
            'response'  =>  $jsonResponse,
            'city'      =>  $city,
        ]);
    }
}
