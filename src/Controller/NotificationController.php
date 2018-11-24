<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Form\Notification\NotificationAssociationType;
use App\Form\Notification\NotificationType;
use App\Form\Notification\NotificationEditType;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/notification")
 */
class NotificationController extends Controller
{
    /**
     * @Route("/", name="back_notification_index", methods="GET")
     */
    public function index(NotificationRepository $notificationRepository): Response
    {
        return $this->render('back/notification/index.html.twig', ['notifications' => $notificationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back_notification_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $notification = new Notification();

        $notificationTypes = $this->getParameter('notificationType');

        $form = $this->createForm(NotificationType::class, $notification, ['notificationType'=> $notificationTypes]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_notification_index');
        }

        return $this->render('back/notification/new.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_notification_show", methods="GET")
     */
    public function show(Notification $notification): Response
    {
        return $this->render('back/notification/show.html.twig', ['notification' => $notification]);
    }

    /**
     * @Route("/{id}/edit", name="back_notification_edit", methods="GET|POST")
     */
    public function edit(Request $request, Notification $notification): Response
    {
        $notificationTypes = $this->getParameter('notificationType');
        $form = $this->createForm(NotificationEditType::class, $notification, [
            'notificationType' => $notificationTypes,
            'patterns' => $notification->getPattern()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Entregistrement efféctué avec succès!'
            );
            return $this->redirectToRoute('back_notification_edit', ['id' => $notification->getId()]);
        }

        return $this->render('back/notification/edit.html.twig', [
            'notification' => $notification,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back_notification_delete", methods="DELETE")
     */
    public function delete(Request $request, Notification $notification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notification->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($notification);
            $em->flush();
            $this->addFlash(
                'success',
                'Suppression efféctué avec succès!'
            );
        }

        return $this->redirectToRoute('back_notification_index');
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function association($id, Request $request)
    {
        $translator = $this->get('translator');

        $notification = $this->getDoctrine()->getRepository('App:Notification')->find($id);
        if (!is_object($notification)) {
            throw new NotFoundHttpException($translator->trans('notification.message.exception.not_found_object'));
        }

        $form = $this->createForm(NotificationAssociationType::class, $notification, array(
            'notificationType' => $this->getParameter('notificationType'),
            'patterns' => $this->getDoctrine()->getRepository('ApplicationNotificationBundle:Pattern')->findAll()
        ));
        $form->handleRequest($request);
        if ($form->isValid()) {

            $this->get('application_notification_service')->addNotification($notification);

            $this->addFlash('success', $translator
                ->trans('notification.message.flash.success.association', array('%notification%' => $notification), 'AppNotification'));
            return $this->redirectToRoute('application_notification_list');
        }

        return $this->render('back/notification/association.html.twig', array('form' => $form->createView(),
            'object' => $notification));
    }




    //////
    /**
     * Function filter
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function filterAction(Request $request)
    {
        if ($request->get('reset')) {
            $this->setFilters(array());
            return $this->redirect($this->generateUrl("application_notification_list"));
        }
        if ($request->getMethod() == "POST") {


            $form = $this->getFilterForm();
            $form->handleRequest($request);
            if ($form->isValid()) {
                $filters = $form->getViewData();
            }
        }
        if ($request->getMethod() == "GET") {
            $filters = $request->query->all();
        }
        if (isset($filters)) {
            $this->setFilters($filters);
        }
        return $this->redirect($this->generateUrl("application_notification_list"));
    }

    /**
     * Store in the session service the current filters
     *
     * @param array the filters
     */
    protected function setFilters($filters)
    {
        $this->get('session')->set('application_notification_filter', $filters);
    }

    /**
     * This function create form type
     * @return \Symfony\Component\Form\Form
     */
    public function getFilterForm()
    {
        $filters = $this->getFilters();

        return $this->createForm(FilterType::class, $filters,
            array(
                'notificationType' => $this->getParameter('notificationType')
            )
        );
    }

    /**
     * This function  get session filter
     * @return mixed
     */
    protected function getFilters()
    {
        return $this->get('session')->get('application_notification_filter', array());
    }

    /*
     * End Filters
     */

    /**
     * This function create query and pager
     * @param Request $request
     * @return mixed
     */
    protected function getPager(Request $request)
    {
        $filterParameters = $this->getFilters();

        if ($request->query->get('sort')) {
            $this->setSort($request->query->get('sort'), $request->query->get('order_by', 'ASC'));
        }
        $notifications = $this->get('application_notification_service')->getNotifications($filterParameters);
        $this->total_entities = $notifications['total_result'];
        $paginatedNotifications = $this->get('knp_paginator')->paginate($notifications['result'], $request->query->get('page', 1), $this->pageLimit);
        return $paginatedNotifications;
    }

    /**
     * Store in the session service the current sort
     *
     * @param string $column The column
     * @param string $order_by The order sorting (ASC,DESC)
     */
    protected function setSort($column, $order_by)
    {
        $this->get('session')->set('application_notification_sort', $column);
        $this->get('session')->set('application_notification_sort_orderBy', strtoupper($order_by));
    }
}
