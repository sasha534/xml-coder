<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('name', TextareaType::class)
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
            $xml_array = $form_xml_array['name'];
            //$xml_way = './public/test1.xml';
            $xml = \simplexml_load_string($xml_array);
            //echo $movies->movie[0]->plot;
            //echo $xml->children();
            //dump($xml);

//            foreach ($xml->children() as $xml_string)
//            {
//                dump($xml_string);
//            }






            print_r($xml);
            //var_dump($form_xml_array);

            return $this->render('post_json_decoder/index.html.twig', [
                'controller_name' => 'PostJsonDecoderController',
                'form' => $form->createView(),
                //'json_array' => $item,
            ]);
        }



        return $this->render('post_json_decoder/index.html.twig', [
            'controller_name' => 'PostJsonDecoderController',
            'form' => $form->createView(),
        ]);
    }
}
