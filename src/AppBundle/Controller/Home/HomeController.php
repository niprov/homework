<?php

namespace AppBundle\Controller\Home;

use AppBundle\Form\Type\HomeFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\FormUpload;
use Symfony\Component\Form\FormInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template(template="@App/Home/index.html.twig")
     */
    public function indexAction()
    {
        $formUpload = new FormUpload();
        $form = $this->createForm(HomeFormType::class,$formUpload, array('action' => $this->generateUrl('upload_create')));

        return array(
            'home_form' => $form->createView()
        );
    }

    /**
     *
     * @Route("/upload/create", name="upload_create")
     * @Method("POST")
     *
     */
    public function createAction(Request $request)
    {
        $formUpload = new FormUpload();
        $form = $this->createForm(HomeFormType::class,$formUpload, array('action' => $this->generateUrl('upload_create')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $formUpload->getFile();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $formUpload->setFile($fileName);
            $formUpload->setFirstName($formUpload->getFirstName());
            $formUpload->setSurname($formUpload->getSurname());

            $manager->persist($formUpload);
            $manager->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $errors = $this->getErrorsFromForm($form);
        $data = [
            'errors' => $errors
        ];
        return new JsonResponse($data, 400);

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        return $errors;
    }
}