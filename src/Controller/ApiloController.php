<?php

namespace App\Controller;

use App\Service\ApiloApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiloController extends AbstractController
{
    /**
     * @Route("/languages", name="languages")
     */
    public function languages(ApiloApiService $apiloApiService): JsonResponse
    {
        $languages = $apiloApiService->getLanguages();

        return $this->json($languages);
    }

    /**
     * @Route("/translate", name="translate")
     */
    public function translate(Request $request, ApiloApiService $apiloApiService): JsonResponse
    {
        $source = $request->query->get('source');
        $target = $request->query->get('target');
        $text = $request->query->get('text');

        $translation = $apiloApiService->translate($source, $target, $text);

        return $this->json(['translation' => $translation]);
    }
}
