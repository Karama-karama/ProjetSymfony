<?php

namespace App\Controller;

use App\Entity\Condidature;
use App\Form\CondidatureType;
use App\Repository\CondidatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/condidature")
 */
class CondidatureController extends AbstractController
{
    /**
     * @Route("/", name="condidature_index", methods={"GET"})
     */
    public function index(CondidatureRepository $condidatureRepository): Response
    {
        // Index recruteur
        $this->denyAccessUnlessGranted('ROLE_CONDIDAT', null, 'Unable to access this page!');
        { 
            return $this->render('condidature/index.html.twig', [
                'condidatures' => $condidatureRepository->findAll(),
            ]);
        }
        // Index Condidat
        $this->denyAccessUnlessGranted('ROLE_RECRUTEUR', null, 'Unable to access this page!');
        { 
            return $this->render('condidature/index.html.twig', [
            'condidatures' => $condidatureRepository->findAll(),
        ]);
        }
    }

    /**
     * @Route("/new", name="condidature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $condidature = new Condidature();
       // $user ->setIdUser(3);
        $form = $this->createForm(CondidatureType::class, $condidature);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($condidature);
            $entityManager->flush();
            
            return $this->redirectToRoute('condidature_index');
        }

        return $this->render('condidature/new.html.twig', [
            'condidature' => $condidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condidature_show", methods={"GET"})
     */
    public function show(Condidature $condidature): Response
    {
        return $this->render('condidature/show.html.twig', [
            'condidature' => $condidature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="condidature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Condidature $condidature): Response
    {
        $form = $this->createForm(CondidatureType::class, $condidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('condidature_index');
        }

        return $this->render('condidature/edit.html.twig', [
            'condidature' => $condidature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condidature_delete", methods={"POST"})
     */
    public function delete(Request $request, Condidature $condidature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condidature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('condidature_index');
    }
}
