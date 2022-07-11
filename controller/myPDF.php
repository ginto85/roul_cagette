<?php 

namespace App\controller;

use FPDF;

class myPDF extends FPDF
{
    // Header du pdf
    function header(){

        $this->SetFont('Times','',12);

        $this->SetFillColor(150,245,84);
        $this->Rect(10, 10, 80, 75,'F');
        // logo
        $this->Image('assets/img/logo.png',25,10,50);
        // info marchand
        $this->cell(80,90,"Roul'Cagette",0,0,'C');
        $this->Ln(5);
        $this->cell(80,90 ,"La grande chevasse",0,0,'C');
        $this->Ln(5);
        $this->cell(80,90 ,"85260 Saint-Sulpice-le-Verdon",0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',9);
        $this->cell(80,90,"Tel : 00 00 00 00 00",0,0,'C');
        $this->Ln(5);
        $this->cell(80,90,"Mail : roul-Cagette@gmail.com ",0,0,'C');
        $this->Ln(5);
    }
    // Footer du pdf
    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Header de la table
    function headerTable()
    {  
        $this->SetY(+110);
        $this->SetX(+40);
        $this->SetFont('Times', 'B',12);

        $this->SetFillColor(173,245,123);
        $this->Rect(40, 110, 125, 10,'F');

        $this->Cell(10,10,'ID',1,0,'C');
        $this->Cell(40,10,'Produits',1,0,'C');
        $this->Cell(25,10,'Quantite' ,1,0,'C');
        $this->Cell(30,10,'Prix unit.',1,0,'C');
        $this->Cell(20,10,'Total',1,0,'C');
       
        $this->Ln();
    }

    // Body de la table
    function viewTable(array $orderDetail)
    {
        $this->SetFont('Times', '',10);
        $this->SetY(120);

        $tableTotal = 0;
        $lgnTotal = 0;
        $numFact = 0;
        $tva = 0;
        foreach($orderDetail as $data)
        {
            // Total ligne
            $lgnTotal = $data['quantity'] * $data['price'];
            $lgnTotal = number_format($lgnTotal, 2);
            
            // Total tableau
            $tableTotal += $lgnTotal;
            $tableTotal = number_format($tableTotal,2);
          
            // Données facture
            $numFact = $data['id'];
            $dateFact = $data['order_date'];

            // Affichage tableau
            $this->SetX(+40);
    
            $this->Cell(10,10,$data['product_id'],1,0,'C');
            $this->Cell(40,10,$data['name'],1,0,'L');
            $this->Cell(25,10,$data['quantity'],1,0,'C');
            $this->Cell(30,10,$data['price'],1,0,'C');
            $this->Cell(20,10,$lgnTotal,1,0,'C');
            $this->Ln();
        }  
        $tva = $tableTotal * 0.055;
        $tva = number_format($tva,2);

        // case TVA
        $this->SetX(115);
        $this->cell(30,10,'Dont TVA',1,0,'C');
        $this->Cell(20,10,$tva,1,0,'C');
        $this->Ln();
        // case Total
        $this->SetFillColor(173,245,123);
        $this->Rect(115, $this->getY(), 30, 10,'F');
        $this->SetX(115);
        $this->Cell(30,10,'Total',1,0,'C');
        $this->Cell(20,10,$tableTotal,1,0,'C');
        $this->Ln(10);
        
        // Affichage img farm product
        $this->Image('assets/img/farm-product.jpg',80,$this->getY()+10,50);

        // Affichage num. command.
        $this->SetY(10);
        $this->SetFont('arial', 'B',14);

        $this->Cell(250,10,'Facture N.'.$numFact, 0, 0, 'C');
        $this->Ln(10);
        
        $this->Cell(250,10,'Du '. $dateFact, 0, 0,'C');
        $this->Ln(10);

        // info destinataire
        $this->SetY(40);
        $this->SetX(105);
        $this->SetFont('Times','',14);

        $this->cell(40,10,"Destinataire",0,0,'C');
        $this->Ln();

        $this->SetX(105);
        $this->SetFont('Times','',11);
        $this->SetFillColor(150,245,84);
        $this->Rect(105, 50, 28, 8,'F');
        $this->cell(40,10,"identifiant client : ". $data['login'],0,0,'C');
        $this->Ln();

        $this->SetX(105);
        $this->SetFillColor(150,245,84);
        $this->Rect(105, 60, 22, 8,'F');
        $this->cell(42,10,"Email client : ". $data['email'],0,0,'C');
        $this->Ln(); 
    }
}