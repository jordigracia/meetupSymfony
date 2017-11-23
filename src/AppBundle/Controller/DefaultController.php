<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Event;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $client   = $this->get('eight_points_guzzle.client.api_meetup');
        $response = $client->get('/2/open_events?&sign=true&photo-host=public&lat='.$lat.'&zip='.$eventId.'&city='.$city.'&lon='.$lon.'&page=20'.'&key=2476191577a1c3d5d6141f536c6d2b');
        $data = json_decode($response->getBody(), true);

        $events = array();
        foreach ($data['results'] as $result)
        {
            dump($result);
            $test = json_encode($result);
            dump($test);
            $eventParse = $serializer->deserialize(json_encode($result), Event::class, 'json');
            dump($eventParse);
            die();
            $events[] = $eventParse;
        }

        return $this->render('default/events.html.twig', [
            'events'    =>  $events,
            'city'      =>  $city,
        ]);
    }
}
