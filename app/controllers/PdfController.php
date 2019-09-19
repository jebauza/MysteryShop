<?php

class PdfController extends BaseController {

    public function pdf()
    {
        require(app_path() . "/lib/PDFmyurl/pdfmyurl.php");
        try {
            // first fill in the license that you received upon sign-up
            $pdf = new PDFmyURL ('your license here');

            // now set the options, so for example when we want to have a page in A4 in orientation portrait
            $pdf->SetPageSize('A4');
            $pdf->SetPageOrientation('Portrait');

            // then do the conversion - this is how you convert Google to PDF and display the PDF to the user
            $pdf->CreateFromURL ('www.google.com');
            $pdf->Display();

        }  catch (Exception $error) {
            echo $error->getMessage();
            echo $error->getCode();
        }// Display the PDF for download to the user
    }

    public function pago()
    {
        //product_quantity es la cantidad del producto.

        $cart = array(
            array("product_name"=>"Producto 1","product_quantity"=>"2","product_price"=>"0.30"),
            array("product_name"=>"Producto 1","product_quantity"=>"1","product_price"=>"0.70"),
        );
        

        $paypal_business = "softelebyte@gmail.com";
        $paypal_currency = "USD";
        $paypal_cursymbol = "&usd";
        $paypal_location = "US";
        $paypal_returnurl = "http://localhost/mysteryshop/public/pago_respuesta";
        $paypal_returntxt = "Pago Realizado Exitosamente!";
        $paypal_cancelurl = "http://localhost/mysteryshop/public/pago_cancel";

        $ppurl = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart";
        $ppurl .= "&business=".$paypal_business;
        $ppurl .= "&no_note=1";
        $ppurl .= "&currency_code=".$paypal_currency;
        $ppurl .= "&charset=utf-8&rm=1&upload=1";
        $ppurl .= "&business=".$paypal_business;
        $ppurl .= "&return=".urlencode($paypal_returnurl);
        $ppurl .= "&cancel_return=".urlencode($paypal_cancelurl);
        $ppurl .= "&page_style=&paymentaction=sale&bn=katanapro_cart&invoice=KP-0";
        $i=1;
        foreach ($cart as $c) {
            $q = $c["product_quantity"];
            $ppurl.="&item_name_$i=".urlencode($c["product_name"])."&quantity_$i=$q&amount_$i=".$c["product_price"]."&item_number_$i=";
            $i++;

        }
        $ppurl.= "&tax_cart=0.00";
        header("Location: $ppurl");
        echo "aqui estoy";die;
    }

    public function pago_respuesta()
    {
       echo "Pago exitoso";die;
    }

    public function pago_cancel()
    {
        echo "Cancelacion de pago";die;
    }
















}
