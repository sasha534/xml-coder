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
            $form_xml_array = $request->request->get('form');
            $xml_array = trim($form_xml_array['name']);
            //$xml_way = './public/test1.xml';
            $xml = \simplexml_load_string($xml_array);



            //$xml = \simplexml_load_string($xml_way);
            //$xml_way = './test1.xml';
            //$xml = \simplexml_load_string($xml_way);
            //echo $movies->movie[0]->plot;
            //echo $xml->children();
            //dump($xml);
            print_r($xml_array);

//            foreach ($xml as $xml_string)
//            {
//                echo json_encode($xml_string);
//            }


            //$json = json_decode( json_encode( $sxml ) );

            echo json_decode(json_encode($xml, JSON_UNESCAPED_UNICODE));

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
