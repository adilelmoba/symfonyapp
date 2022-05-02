<?php

namespace App\Controller;

use App\Form\StudentType;
use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StudentController extends AbstractController
{
  /**
   * @Route("/student", name="student")
   */
  public function index(StudentRepository $repository): Response
  {

    return $this->render('pages/student/index.html.twig', [
      'students' => $repository->findAll()
    ]);
  }

  /**
   * @Route("/student/nouveau", name="new", methods={"GET","POST"})
   */
  public function new(
    Request $request,
    EntityManagerInterface $manager
  ): Response {
    $student = new Student();
    $form = $this->createForm(StudentType::class, $student);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $student = $form->getData();

      $manager->persist($student);
      $manager->flush();

      $this->addFlash(
        'success',
        "L'étudiant a été créé avec succès!"
      );

      return $this->redirectToRoute('student');
    }

    return $this->render('pages/student/new.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/student/edition/{id}", name="edit", methods={"GET","POST"})
   */
  public function edit(Student $student, Request $request, EntityManagerInterface $manager): Response
  {
    $form = $this->createForm(StudentType::class, $student);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $student = $form->getData();

      $manager->persist($student);
      $manager->flush();

      $this->addFlash(
        'success',
        "L'étudiant a été modifié avec succès!"
      );

      return $this->redirectToRoute('student');
    }

    return $this->render('pages/student/edit.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/student/suppression/{id}", name="delete", methods={"GET"})
   */
  public function delete(EntityManagerInterface $manager, Student $student): Response
  {
    if (!$student) {
      $this->addFlash(
        'success',
        "L'étudiant en question n'a pas été trouvé !"
      );

      return $this->redirectToRoute('student');
    }

    $manager->remove($student);
    $manager->flush();

    $this->addFlash(
      'success',
      "L'étudiant a été supprimé avec succès!"
    );

    return $this->redirectToRoute('student');
  }
}
