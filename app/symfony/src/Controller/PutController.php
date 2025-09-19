<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;


class PutController
{
    #[Route('/api/users/{uuid}', name: 'update_user', methods: ['PUT'])]
    public function update(
        string $uuid,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        $user = $em->getRepository(User::class)->findOneBy(['uuid' => $uuid]);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }

        if (isset($data['fullname'])) {
            $user->setFullname($data['fullname']);
        }
        if (isset($data['studyLevel'])) {
            $user->setStudyLevel($data['studyLevel']);
        }
        if (isset($data['age'])) {
            $user->setAge($data['age']);
        }

        $em->persist($user);
        $em->flush();

        return new JsonResponse([
            'uuid' => $user->getUuid(),
            'fullname' => $user->getFullname(),
            'studyLevel' => $user->getStudyLevel(),
            'age' => $user->getAge(),
        ]);
    }
}
