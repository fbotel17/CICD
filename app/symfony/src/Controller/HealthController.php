<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthController
{
    #[Route('/health', name: 'health', methods: ['GET'])]
    public function __invoke(Connection $connection): JsonResponse
    {
        try {
            $connection->executeQuery('SELECT 1');
            return new JsonResponse(['status' => 'ok', 'db' => 'up']);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'db_down', 'error' => $e->getMessage()], 500);
        }
    }
}
