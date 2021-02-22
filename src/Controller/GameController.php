<?php

namespace App\Controller;

use App\Entity\Bot;
use App\Entity\Human;
use App\Entity\Board;
use App\Service\PlayService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game')]
    public function index(Request $request, PlayService $playService): Response
    {
        $requestContent = json_decode($request->getContent());
        $board = new Board($requestContent->board);
        $human = new Human();
        $afterHumanMove = $playService->play($board, $human);
        if ($afterHumanMove['winner'] || $afterHumanMove['draw']) {
            $response = $this->json($afterHumanMove);
        } else {
            $bot = new Bot();
            $botMove = $bot->move($board);
            $board->setMove($botMove);
            $afterBotMove = $playService->play($board, $bot, $botMove);
            $response = $this->json($afterBotMove);
        }

        return $response;
    }
}
