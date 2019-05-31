<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;

class PostJsonDecoderController extends AbstractController
{
    /**
     * @Route("/post-json-decoder", name="post_json_decoder")
     */
    public function index(Request $request, FileUploader $fileUploader)
    {
        $form = $this->createFormBuilder()
            ->add('attachment', FileType::class)
            ->add('send', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted())
        {

//            $file = $product->getBrochure();
//            $fileName = $fileUploader->upload($file);
//
//            $product->setBrochure($fileName);

            $form_xml_array = $request->request->get('form');
            $json_array = $form_xml_array['attachment'];
            print_r($json_array);
            //var_dump($form_xml_array);





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
