<?php

namespace App\EventSubscriber;

use App\Entity\Bot;
use App\Entity\Board;
use App\Entity\Human;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Controller\RequestValidatedControllerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RequestSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof RequestValidatedControllerInterface) {
            $requestContent = json_decode($event->getRequest()->getContent());

            if (!isset($requestContent->board)) {
                throw new BadRequestException('Request does not contain required data');
            }

            if (!is_array($requestContent->board)) {
                throw new BadRequestException('Invalid data format');
            }

            $board = new Board([]);
            $boardSize = $board->getSize();
            $content = $requestContent->board;

            if (count($content) !== $boardSize || !in_array($boardSize, array_map('count', $content), true)) {
                throw new BadRequestException('Table size is not 3x3');
            }

            $bot = new Bot();
            $human = new Human();
            $validUnits = [$bot->getUnit(), $human->getUnit(), ''];
            $violations = [];
            foreach ($content as $row) {
                foreach ($row as $cell) {
                    $violations[] = (in_array($cell, $validUnits)) ?? false;
                }
            }
            if (in_array(false, $violations)) {
                throw new BadRequestException('Table values does not meet requirements');
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
