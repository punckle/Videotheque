<?php

namespace App\Controller;

use App\Form\ApiSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/api')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'app_api')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ApiSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $url = null;

            if ($data['title']) {
                $title = str_replace(' ', '+', $data['title']);
                $url = 'https://api.themoviedb.org/3/search/movie?api_key=aec4d5d7be64f05cf44a29476e490ca5&language=fr-FR&query=' . $title;
            }

            if ($url) {
                $movies = json_decode((string) file_get_contents($url));
                dd($movies);
            }
        }

        return $this->render('admin/api/index.html.twig', [
            'apiSearchForm' => $form->createView()
        ]);
    }
}
