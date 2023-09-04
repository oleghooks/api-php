<?php

namespace app\controllers;

class MonitorController extends AbstractController
{
    public function infoBarcode(int $barcode):string
    {
        $info = $this->db->query("SELECT price,title,barcode FROM products WHERE barcode = ? LIMIT 0,1", [$barcode]);
        if($info)
            return $this->response->json([

                    'response' => 'OK',
                    'body' => [
                        'title' => $info[0]['title'],
                        'price' => $info[0]['price'],
                        'barcode' => $barcode
                    ]


            ]);
        else
            return $this->response->json([ 'response' => 'fail' ]);
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

    public function insertBarcode(): string
    {
        // echo $this->request->title;
       $insert = $this->db->insert('products', [
            'title' => $this->request->title,
            'art' => "not",
            'barcode' => $this->request->barcode,
            'manuf' => "not",
            'code' => "not",
            'count' => 0,
            'price' => 0,
            'price_manuf' => "not",
            'date_added' => time(),
            'provider' => "not"
        ]);
           return $this->response->json([
               [
                   'response' => $insert
               ]
           ]);


    }

    public function updatePriceBarcode(): string{

        $update = $this->db->update('products', ['price' => $this->request->price], ['barcode' => $this->request->barcode]);

        return $this->response->json([
            [
                'response' => $update
            ]
        ]);
    }
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
