<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* Class HomeController
* @package App\Controller
* @Route("/Home", name="Home_")
*/
class HomeController extends AbstractController
{
    /**
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function navbarTop(CategoryRepository $categoryRepository): Response
    {
        return $this->render('layout/navbartop.html.twig', [
        'categories' => $categoryRepository->findBy([], ['id' => 'DESC'])
        ]);
    }
}
