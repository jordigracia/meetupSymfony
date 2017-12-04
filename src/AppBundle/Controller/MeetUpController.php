<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\DTOs\Event;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use DMS\Service\Meetup\Plugin\KeyAuthPlugin;
use DMS\Service\Meetup\MeetupKeyAuthClient;


class MeetUpController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $key        = $this->getParameter('app.meetup.apikey');
        $client     = MeetupKeyAuthClient::factory(array('key' => $key));

        $response   = $client->getFindLocations();
        $currentLocation = json_decode($response->getBody());

        return $this->render('default/index.html.twig', [
            'currentLocation'=> $currentLocation,
        ]);
    }


    /**
     * @Route("/{eventId}/latitude/{lat}/longitude/{lon}/{city}/events",
     *      requirements={"lat"=".+", "lon"=".+", "city"=".+"},name="events")
     */
    public function eventsAction($eventId, $lat, $lon, $city)
    {
        $key        = $this->getParameter('app.meetup.apikey');
        $encoders   = array(new XmlEncoder(), new JsonEncoder());
        $normalizers= array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $client     = MeetupKeyAuthClient::factory(array('key' => $key));
        $response = $client->getFindEvents();
        $response   = $client->getOpenEvents(array(
            'lat'   =>  $lat,
            'lon'   =>  $lon,
            'zip'   =>  $eventId,
            'city'  =>  $city,
        ));

        $data       = json_decode($response->getBody(), true);
        $events     = array();

        foreach ($data['results'] as $result)
        {
            $eventParse = $serializer->deserialize(json_encode($result), Event::class, 'json');
            $events[] = $eventParse;
        }

        return $this->render('default/events.html.twig', [
            'events'    =>  $events,
            'city'      =>  $city,
        ]);
    }
}