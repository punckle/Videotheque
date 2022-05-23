<?php

namespace App\Controller;

use App\Form\ApiSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

            return $this->redirectToRoute('api_query', [
                'query' => $data['query']
            ]);
        }

        return $this->render('admin/api/index.html.twig', [
            'apiSearchForm' => $form->createView()
        ]);
    }

    #[Route('/query/{query}', name: 'api_query')]
    public function getQuery(string $query): Response
    {
        return $this->render('admin/api/search_results.html.twig', [
            'query' => $query
        ]);
    }

    #[Route('/search_results/{query}', name: 'search_results')]
    public function searchResults(string $query): Response
    {
        $personsUrl = null;
        $moviesUrl = null;
        $tvUrl = null;

        if ($query) {
            $query = str_replace(' ', '+', $query);
            $apiKey = "aec4d5d7be64f05cf44a29476e490ca5";

            $personsUrl = 'https://api.themoviedb.org/3/search/person?api_key='.$apiKey.'&language=fr-FR&query='.strtolower($query).'&page=1&include_adult=false';
            //$creditsUrl = 'https://api.themoviedb.org/3/person/{person_id}/movie_credits?api_key='.$apiKey.'&language=en-US';
            $moviesUrl = 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKey.'&language=fr-FR&query='.strtolower($query);
            $tvUrl = 'https://api.themoviedb.org/3/search/tv/?api_key='.$apiKey.'&language=fr-FR&query='.strtolower($query);
        }

        $persons = null;
        $movies = null;
        $tv = null;

        if ($personsUrl) {
            $persons = json_decode((string) file_get_contents($personsUrl));
        }

        if ($moviesUrl) {
            $movies = json_decode((string) file_get_contents($moviesUrl));
        }

        if ($tvUrl) {
            $tv = json_decode((string) file_get_contents($tvUrl));
        }

        return new JsonResponse([
            'status' => 'ok',
            'persons' => $persons,
            'movies' => $movies,
            'tvShows' => $tv
        ]);
    }
}
