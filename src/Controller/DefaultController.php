<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class DefaultController extends AbstractController
{

    private const POSTS = [
        [
            'id' => 1,
            'slug' => 'hello-world',
            'title' => 'Hello world'
        ],
        [
            'id' => 2,
            'slug' => 'another-post',
            'title' => 'This is another post!'
        ],
    ];


    /**
     * @Route("/{page}", name="blog_list")
     */
    public function list($page = 1, \Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\HttpFoundation\Response
    {
       $limit = $request->get('limit', 10);

       return new \Symfony\Component\HttpFoundation\Response($limit);

   /*  return new JsonResponse(
            [
                'page' => $page,
                'limit' => $limit,
                'data' => array_map(function ($item) {
                    return $this->generateUrl('blog_by_slug',['slug' => $item['slug']]);
                }, self::POSTS)
            ]
        ); */
    }

    /**
     * @Route("/{id}", name="blog_by_id")
     */

    public function post($id): JsonResponse
    {
        return $this->json(
            self::POSTS[array_search($id, array_column(self::POSTS, 'id'))]
        );
    }

    /**
     * @Route("/{slug}", name="blog_by_slug")
     */
    public function postBySlug($slug): JsonResponse
    {
        return  $this->json(
            self::POSTS[array_search($slug, array_column(self::POSTS, 'slug'))]
        );
    }

}