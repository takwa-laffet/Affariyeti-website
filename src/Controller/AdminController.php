<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/chartsadmin', name: 'chartsadmin')]
    public function charts() : Response
    {
        return $this->render('admin/charts/chartjs.html.twig');
    }
    #[Route('/doc', name: 'doc')]
    public function doc() : Response
    {
        return $this->render('admin/documentation/documentation.html.twig');
    }
    #[Route('/form', name: 'form')]
    public function form() : Response
    {
        return $this->render('admin/forms/basic_elements.html.twig');
    }
    #[Route('/icon', name: 'icon')]
    public function icon() : Response
    {
        return $this->render('admin/icons/mdi.html.twig');
    }
    #[Route('/eror404', name: 'eror404')]
    public function eror404() : Response
    {
        return $this->render('admin/samples/error-404.html.twig');
    }
    #[Route('/error-500', name: 'error500')]
    public function error500() : Response
    {
        return $this->render('admin/samples/error-500.html.twig');
    }
    #[Route('/tables', name: 'tables')]
    public function tables() : Response
    {
        return $this->render('admin/tables/basic_elements.html.twig');
    }
    #[Route('/button', name: 'button')]
    public function button() : Response
    {
        return $this->render('admin/ui-features/buttons.html.twig');
    }
    #[Route('/dropdowns', name: 'dropdowns')]
    public function dropdowns() : Response
    {
        return $this->render('admin/ui-features/dropdowns.html.twig');
    }
    #[Route('/typography', name: 'typography')]
    public function typography() : Response
    {
        return $this->render('admin/ui-features/typography.html.twig');
    }
}
