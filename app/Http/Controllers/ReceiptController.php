<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Mail;
use Storage;
use Illuminate\Http\Client\Pool;

class ReceiptController extends Controller
{

    public static function uploadReceipt($count)
    {
        $cart = Donation::orderBy('id', 'DESC')->paginate($count);
        $subtotal = 0;
        $payment_method = $cart[0]->payment_method;
        foreach ($cart as $key => $c) {
            $subtotal = $subtotal + $c->amount + $c->admincost;
        }
        $html = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Thank You</title>
    </head>
    <style>
        .maintable {
            width: 100%;
            max-width: 600px;
        }
    </style>
    <body style="font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;">
        <center style="width: 100%; table-layout: fixed; padding-top: 30px; padding-bottom: 60px;">
            <h1 style="text-align: center;">
                <img width="200px" src="https://grtuk.org/wp-content/uploads/2019/08/logo.png" src="logo" />
            </h1>
            <p
                class="maintitle"
                style="
                    width: 100%;
                    max-width: 600px;
                    font-size: 1.6rem;

                    padding: 20px 0px;
                    margin: 0;
                    font-weight: 100;
                "
            >
                New Donation: #38691
            </p>
            <table style="width: 100%; max-width: 600px;">
                <tr style="width: 100%; max-width: 600px;">
                    <td>
                        <table class="maintable" style="padding-top: 40px; width: 100%; max-width: 600px;">
                            <tr>
                                <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                    <p class="mainpara" style="padding: 0; margin: 0;">
                                        You\'ve recieved the following order from Rihah Begum:
                                    </p>
                                    <br />
                                    <h3 style="font-weight: 500; color: #4691aa;">
                                        [Donation #38691](' . date('d/m/Y') . ')
                                    </h3>
                                    <br />
                                </td>
                            </tr>
                            <table class="maintable border" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr class="mainrow">
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;" width="45%">
                                        Donation Items
                                    </th>
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;" width="30%">
                                        Quantity
                                    </th>
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;">
                                        Price
                                    </th>
                                </tr>
                                ';
        foreach ($cart as $c) {
            $html = $html . '
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            ' . $c->title . '
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            ' . $c->qty . '
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            £ ' . $c->amount . '
                                        </p>
                                    </td>
                                </tr>
                                ';
        }
        $html = $html . '
                            </table>
                            <table class="maintable border totaltable" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Subtotal:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            £ ' . $subtotal . '.00
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Payment method:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            ' . $payment_method . '
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Total:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            £ ' . $subtotal . '.00
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding-top: 40px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        <h3 style="font-weight: 500; color: #4691aa; margin-block: -10px;">
                                            Checkout Fields
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 35px;">
                                        <ul>
                                            <li class="listfields">
                                                <strong style="font-weight: 500;">TITLE:</strong>
                                                Miss
                                            </li>
                                            <li class="listfields">
                                                <strong style="font-weight: 500;">RECLAIM GIFT AID:</strong>
                                                I am not sure, please don\'t claim Gift Aid at the moment
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding: 0px 0px 20px 0px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        <h3 style="font-weight: 500; color: #4691aa; margin-block: -10px;">
                                            Billing address
                                        </h3>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable border" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p><i>' . $cart[0]->name . ' ' . $cart[0]->lastname . '</i></p>
                                        <p><i>' . $cart[0]->address . '</i></p>
                                        <p><i>' . $cart[0]->postcode . '</i></p>
                                        <p><i>' . $cart[0]->city . '</i></p>
                                        <p><i>' . $cart[0]->contact . '</i></p>
                                        <p><i>' . $cart[0]->county . '</i></p>
                                        <p>
                                            <a href="#"><i>' . $cart[0]->email . '</i></a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding-bottom: 50px; padding-top: 40px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        Congratulations on the Donation.
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </td>
                </tr>
            </table>
            <p class="copyright" style="width: 100%; max-width: 600px; font-size: 0.9rem; color: rgb(104, 104, 104);">
                Copyright @ 2020 GRTUK, All Right Reserved. We do not deal with interest money. Charity Number : 11114135
            </p>
        </center>
    </body>
</html>

        ';
        // Setup a filename
        $documentFileName = "receipt-admin.pdf";

        // Create the mPDF document
        $document = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'private',
            'Pragma' => 'private'
        ];

        // Write some simple Content
        $document->WriteHTML($html);

        // Save PDF on your public storage
        Storage::disk('local')->put($documentFileName, $document->Output($documentFileName, "S"));


        // --------------------------------------Code for user receipt ----------------------------




        $html = '';
        $html = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Thank You</title>
    </head>
    <style>
        .maintable {
            width: 100%;
            max-width: 600px;
        }
    </style>
    <body style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">
        <center style="width: 100%; table-layout: fixed; padding-top: 1px; padding-bottom: 16px;">
            <h1 style="text-align: center;">
                <img width="200px" src="https://grtuk.org/wp-content/uploads/2019/08/logo.png" src="logo" />
            </h1>
            <p class="maintitle" style="width: 100%; max-width: 600px; font-size: 1.6rem; padding: 20px 0px; margin: 0; font-weight: 100;">
                Thank you for your donation
            </p>
            <table style="width: 100%; max-width: 600px;">
                <tr style="width: 100%; max-width: 600px;">
                    <td>
                        <table class="maintable" style="padding-top: 40px; width: 100%; max-width: 600px;">
                            <tr>
                                <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                    <p class="mainpara" style="padding: 0; margin: 0;">
                                        Hi ' . $cart[0]->name . ',
                                    </p>
                                    <br />
                                    <p class="mainpara" style="padding: 0; margin: 0;">
                                        Just to let you know - we\'ve recieved your donation #37090, and it is now being processed:
                                    </p>
                                    <br />
                                    <h3 style="font-weight: 500; color: #4691aa;">
                                        [Donation #37090](' . date('d/m/Y') . ')
                                    </h3>
                                    <br />
                                </td>
                            </tr>
                            <table class="maintable border" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr class="mainrow">
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;" width="45%">
                                        Donation Items
                                    </th>
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;" width="30%">
                                        Quantity
                                    </th>
                                    <th style="font-size: 0.9rem; font-weight: 500; padding: 15px 12px; text-align: start; border: 1px solid gray;">
                                        Price
                                    </th>
                                </tr>
                                ';
        foreach ($cart as $key => $c) {
            $html = $html . '
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            ' . $c->title . '
                                        </p>
                                        <p class="strong">
                                            Payment Type:
                                            <span class="small" style="font-size: 0.9rem; font-weight: 100;">Single Payment</span>
                                        </p>
                                        <p class="strong">
                                            Donation:
                                            <span class="small" style="font-size: 0.9rem; font-weight: 100;">Other Amount(' . $c->admincost . ' £)</span>
                                        </p>
                                        <p class="strong">
                                            Type Assignments:
                                            <span class="small" style="font-size: 0.9rem; font-weight: 100;">' . $c->type . '</span>
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            ' . $c->qty . '
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100;">
                                            £ ' . $c->amount . '.00
                                        </p>
                                    </td>
                                </tr>
                                ';
        }
        $html = $html . '
                            </table>
                            <table class="maintable border totaltable" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Subtotal:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            £ ' . $subtotal . '.00
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Payment method:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            ' . $cart[0]->payment_method . '
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;" width="75%">
                                        <p class="strong" style="padding: 0; margin: 0;">
                                            Total:
                                        </p>
                                    </td>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p class="small" style="font-size: 0.9rem; font-weight: 100; padding: 0; margin: 0;">
                                            £ ' . $subtotal . '.00
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding-top: 40px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        <h3 style="font-weight: 500; color: #4691aa; margin-block: -10px;">
                                            Checkout Fields
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 35px;">
                                        <ul>
                                            <li class="listfields">
                                                <strong style="font-weight: 500;">TITLE:</strong>
                                                Mr
                                            </li>
                                            <li class="listfields">
                                                <strong style="font-weight: 500;">RECLAIM GIFT AID:</strong>
                                                Yes, I am a ' . $cart[0]->country . ' tax payer and would like Gift Aid claimed on my donations
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding: 0px 0px 20px 0px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        <h3 style="font-weight: 500; color: #4691aa; margin-block: -10px;">
                                            Billing address
                                        </h3>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable border" style="width: 100%; max-width: 570px; margin: 0px 10px; border-collapse: collapse; border: 1px solid gray; padding-top: 40px;">
                                <tr>
                                    <td style="padding: 15px 12px; border: 1px solid gray;">
                                        <p><i>' . $cart[0]->name . ' ' . $cart[0]->lastname . ' </i></p>
                                        <p><i>' . $cart[0]->address . '</i></p>
                                        <p><i>' . $cart[0]->postcode . '</i></p>
                                        <p><i>' . $cart[0]->city . '</i></p>
                                        <p><i>' . $cart[0]->contact . '</i></p>
                                        <p>
                                            <a href="#"><i>' . $cart[0]->email . '</i></a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="maintable" style="padding-bottom: 50px; padding-top: 40px; width: 100%; max-width: 600px;">
                                <tr>
                                    <td class="headpara" style="padding: 5px 35px; text-align: start; font-weight: 100;">
                                        Thanks for using
                                        <a href="https://grtuk.org/">grtuk.org</a>!
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </td>
                </tr>
            </table>
            <p class="copyright" style="width: 100%; max-width: 600px; font-size: 0.9rem; color: rgb(104, 104, 104);">
                Copyright @ 2020 GRTUK, All Right Reserved. We do not deal with interest money. Charity Number : 11114135
            </p>
        </center>
    </body>
</html>

        ';

        // Setup a filename
        $documentFileName = "receipt-user.pdf";

        // Create the mPDF document
        $document1 = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        // Set some header informations for output
        $header1 = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'private',
            'Pragma' => 'private'
        ];

        // Write some simple Content
        $document1->WriteHTML($html);

        // Save PDF on your public storage
        Storage::disk('local')->put($documentFileName, $document1->Output($documentFileName, "S"));

    }
}
