<?php

namespace App\Controller;

use App\Entity\InvoiceRow;
use App\Form\InvoiceRowType;
use App\Repository\InvoiceRowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/invoice/row')]
class InvoiceRowController extends AbstractController
{
    #[Route('/', name: 'app_invoice_row_index', methods: ['GET'])]
    public function index(InvoiceRowRepository $invoiceRowRepository): Response
    {
        return $this->render('invoice_row/index.html.twig', [
            'invoice_rows' => $invoiceRowRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_invoice_row_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InvoiceRowRepository $invoiceRowRepository): Response
    {
        $invoiceRow = new InvoiceRow();
        $form = $this->createForm(InvoiceRowType::class, $invoiceRow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoiceRowRepository->save($invoiceRow, true);

            return $this->redirectToRoute('app_invoice_row_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('invoice_row/new.html.twig', [
            'invoice_row' => $invoiceRow,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_row_show', methods: ['GET'])]
    public function show(InvoiceRow $invoiceRow): Response
    {
        return $this->render('invoice_row/show.html.twig', [
            'invoice_row' => $invoiceRow,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_invoice_row_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InvoiceRow $invoiceRow, InvoiceRowRepository $invoiceRowRepository): Response
    {
        $form = $this->createForm(InvoiceRowType::class, $invoiceRow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invoiceRowRepository->save($invoiceRow, true);

            return $this->redirectToRoute('app_invoice_row_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('invoice_row/edit.html.twig', [
            'invoice_row' => $invoiceRow,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_invoice_row_delete', methods: ['POST'])]
    public function delete(Request $request, InvoiceRow $invoiceRow, InvoiceRowRepository $invoiceRowRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invoiceRow->getId(), $request->request->get('_token'))) {
            $invoiceRowRepository->remove($invoiceRow, true);
        }

        return $this->redirectToRoute('app_invoice_row_index', [], Response::HTTP_SEE_OTHER);
    }
}
