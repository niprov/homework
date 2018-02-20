<?php

namespace AppBundle\Controller\FormUpload;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\FormUpload;

class FormUploadController extends Controller
{
    /**
     * @Route("/upload/list", name="uploadlist")
     * @Template(template="@App/FormUpload/list.html.twig")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $records = $em->getRepository('AppBundle:FormUpload')->findAll();

        return array(
          'records' => $records
        );
    }
}