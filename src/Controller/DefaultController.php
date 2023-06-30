<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('default/index.html.twig',[
                'products' => $productRepository->findAll(), // findBy(['category' => 2]),
            ]
        );
    }
}
