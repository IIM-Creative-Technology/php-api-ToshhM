<?php

namespace App\Controller;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Excecption\NotFoundHttpException;


/**
 * @Route("/api")
 */

class EtudiantController extends AbstractController
{
/**
 * @var $etudiantRepository
 */
private $etudiantRepository;

    public function __construct(EtudiantRepository $etudiantRepository)
    {
      $this-> etudiantRepository = $etudiantRepository;
    }


    /**
     * @Route("/etudiant", name="apiGetEtudiant", methods={"GET"})
     * 
     * @return Response
     */
    #[Route('/etudiant', name: 'etudiant')]

    public function getEtudiants(): Response
    {
  
        $etudiants = $this->etudiantRepository->findAll();
        return $this->json($etudiants);
    }

      /**
     * @Route("/classe/{id}", name="apiGetEtudiant")
     * @param $etudiant
     * @return Response
     */

    public function getEtudiant($etudiantId ): Response
    {
      $etudiants = $this->EtudiantRepository->find($etudiantId);
      if (!$etudiant instanceof Etudiant){
          throw new NotfoundHttpException();
      }
      return $this->json($etudiants);
    }

      /**
     * @Route("/classe/{id}", name="apideleteEtudiant", methods={"DELETE"})
     * @param $etudiantId
     * @param ObjectManager $manager
     
     * 
     * @return Response
     */

    public function deleteEtudiant($etudiantId, ObjectManager $manager): Response
    {
      $etudiants = $this->EtudiantRepository->findAll();
      if (!$etudiant instanceof Etudiant){
          throw new NotfoundHttpException();
      }

      $manager->remove($etudiant);
      $manager->flush();
      return $this->json($etudiants);
    }
      /**
     * @Route("/classe/", name="apiaddEtudiant", methods = {"POST"})
     
     * @param ObjectManager $manager
     
     * 
     * @return Response
     */

    public function addEtudiant(Request $request): Response
    {
      
    $etudiant = new Etudiant;
    $form = $this ->createForm(EtudiantType::class, $etudiant);
    $form->submit($request->request->all());
    $this->objectManager->persist($task);
    $this->objectManager->flush();

   
      return $this->json($etudiant);
    }
}


