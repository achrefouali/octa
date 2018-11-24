<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportService{

    public function dump($header=array(), $fields=array(), $filename='export', $separator = ';')
    {
        $response = new StreamedResponse();
        $response->setCallback(function () use ($separator, $header, $fields)
        {
            $handle = fopen('php://output', 'w+');
            //Header
            fputcsv(
                $handle,
                array_map("utf8_decode",$header),
                $separator
            );
            //Fields
            foreach ($fields as $field) {
                fputcsv(
                    $handle,
                    array_map("utf8_decode", $field),
                    $separator
                );
            }
            fclose($handle);
        });
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$filename.'.csv"');
        return $response;
    }

}