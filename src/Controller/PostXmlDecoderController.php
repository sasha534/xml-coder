<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostXmlDecoderController extends AbstractController
{
    /**
     * @Route("/post-xml-decoder", name="post_xml_decoder")
     */
    public function contactAction(Request $request) {
        $form = $this->createFormBuilder()
            ->add('name', TextareaType::class)
            ->add('send', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            //$name = $request->request->get('name');
            return $this->render('post_xml_decoder/index.html.twig', array(
                //'controller_name' => 'PostXmlDecoderController',
                'form' => $form->createView(),
                'name' => $request->request->get('form'),
            ));
        }



        return $this->render('post_xml_decoder/index.html.twig', array(
            //'controller_name' => 'PostXmlDecoderController',
            'form' => $form->createView(),
            //'name' => $name,
        ));
    }
}
