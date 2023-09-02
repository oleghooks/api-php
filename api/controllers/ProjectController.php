<?php

namespace app\controllers;

class ProjectController extends AbstractController
{
    public function index():string
    {
        $barcode = '4606782024836';
        $info = $this->db->query("SELECT price,title,barcode FROM products WHERE barcode = ? LIMIT 0,1", [$barcode]);
        return $this->response->json([
            [
                'name' => $info[0]['title']
            ],
            [
                'name' => 'project 2'
            ]
        ]);
    }
    /**
     * post /api/v1/project/create
     * body:
       {
            "project": {
                "prop": "value"
             }
        }
     */
    public function create(): string
    {
        return $this->response->json([
            [
                'response' => 'OK',
                'request' => $this->request->project,
            ]
        ]);
    }
    /**
     * post /api/v1/project/update/3
     * body:
        {
            "project": {
                "prop": "value"
            }
        }
     */
    public function update(int $id): string
    {
        return $this->response->json([
            [
                'response' => 'OK',
                'request' => $this->request->project,
                'id' => $id
            ]
        ]);
    }
}