<?php
require "source/connection.php";

require "source/SMTP.php";
require "source/PHPMailer.php";
require "source/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["id"])) {
    $invoiceId = $_GET["id"];

    $resultset = Database::search("SELECT `invoice`.id AS id, `date`,`fname`,`lname`,`line1`,`line2`,`city`,`contact_no`,`postal_code`, total, `invoice`.user_email AS email FROM `invoice` INNER JOIN 
    `user_has_address` ON `user_has_address`.id=`invoice`.user_has_address_id WHERE `invoice`.id='" . $invoiceId . "' ");

    $orderDetails = $resultset->fetch_assoc();
    $email = $orderDetails['email'];

    $items_rs = Database::search("SELECT `price`, `invoice_item`.qty AS qty, title FROM `invoice_item` INNER JOIN `product` ON `product`.id=`invoice_item`.product_id WHERE invoice_id='" . $invoiceId . "' ");
    ob_start();
    while ($item = $items_rs->fetch_assoc()) {
        $amount = $item['price'] * $item['qty'];
?>
        <tr class='item'>
            <td><?php echo $item['title']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['qty']; ?></td>
            <td><?php echo $amount; ?>.00</td>
        </tr>

<?php
    }
    $htmlOutput = ob_get_clean();


    $date = new DateTime($orderDetails['date']);
    $date = $date->format('Y-m-d');

    //check order placing date same to payment date
    $today = date("Y-m-d");
    if($today != $date){
        $date = $today;

        Database::iud("UPDATE `invoice` SET `date` = '".$today."' WHERE `id`='".$invoiceId."' ");
    }
    //check order placing date same to payment date

    $n = $resultset->num_rows;
    if ($n == 1) {
        $mailbody = "
        <html>
        <head>
            <style>
                .invoice-box {
                    max-width: 800px;
                    margin: auto;
                    padding: 30px;
                    border: 1px solid #eee;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                    font-size: 16px;
                    line-height: 24px;
                    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                    color: #555;
                }
        
                .invoice-box table {
                    width: 100%;
                    line-height: inherit;
                    text-align: left;
                }
        
                .invoice-box table td {
                    padding: 5px;
                    vertical-align: top;
                }
        
                .invoice-box table tr td:nth-child(2) {
                    text-align: right;
                }
        
                .invoice-box table tr.top table td {
                    padding-bottom: 20px;
                }
        
                .invoice-box table tr.top table td.title {
                    font-size: 45px;
                    line-height: 45px;
                    color: #333;
                }
        
                .invoice-box table tr.information table td {
                    padding-bottom: 40px;
                }
        
                .invoice-box table tr.heading td {
                    background: #eee;
                    border-bottom: 1px solid #ddd;
                    font-weight: bold;
                }
        
                .invoice-box table tr.details td {
                    padding-bottom: 20px;
                }
        
                .invoice-box table tr.item td {
                    border-bottom: 1px solid #eee;
                }
        
                .invoice-box table tr.item.last td {
                    border-bottom: none;
                }
        
                .invoice-box table tr.total td:nth-child(2) {
                    border-top: 2px solid #eee;
                    font-weight: bold;
                }
        
                @media only screen and (max-width: 600px) {
                    .invoice-box table tr.top table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
        
                    .invoice-box table tr.information table td {
                        width: 100%;
                        display: block;
                        text-align: center;
                    }
                }
        
                /** RTL **/
                .invoice-box.rtl {
                    direction: rtl;
                    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                }
        
                .invoice-box.rtl table {
                    text-align: right;
                }
        
                .invoice-box.rtl table tr td:nth-child(2) {
                    text-align: left;
                }
            </style>
        </head>
        
        <body>
            <div class='invoice-box'>
                <table cellpadding='0' cellspacing='0'>
                    <tr class='top'>
                        <td colspan='4'>
                            <table>
                                <tr>
                                    <td class='title'>
                                        <img src='https://i.ibb.co/S7MnNFH/SINGLElogo.png' style='width: 150px' />
                                    </td>
                                    <td>
                                        <b>
                                            Invoice #: " . $orderDetails['id'] . "<br />
                                            Date: " .  $date . "
                                        </b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
        
                    <tr class='information'>
                        <td colspan='4'>
                            <table>
                                <tr>
                                    <td>
                                        <b>Unlimited Mobile</b><br />
                                        12345 Sunny Road<br />
                                        Sunnyville, CA 12345
                                    </td>
                                    <td>
                                    " . $orderDetails['fname'] . $orderDetails['lname'] . "<br />
                                    " . $orderDetails['line1'] . " <br/>
                                    " . $orderDetails['line2'] . " <br/>
                                    " . $orderDetails['city'] . "<br/>
                                    " . $orderDetails['postal_code'] . " <br/>
                                    " . $orderDetails['contact_no'] . "
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class='heading'>
                        <td>Item</td>
                        <td>Price</td>
                        <td>&nbsp;&nbsp; Qty &nbsp;&nbsp; </td>
                        <td>Amount</td>
                    </tr>
        
                    ".$htmlOutput."
        
        
                    <tr class='total'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total: " . $orderDetails['total'] . ".00</td>
                    </tr>
                </table>
            </div>
        </body>
        </html>";

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agamers2000@gmail.com';
        $mail->Password = 'wdxcezcrnnyuwjel';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('agamers2000@gmail.com', 'UM');
        $mail->addReplyTo('agamers2000@gmail.com', 'UM');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Unlimited Mobile - Invoice';
        $bodyContent = $mailbody;
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Invoice sending error';
        } else {
            echo 'success';
        }
    } else {
        echo "Invoice Id not found";
    }
} else {
    echo "Invoice sending error.";
}
