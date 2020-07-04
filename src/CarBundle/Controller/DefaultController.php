<?php

namespace CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use CarBundle\Entity\Car;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class DefaultController extends Controller
{
    /**
     * @Route("/cars", name="cars")
     */
    public function indexAction(Request $request)
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);

        $cars = $carRepository->findCarsWithDetails();

        $form = $this->createFormBuilder()
                    ->setMethod('GET')
                    ->add('search', TextType::class, [
                        'constraints' => [
                            new NotBlank(),
                            new Length(['min' => 2])
                        ]
                    ])
                    ->getForm();  
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            die('');
        }

        return $this->render('CarBundle:Default:index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @Route("/cars/{id}", name="show_car")
     */
    public function showAction($id)
    {
        $carRepository = $this->getDoctrine()->getRepository(Car::class);

        $car = $carRepository->findCarWithDetails($id);

        return $this->render('CarBundle:Default:show.html.twig', ['car' => $car]);
    }
}
