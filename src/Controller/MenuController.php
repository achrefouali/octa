<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/menu")
 */
class MenuController extends Controller
{
    /**
     * @Route("/", name="back_menu_index", methods="GET")
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('back/menu/index.html.twig', ['menus' => $menuRepository->findAll(false)]);
    }

    /**
     * @Route("/new", name="back_menu_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_menu_index');
        }

        return $this->render('back/menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="back_menu_show", methods="GET")
     */
    public function show(Menu $menu): Response
    {
        return $this->render('back/menu/show.html.twig', ['menu' => $menu]);
    }

    /**
     * @Route("/{id}/edit", name="back_menu_edit", methods="GET|POST")
     */
    public function edit(Request $request, Menu $menu): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_menu_edit', ['id' => $menu->getId()]);
        }

        return $this->render('back/menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="back_menu_delete", methods="DELETE")
     */
    public function delete(Request $request, Menu $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_menu_index');
    }
}
