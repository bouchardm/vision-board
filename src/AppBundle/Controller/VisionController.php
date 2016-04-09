<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/vision")
 */
class VisionController extends Controller
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function addAction()
    {
        return json_encode("");
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id" = "\d+"})
     */
    public function removeAction()
    {
        return json_encode("");
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function listAction()
    {
        return json_encode("");
    }

}
