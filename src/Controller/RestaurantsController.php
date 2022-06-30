<?php

namespace App\Controller;

use App\Entity\ImagesRestaurant;
use App\Entity\Restaurants;
use App\Form\RestaurantsType;
use App\Repository\ImagesRestaurantRepository;
use App\Repository\RestaurantsRepository;

use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/restaurants')]
class RestaurantsController extends AbstractController
{
    #[Route('/', name: 'app_restaurants_index', methods: ['GET'])]
    public function index(RestaurantsRepository $restaurantsRepository): Response
    {
        return $this->render('restaurants/index.html.twig', [
            'restaurants' => $restaurantsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_restaurants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestaurantsRepository $restaurantsRepository,FileUploader $fileUploader,ImagesRestaurantRepository $imagesRestaurantRepository): Response
    {
        $restaurant = new Restaurants();
        $form = $this->createForm(RestaurantsType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('img')->getData();
            foreach ($images as $image) {
                $fichier = $fileUploader->upload($image);

                $imgResto = new ImagesRestaurant();
                $imgResto->setRestaurants($restaurant);
                $imgResto->setUrl($fichier);
                $imagesRestaurantRepository->add($imgResto);
            }
            $restaurantsRepository->add($restaurant, true);

            return $this->redirectToRoute('app_restaurants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurants/new.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restaurants_show', methods: ['GET'])]
    public function show(Restaurants $restaurant): Response
    {
        return $this->render('restaurants/show.html.twig', [
            'restaurant' => $restaurant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_restaurants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restaurants $restaurant, RestaurantsRepository $restaurantsRepository): Response
    {
        $form = $this->createForm(RestaurantsType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurantsRepository->add($restaurant, true);

            return $this->redirectToRoute('app_restaurants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restaurants/edit.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restaurants_delete', methods: ['POST'])]
    public function delete(Request $request, Restaurants $restaurant, RestaurantsRepository $restaurantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $restaurantsRepository->remove($restaurant, true);
        }

        return $this->redirectToRoute('app_restaurants_index', [], Response::HTTP_SEE_OTHER);
    }
}
