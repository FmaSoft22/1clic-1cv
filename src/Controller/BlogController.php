<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_index')]
    public function index(): Response
    {
        $ViewData['Action'] = 'index';
        $ViewData['Controller']='BlogController';
        return $this->render('blog/index.html.twig', [
            'ViewData' => $ViewData,
        ]);
    }
}
