<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookGalleryController extends AbstractController
{
    /**
     * @Route("/book/gallery", name="book_gallery")
     */
    public function index()
    {
        return $this->render('book_gallery/index.html.twig', [
            'controller_name' => 'BookGalleryController',
        ]);
    }
}
