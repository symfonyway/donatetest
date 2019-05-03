<?php

namespace App\Controller;

use App\Entity\Donation;
use App\Form\DonationForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DonateController
 * @package App\Controller
 */
class DonateController extends AbstractController
{
    /**
     * @Route("/", name="donate_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function donate(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $donation = new Donation();

        $form = $this->createForm(DonationForm::class, $donation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $entityManager->persist($data);
            $entityManager->flush();

            return $this->redirectToRoute('donate_payment');
        }

        return $this->render('donation.html.twig', [
            'form' => $form->createView(),
            'title' => 'Donate',
        ]);
    }

    /**
     * @Route("/payment", name="donate_payment")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function payment(Request $request)
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            return $this->render('ty.html.twig', ['title' => 'Donate',]);
        }

        return $this->render('payment.html.twig', ['title' => 'Donate']);
    }
}