<?php

namespace app\controllers;

class MenuController extends AbstractController
{
    public function index(): string
    {
        if($this->request->page == 'monitor')
            $is_monitor = 1;
        return $this->response->json([
           ['name' => 'Картриджи', 'is_active' => $is_cart, 'count' => 0],
           ['name' => 'Заявки', 'is_active' => $is_orders, 'count' => 0],
           ['name' => 'Касса', 'is_active' => $is_monitor, 'count' => 0],
           ['name' => 'Счета', 'is_active' => $is_scheta, 'count' => 0]
        ]);
    }
}