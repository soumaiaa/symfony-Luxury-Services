<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\Media;
use App\Entity\User;
use App\Form\CandidatsType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\CandidatsRepository;
use App\Service\FileUploader;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/candidats')]
class CandidatsController extends AbstractController
{
    #[Route('/{id}/edit', name: 'app_candidats_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        FileUploader $fileUploader,
        EntityManagerInterface $entityManager,
        User $user,
        CandidatsRepository $candidatsRepository
    ): Response {
        $candidat = $candidatsRepository->findOneBy(['user' => $user]);

        if (!$candidat) {
            // return $this->redirectToRoute('app_candidats_edit', ["id" => $user->getId()]);
            $candidat = new Candidats();
            $candidat->setUser($user);
            $entityManager->persist($candidat);
        }


        // $media = new Media();
        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);

        // Créer le formulaire de modification d'utilisateur
        $userEditForm = $this->createForm(UserType::class, $user);
        $userEditForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez la date de naissance depuis le formulaire
            $birthdateString = $form->get('birthdate')->getData();
        
            // Set birthdate for candidat
            $candidat->setBirthdate($birthdateString);

            $this->createMedia($form, 'photo', $fileUploader, $candidat);
            $this->createMedia($form, 'cv', $fileUploader, $candidat);
            $this->createMedia($form, 'passeport', $fileUploader, $candidat);

            // $userForm = $form->get('user')->getData();
            // On vérifie les champs pour modifier le percentCompleted
            $candidat->setPourcentage($candidat->checkPercentCompleted());
            // dd($candidat);
            // if ($userForm->getEmail() === $user->getEmail()) {
            //     
            // }

            $entityManager->flush();
            $this->addFlash('success', 'Profile updated successfully.');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
            'user' => $user,
            'userEditForm' => $userEditForm->createView(),
        ]);
    }

    private function createMedia($form, string $formInput, FileUploader $fileUploader, Candidats $candidat)
    {
        $mediaFile = $form->get($formInput)->getData();
        if ($mediaFile) {
            $media = new Media();
            $mediaFileName = $fileUploader->upload($mediaFile);
            $media->setUrl($mediaFileName);
            $method = "set" . ucfirst($formInput);
            $candidat->$method($media);
        }
    }

    #[Route('/{id}', name: 'app_candidats_delete', methods: ['POST'])]
    public function delete(Request $request, Candidats $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $candidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    }
}
