<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../../../class/tcpdf/tcpdf.php');
include_once("../../../class/PHPJasperXML.inc.php");
include_once ('../../../setting.php');





$namabarang = $_GET['namabarang'];

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("NamaBarang"=>"'".$namabarang."'");
$PHPJasperXML->load_xml_file("StockRajal.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>