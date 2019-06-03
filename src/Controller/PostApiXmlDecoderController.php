<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostApiXmlDecoderController extends AbstractController
{
    /**
     * @Route("/post-api-xml-decoder", name="post_api_xmi_decoder", methods={"POST"})
     *
     */
    public function index(Request $request) {

            //$form_xml_array = $request->getContent();  //some key
            $json_array = json_decode($request->getContent(), true);
            //dump($json_array);

            //Создает XML-строку и XML-документ при помощи DOM
            $dom = new \DOMDocument('1.0', 'UTF-8');

            //добавление корня - <books>
            $root = $dom->appendChild($dom->createElement('z:root'));

            $dtstitul_o = $root->appendChild($dom->createElement('z:DTSTITUL_O'));
            $row_dtstitul_o = $dtstitul_o->appendChild($dom->createElement('z:row'));

            $dtsperson_o = $root->appendChild($dom->createElement('z:DTSPERSON_O'));

            foreach($json_array as $name => $item)
            {
                //echo $name ."</br>";
                if($name == 'root' and (!is_array($item)))
                {
                    //var_dump($item);
                    foreach($item as $root_key => $root_atr)
                    {
                        //echo $root_key.'---------'.$root_atr."</br>";
                        $row_dtstitul_o ->setAttribute($root_key,$root_atr);
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
                            else
                            {
                                 //echo $name . '-------------' . $key . '-----------' . $item_1 ."</br>";
                            }


                }
            }
            //генерация xml
            $dom->formatOutput = true; // установка атрибута formatOutput
            // domDocument в значение true
            // save XML as string or file
            $test1 = $dom->saveXML(); // передача строки в test1
            $dom->save('test1.xml'); // сохранение файла




        return $this->render('post_api_xml_decoder/index.html.twig', array(
            //'controller_name' => 'PostApiXmlDecoderController',
        ));
    }
}