<?php

declare(strict_types=1);

final class WebRoutes
{
    /** 
     * @return array<string, array<string, string>>
     */
    public static function routes(): array
    {
        return array(
            'home' => array(
                'method' => 'GET',
                'action' => 'home',
            ),
            'users.create' => array(
                'method' => 'GET',
                'action' => 'create',
            ),
            'users.store' => array(
                'method' => 'POST',
                'action' => 'store',
            ),
            'users.index' => array(
                'method' => 'GET',
                'action' => 'index',
            ),
            'users.show' => array(
                'method' => 'GET',
                'action' => 'show',
            ),
            'users.edit' => array(
                'method' => 'GET',
                'action' => 'edit',
            ),
            'users.update' => array(
                'method' => 'POST',
                'action' => 'update',
            ),
            'users.delete' => array(
                'method' => 'POST',
                'action' => 'delete',
            ),
            'auth.login' => array(
                'method' => 'GET',
                'action' => 'login',
            ),
            'auth.authenticate' => array(
                'method' => 'POST',
                'action' => 'authenticate',
            ),
            'auth.logout' => array(
                'method' => 'GET',
                'action' => 'logout',
            ),
            'auth.forgot' => array(
                'method' => 'GET',
                'action' => 'forgot',
            ),
            'auth.forgot.send' => array(
                'method' => 'POST',
                'action' => 'forgot.send',
            ),
            'partidos.create' => array(
                'method' => 'GET',
                'action' => 'partidos.create',
            ),
            'partidos.store' => array(
                'method' => 'POST',
                'action' => 'partidos.store',
            ),
            'partidos.index' => array(
                'method' => 'GET',
                'action' => 'partidos.index',
            ),
            'partidos.show' => array(
                'method' => 'GET',
                'action' => 'partidos.show',
            ),
            'partidos.edit' => array(
                'method' => 'GET',
                'action' => 'partidos.edit',
            ),
            'partidos.update' => array(
                'method' => 'POST',
                'action' => 'partidos.update',
            ),
            'partidos.delete' => array(
                'method' => 'POST',
                'action' => 'partidos.delete',
            ),
        );
    }
}