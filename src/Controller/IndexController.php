<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Form\DonationForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $donation = new Donation();

        $form = $this->createForm(DonationForm::class, $donation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute('payment');
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/payment", name="payment")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function payment(Request $request)
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            return $this->render('ty.html.twig');
        }

        return $this->render('payment.html.twig');
    }

    /**
     * @Route("/dashboard", name="dashboard")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboard()
    {
        return $this->render('dashboard.html.twig');
    }
}