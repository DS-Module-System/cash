<?php

namespace App\Controller\Cash;

use App\Controller\Core\CoreBaseController;
use App\Entity\Cash\CashTransaction;
use App\Form\Cash\CashTransactionForm;
use App\Form\Cash\CashTransactionSearchForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/cash', name: 'cash_')]
class CashTransactionController extends CoreBaseController
{

    protected string $entityClass = CashTransaction::class;
    protected string $formClass = CashTransactionForm::class;
    protected string $searchFormClass = CashTransactionSearchForm::class;
    protected string $moduleTemplateName = 'cash';

    #[Route(path: '', name: 'list')]
    #[IsGranted('ROLE_CASH_VIEW')]
    public function list(Request $request): Response
    {
        return $this->baseList($request, $request->query->getInt('page', 1));
    }

    #[Route(path: '/create', name: 'create')]
    #[IsGranted('ROLE_CASH_CREATE')]
    public function create(Request $request): Response
    {
        // Callback за автоматично задаване на създателя
        $this->callbacks['preCreatePersist'] = function ($entity) {
            $entity->setCreatedBy($this->getUser());
            return $entity;
        };

        return $this->baseCreate($request);
    }

    #[Route(path: '/{id}/edit', name: 'edit')]
    #[IsGranted('ROLE_CASH_EDIT')]
    public function edit($id, Request $request): Response
    {
        return $this->baseEdit($request, $id);
    }

    #[Route(path: '/deletes', name: 'deletes')]
    #[IsGranted('ROLE_CASH_DELETE')]
    public function deletes(Request $request): Response
    {
        return $this->baseDeletes($request);
    }
}
