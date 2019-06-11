<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;

class FormJsonController extends AbstractController
{
    /**
     * @Route("/form-json", name="form_json")
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
            //$form_xml_array = $request->request->get('form');
            //dump($form_xml_array); die();
            //$xml_array = $form_xml_array['name'];
//            //dump($xml_array); die();
//            //$xml_way = './public/test1.xml';
//            $xml_array = str_replace(array("\n", "\r", "\t"), '', $xml_array);
//            //dump($xml_array); die();
//            $xml_array = trim(str_replace('"', "'", $xml_array));
//            //dump($xml_array); die();
            //$xml = \simplexml_load_file("test1.xml") or die("Error: Cannot create object");

//            $xml = "test1.xml";
//            $doc = new \DOMDocument();
//            $doc->load("test1.xml") or die("Error: Cannot create object");
//
////            $crawler = new Crawler($xml_array);
////
//            foreach ($doc as $domElement) {
//                echo $domElement;
//            }
//
//            dump($doc->getElementsByTagName( "DTSTITUL_O" ));
//
//
//            dump($doc->getElementsByTagName( "root" ));
//
//            dump($doc);


            $reader = new \XMLReader();
            $reader->open('test1.xml'); // указываем ридеру что будем парсить этот файл
            // циклическое чтение документа
            while($reader->read()) {
//                if($reader->nodeType == \XMLReader::ELEMENT) {
//                    // если находим элемент <card>
//                    if($reader->localName == 'root') {
//                        $data = array();
//                        // считываем аттрибут number
////                        $data['number'] = $reader->getAttribute('number');
////                        // читаем дальше для получения текстового элемента
////                        $reader->read();
////                        if($reader->nodeType == XMLReader::TEXT) {
////                            $data['name'] = $reader->value;
////                        }
//                        // ну и запихиваем в бд, используя методы нашего адаптера к субд
////                        SomeDataBaseAdapter::insertContact($data);
//                        //dump($data);
//                    }
//                }
                //$reader->nodeType == \XMLReader::ELEMENT;
                dump($reader);
            }



            die;



//DOM
//            $doc = new DOMDocument();
//            $doc->load( 'books.xml' );
//
//            $books = $doc->getElementsByTagName( "book" );
//            foreach( $books as $book ) {
//                $authors = $book->getElementsByTagName("author");
//                $author = $authors->item(0)->nodeValue;
//
//                $publishers = $book->getElementsByTagName("publisher");
//                $publisher = $publishers->item(0)->nodeValue;
//
//                $titles = $book->getElementsByTagName("title");
//                $title = $titles->item(0)->nodeValue;
//
//                echo "$title - $author - $publisher\n";
//
//            }








            //$json = json_decode( json_encode( $sxml ) );

            //print_r (json_decode(json_encode($xml, JSON_UNESCAPED_UNICODE), true));
            //print_r (json_encode($xml_children_s, JSON_UNESCAPED_UNICODE));
            return $this->render('form_json/index.html.twig', [
                'controller_name' => 'FormJsonController',
                'form' => $form->createView(),
                'domElement' => $domElement,
            ]);
        }



        return $this->render('post_json_decoder/index.html.twig', [
            'controller_name' => 'PostJsonDecoderController',
            'form' => $form->createView(),
        ]);
    }
}
