<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            ->add('name', TextType::class)
            ->add('send', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            var_dump($request->request);
            die(var_dump($request->request->get('name')));
        }







        return $this->render('post_xml_decoder/index.html.twig', [
            //'controller_name' => 'PostXmlDecoderController',
            'form' => $form->createView(),
        ]);
    }
}
