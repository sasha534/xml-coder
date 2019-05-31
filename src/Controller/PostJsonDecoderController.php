<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PostJsonDecoderController extends AbstractController
{
    /**
     * @Route("/post-json-decoder", name="post_json_decoder")
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('attachment', FileType::class)
            ->add('send', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted())
        {



            





            return $this->render('post_json_decoder/index.html.twig', [
                'controller_name' => 'PostJsonDecoderController',
                'form' => $form->createView(),
            ]);
        }



        return $this->render('post_json_decoder/index.html.twig', [
            'controller_name' => 'PostJsonDecoderController',
            'form' => $form->createView(),
        ]);
    }
}
