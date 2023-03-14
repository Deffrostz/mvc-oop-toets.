<?php

class Zangeres extends BaseController
{
    private $zangeresModel;

    public function __construct()
    {
        $this->zangeresModel = $this->model('ZangeresModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Top 5 rijkste zangeressen ter wereld'
        ];

        $this->view('zangeres/index', $data);
    }


    public function getZangeressen() 
    {
        $zangeressen = $this->zangeresModel->getZangeressen();

        // Sorteer de zangeressen op nettowaarde, aflopend
        usort($zangeressen, function ($a, $b) {
            return $b->NettoWaarde - $a->NettoWaarde;
        });

        $tableRows = "";
        foreach ($zangeressen as $value) {
            $tableRows .= "<tr>
            <td>$value->Id</td>
            <td>$value->Naam</td>
            <td>$value->NettoWaarde</td>
            <td>$value->Land</td>
            <td>$value->Mobiel</td>
            <td>$value->Leeftijd</td>
            
        </tr>";
        }

        $data = [
            'title' => 'Top 5 rijkste zangeressen ter wereld',
            'tableRows' => $tableRows
        ];

        $this->view('zangeres/getZangeressen', $data);
    }
}