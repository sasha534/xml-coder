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
        $dom = new \DOMDocument('1.0', 'UTF-8');

        //добавление корня - <books>
        $root = $dom->appendChild($dom->createElement('z:root'));

        $root->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
        $root->setAttribute('xmlns:z','http://nssmc.gov.ua/Schem/IrregEm');
        $root->setAttribute('xsi:schemaLocation','http://nssmc.gov.ua/Schem/IrregEm IrregEm.xsd');
        //$root->setAttribute('','');
        $dtstitul_o = $root->appendChild($dom->createElement('z:DTSTITUL_O'));
        $row_dtstitul_o = $dtstitul_o->appendChild($dom->createElement('z:row'));

        $dtsperson_o = $root->appendChild($dom->createElement('z:DTSPERSON_O'));

            foreach($json_array as $name => $item)
                {
                    //echo $name ."</br>";
                    if($name == 'root' and (!is_array($item)))
                        {
                            //var_dump($item);
                            //$row_dtstitul_o->setAttribute($name,$item);

                            foreach($item as $root_key => $root_atr)
                            {
                                //echo $root_key.'---------'.$root_atr."</br>";
                                $root->setAttribute($root_key,$root_atr);
                            }
                        }

                    if($name == 'DTSTITUL_O' and (!is_array($item)))
                    {
                        //var_dump($item);
                        //$row_dtstitul_o->setAttribute($name,$item);

                        foreach($item as $dtstitul_key => $dtstitul_atr)
                        {
                            echo $dtstitul_key.'---------'.$dtstitul_atr."</br>";
                            $row_dtstitul_o->setAttribute($dtstitul_key,$dtstitul_atr);
                        }
                    }

                    foreach($item as $key => $item_1)
                    {
                        if(is_array($item))
                        {
                            $row_dtsperson_o = $dtsperson_o->appendChild($dom->createElement('z:row'));
                            foreach($item_1 as $key_2 => $item_2)
                            {
                                //echo $name . '---'.$key_2."=".$item_2."</br>";
                                $row_dtsperson_o->setAttribute($key_2,$item_2);

                            }
                        }
//                        else
//                        {
//                             //echo $name . '-------------' . $key . '-----------' . $item_1 ."</br>";
//                        }


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

}
