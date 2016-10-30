<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Loan;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class LoansController extends FOSRestController
{
    /**
     * @ApiDoc(
     *     section = "Loans",
     *     description = "Returns a collection of Loans",
     *     statusCodes = {
     *         200="Returned when successful"
     *     }
     * )
     *
     * @return Loan[]|array
     */
    public function getLoansAction(){
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $em = $this->getDoctrine()->getManager();

        return $em->getRepository('AppBundle:Loan')->findAll();
    }

    /**
     * @ApiDoc(
     *     section = "Loans",
     *     description = "Returns a Loan",
     *     resource = true,
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         403 = "Returned when the user is not authorized",
     *         404 = "Returned when the loan is not found"
     *     }
     * )
     *
     * @param integer $id
     *
     * @return Loan|array
     */
    public function getLoanAction($id){
        $em = $this->getDoctrine()->getManager();
        $resource = $em->getRepository('AppBundle:Loan')->find($id);

        if (null === $resource) {
            throw new NotFoundHttpException("Resource not found");
        }

        return $resource;
    }

    /**
     * @ApiDoc(
     *     section = "Loans",
     *     description = "Create a new Loan",
     *     resource = true,
     *     input = "AppBundle\Form\LoanType",
     *     output = "AppBundle\Entity\Loan",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         403 = "Returned when the user is not authorized",
     *         404 = "Returned when the loan is not found"
     *     }
     * )
     *
     * @param Request $request
     *
     * @return Loan|Form
     */
    public function postLoansAction(Request $request){
        $loan = new Loan();
        $form = $this->createForm('AppBundle\Form\LoanType', $loan);

        $form->handleRequest($request);

//        echo "<pre>".print_r("sub:" . var_dump($form->isSubmitted()) . " valid: " . var_dump($form->isValid()),true)."<pre>";die;
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush();

            return $loan;
        }

        return $form;
    }

    /**
     * @ApiDoc(
     *     section = "Loans",
     *     description = "Create a new Loan",
     *     resource = true,
     *     input = "AppBundle\Form\LoanType",
     *     output = "AppBundle\Entity\Loan",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         403 = "Returned when the user is not authorized",
     *         404 = "Returned when the loan is not found"
     *     }
     * )
     *
     * @param Request $request
     * @param integer $id
     *
     * @return Loan|Form
     */
    public function patchLoansAction(Request $request, $id){
        $loan = $this->getLoanAction($id);
        $form = $this->createForm('AppBundle\Form\LoanType', $loan,array('method' => $request->getMethod()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loan);
            $em->flush();

            return $loan;
        }

        return $form;
    }

    /**
     * @ApiDoc(
     *     section = "Loans",
     *     description = "Delete a Loan",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         403 = "Returned when the user is not authorized",
     *         404 = "Returned when the loan is not found"
     *     }
     * )
     *
     * @param integer $id
     *
     * @return Loan
     */
    public function deleteLoanAction($id){
        $loan = $this->getLoanAction($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($loan);
        $em->flush();

        return $loan;
    }
}
