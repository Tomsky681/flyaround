<?php

namespace WCSCoavBundle\Controller;

use WCSCoavBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/", name="review_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reviews = $em->getRepository('WCSCoavBundle:Review')->findAll();

        return $this->render('WCSCoavBundle:Review:index.html.twig', ['reviews' => $reviews]);
    }

    /**
     * Create a new review Entity
     *
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm('WCSCoavBundle\Form\ReviewType', $review);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('review_show', ['id' => $review->getId()]);
        }

        return $this->render('WCSCoavBundle:Review:new.html.twig', ['review' => $review, 'form' => $form->createView()]);
    }

    /**
     * @Route("/show/{id}", name="review_show")
     * @Method({"GET"})
     */
    public function showAction(Review $review)
    {
        return $this->render('WCSCoavBundle:Review:show.html.twig', ['review' => $review]);
    }

    /**
     * Displays a form to edit an existing review entity.
     *
     * @Route("/{id}/edit", name="review_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Review $review)
    {
        $form = $this->createForm('WCSCoavBundle\Form\ReviewType', $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('review_show', ['id' => $review->getId()]);
        }

        return $this->render('WCSCoavBundle:Review:edit.html.twig', ['review' => $review, 'form' => $form->createView()]);
    }

    /**
     * Delete an existing review entity
     *
     * @Route("/{id}/delete", name="review_delete")
     * @Method({"GET"})
     */
    public function deleteAction(Review $review)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($review);
        $em->flush();

        return $this->redirectToRoute('review_index');
    }

}
