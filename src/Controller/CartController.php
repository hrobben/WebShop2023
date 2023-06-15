<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route("/cart", name="cart")
 */
#[isgranted('ROLE_USER')]
class CartController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/", name="_view")
     */
    public function index(ProductRepository $productRepository): Response
    {
        // get the cart from  the session
        $session = $this->requestStack->getSession();
        // $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cart = $session->set('cart', '');
        $cart = $session->get('cart', array());

        // $cart = array_keys($cart);
        // print_r($cart); die;

        // fetch the information using query and ids in the cart
        if ($cart != '') {


            if (isset($cart)) {
                $product = $productRepository->findAll();
                // alle 1000000000000 producten inladen om b.v. max 25 producten te laten zien.   NIET HANDIG TODO
                // misschien kan je hier alleen de producten inlezen die er in deze sessie zijn genoteerd.
            }


            return $this->render('cart/index.html.twig', array(
                'empty' => false,
                'product' => $product,
                //'documents' => $documentRepository->findAll(),
            ));
        } else {
            return $this->render('cart/index.html.twig', array(
                'empty' => true,
                //'documents' => $documentRepository->findAll(),
            ));
        }
    }

    /**
     * @Route("/add/{id}", name="_add")
     */
    public function addAction($id, ProductRepository $productRepository)
    {
        // fetch the cart
        //$em = $this->getDoctrine()->getManager();
        $product = $productRepository->find($id);
        //print_r($product->getId()); die;
        //$session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', array());

        // check if the $id already exists in it.
        if ($product == NULL) {
            $this->get('session')->setFlash('notice', 'This product is not     available in Stores');
            return $this->redirect($this->generateUrl('cart'));
        } else {
            if (isset($cart[$id])) {

                ++$cart[$id];
            } else {
                // if it doesnt make it 1
                $cart[$id] = 1;
                //$cart[$id]['quantity'] = 1;
            }

            $session->set('cart', $cart);
            //echo('<pre>');
            //print_r($cart); echo ('</pre>');die();
            return $this->redirect($this->generateUrl('cart_view'));

        }
    }

    /**
     * @Route("/remove/{id}", name="_remove")
     */
    public function removeAction($id)
    {
        // check the cart
        //$session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $session = $this->requestStack->getSession();
        $cart = $session->get('cart', array());

        // if it doesn't exist redirect to cart index page. end
        if (!$cart[$id]) {
            $this->redirect($this->generateUrl('cart_view'));
        }

        // check if the $id already exists in it.
        if (isset($cart[$id])) {
            $cart[$id] = $cart[$id] - 1;
            if ($cart[$id] < 1) {
                unset($cart[$id]);
            }
        } else {
            return $this->redirect($this->generateUrl('cart_view'));
        }

        $session->set('cart', $cart);

        //echo('<pre>');
        //print_r($cart); echo ('</pre>');die();

        return $this->redirect($this->generateUrl('cart_view'));
    }

}