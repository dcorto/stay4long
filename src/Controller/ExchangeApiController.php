<?php

namespace App\Controller;

use App\Services\ExchangeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Controller used to manage exchange API
 *
 * @Route("/exchanges")
 *
 */
class ExchangeApiController extends AbstractController
{
    protected $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * @Route("/{currency}", methods={"GET"}, name="exchange_get")
     * @param string $currency
     * @return Response
     */
    public function exchangeGet(string $currency): Response
    {

        $rate = $this->exchangeService->get($currency);

        return new JsonResponse(
           [
                'status' => 'ok',
                'rate' => $rate['rate'],
           ],
            JsonResponse::HTTP_OK
        );
    }

    /**
     * @Route("/{currency}", methods={"PUT"}, name="exchange_update")
     *
     */
    public function exchangeUpdate(Request $request, string $currency): Response
    {

        try {

            $data = json_decode(
                $request->getContent(),
                true
            );

            $rate = $data['rate'];

            $result = $this->exchangeService->update($currency, $rate); //Use DTO for update the service.

            if($result) {   //TODO: Refactor for use Action Object from service for avoid this logic.
                return new JsonResponse(
                    [
                        'status' => 'ok',
                        'message' => '',
                    ],
                    JsonResponse::HTTP_OK
                );
            }
            else {
                return new JsonResponse(
                    [
                        'status' => 'error',
                        'message' => 'message of the error',
                    ],
                    JsonResponse::HTTP_OK
                );
            }

        } catch (\Exception $e) {

            return new JsonResponse(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}