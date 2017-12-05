<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DMS\Service\Meetup\MeetupKeyAuthClient;

use AppBundle\Entity\DTOs\Event;
use MeetUp\CoreDomain\Event\MeetupEvent;

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
        $serializer = $this->get('jms_serializer');

        $client     = MeetupKeyAuthClient::factory(array('key' => $key));
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
            $eventParse = $serializer->deserialize(json_encode($result),Event::class, 'json');
            $events[] = $eventParse;
        }

        return $this->render('default/events.html.twig', [
            'events'    =>  $events,
            'city'      =>  $city,
        ]);
    }
}