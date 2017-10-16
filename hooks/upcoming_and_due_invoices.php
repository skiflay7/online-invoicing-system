<?php
$currDir = dirname(__FILE__) . '/..';
define('PREPEND_PATH', '../');
include("$currDir/defaultLang.php");
include("$currDir/language.php");
include("$currDir/lib.php");
include_once("$currDir/header.php");



$res = sql("SELECT I.id, I.status, I.date_due, I.total, C.name FROM invoices I, clients C WHERE I.client = C.id AND status='Unpaid' AND (MONTH(date_due)= MONTH(CURRENT_DATE) OR MONTH(date_due)=MONTH(CURRENT_DATE+ INTERVAL 1 MONTH)) AND YEAR(date_due)=YEAR(CURRENT_DATE + INTERVAL 1 MONTH)", $eo);

$total_invoice_due_and_upcoming = sqlValue("SELECT SUM(total) FROM invoices WHERE status='Unpaid' AND (MONTH(date_due)= MONTH(CURRENT_DATE) OR MONTH(date_due)=MONTH(CURRENT_DATE+ INTERVAL 1 MONTH)) AND YEAR(date_due)=YEAR(CURRENT_DATE + INTERVAL 1 MONTH)", $eo);

?>



<div class="row">
  <div class="input-group">
  	<span class="input-group-btn">
  		<a href="invoice_button.php" class="btn btn-info hidden-print btn btn-secondary" role="button">Back to Reports</a>
  	</span>
  	<button class="btn btn-primary  hidden-print" type="button" id="sendToPrinter" onclick="window.print();"><i class="glyphicon glyphicon-print"></i> Print</button>
  </div>
  <h1> Upcoming and Due Invoices</h1>
<?php if(db_num_rows($res)){?>
<table class="table table-striped table-bordered">
    <thead>

    <th class="text-center" style="color:#0066ff ; font-size: 15px">Invoice Number</th>
    <th class="text-center" style="color:#0066ff ; font-size: 15px">Customer  Name </th>

    <th class="text-center" style="color:#0066ff ; font-size: 15px">Invoice Date </th>

    <th class="text-center" style="color:#0066ff ; font-size: 15px">$Total </th>

</thead>

<tbody>
	<?php while ($order = db_fetch_assoc($res)) { ?>
		<tr>
			<td class="text-center"><?php echo $order['id']; ?> </td>
			<td class="text-left"><?php echo $order['name']; ?>
			</td>

			<td class="text-center"><?php
				$s = config("adminConfig");
				echo date($s['PHPDateFormat'], strtotime($order['date_due']));
				?></td>

			<td class="text-right"><?php echo number_format($order['total'], 2); ?></td>
		</tr>
	<?php } ?>

</tbody>
<tfoot>
    <tr style="color: red; font-size: 16px;">
      <th colspan="3" class="text-right">Total Due and Upcoming Invoices</th>
      <th class="text-right">$<?php echo number_format($total_invoice_due_and_upcoming, 2);?></th>
    </tr>
</tfoot>
</table>
<?php }else{
	echo '<div class="alert alert-danger">' . $Translation['No records found']. '</div>';
}?>
<?php
include_once("$currDir/footer.php");
?>
</div>