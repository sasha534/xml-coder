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

        if($form->isSubmitted())
        {
            $form_xml_array = $request->request->get('form');
            $json_array = json_decode($form_xml_array['name']);
            //dump($json_array);

        //Создает XML-строку и XML-документ при помощи DOM
        $dom = new \DOMDocument('1.0');

        //добавление корня - <books>
        $books = $dom->appendChild($dom->createElement('z:root'));



            foreach($json_array as $name => $item)
                {
                    echo $name ."</br>";


                        foreach($item as $key => $item_1)
                        {
                            if(is_array($item))
                            {
                                foreach($item_1 as $item_2)
                                {
                                    echo $name . '--------------------------' . $item_2 ."</br>";
                                }
                            }
                            else
                            {
                                 echo $name . '-------------' . $key . '-----------' . $item_1 ."</br>";
                            }


                        }
                }

            //генерация xml
            $dom->formatOutput = true; // установка атрибута formatOutput
            // domDocument в значение true
            // save XML as string or file
            $test1 = $dom->saveXML(); // передача строки в test1
            $dom->save('test1.xml'); // сохранение файла


//            die(dump($json_array));
//            return $this->render('post_xml_decoder/index.html.twig',
//                array(
//                //'controller_name' => 'PostXmlDecoderController',
//                'form' => $form->createView(),
//                'name' => $form_xml_array['name'],
//            ));
        }



        return $this->render('post_xml_decoder/index.html.twig', array(
            //'controller_name' => 'PostXmlDecoderController',
            'form' => $form->createView(),
            //'name' => $name,
        ));
    }

    protected function recArray($ar, $searchfor) {
        static $result = array();

        foreach($ar as $k => $v) {
            if ($k == $searchfor) $result[] = $v;
            if (is_array($ar[$k]))  recarray($v, $searchfor);
        }
        return $result;
    }


    protected function makeXml($form_xml_array)
    {

        $json_array = json_decode($form_xml_array['name']);




        //Создает XML-строку и XML-документ при помощи DOM
        $dom = new DomDocument('1.0');

        //добавление корня - <books>
        $books = $dom->appendChild($dom->createElement('books'));

        //добавление элемента <book> в <books>
        $book = $books->appendChild($dom->createElement('book'));

        // добавление элемента <title> в <book>
        $title = $book->appendChild($dom->createElement('title'));

        // добавление элемента текстового узла <title> в <title>
        $title->appendChild(
        $dom->createTextNode('Great American Novel'));

        //генерация xml
        $dom->formatOutput = true; // установка атрибута formatOutput
                // domDocument в значение true
        // save XML as string or file
        $test1 = $dom->saveXML(); // передача строки в test1
        $dom->save('test1.xml'); // сохранение файла



    }



}
