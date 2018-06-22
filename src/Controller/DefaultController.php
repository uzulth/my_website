<?php


namespace App\Controller;


use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        if ($request->isMethod('POST') && $request->request->get('antispam') != '42')
        {
            $this->get('session')->getFlashBag()->add('red','La réponse à l\'antispam est incorrect');

        }
        elseif ($request->isMethod('POST') && $request->request->get('antispam') == '42')
        {
            $data = [];
            $data['nom'] = $request->request->get('nom');
            $data['mail'] = $request->request->get('mail');
            $data['message'] = $request->request->get('message');


            $message = new \Swift_Message('hello');
            $message
                ->setTo('contact@yannclain.com')
                ->setFrom('website@yannclain.com')
                ->setSubject('Contact Website : '.$data['nom'])
                ->setBody($this->renderView('/Default/Layout/email.html.twig'),array(
                    'data'=>$data
                ));

            $mailer->send($message);

            $this->get('session')->getFlashBag()->add('green','Le message a bien été envoyé');

            return $this->redirectToRoute('index');

        }

        return $this->render('/Default/Layout/index.html.twig');
    }
}