<p>Voucher Number : <span class="bold"><?php echo $cur_voucher->number; ?></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Voucher Date : <span class="bold"><?php echo date_mysql_to_php($cur_voucher->date); ?></span>
</p>

<table border=0 cellpadding=5 class="generaltable">
<thead><tr><th>Type</th><th>Ledger A/C</th><th>Dr Amount</th><th>Cr Amount</th></tr></thead>
<?php
$odd_even = "odd";
foreach ($cur_voucher_ledgers->result() as $row)
{
	echo "<tr class=\"tr-" . $odd_even . "\">";
	echo "<td>" . convert_dc($row->dc) . "</td>";
	echo "<td>" . $this->Ledger_model->get_name($row->ledger_id) . "</td>";
	if ($row->dc == "D")
	{
		echo "<td>" . $row->amount . "</td>";
		echo "<td></td>";
	} else {
		echo "<td></td>";
		echo "<td>" . $row->amount . "</td>";
	}
	echo "</tr>";
	$odd_even = ($odd_even == "odd") ? "even" : "odd";
}
?>
<tr><td colspan=4><hr /></td></tr>
<tr id="total"><td colspan=2>TOTAL</td><td id=dr-total><?php echo $cur_voucher->dr_total; ?></td><td id=cr-total"><?php echo $cur_voucher->cr_total; ?></td></tr>
<?php
if ($cur_voucher->dr_total != $cur_voucher->cr_total)
{
	$difference = $cur_voucher->dr_total - $cur_voucher->cr_total;
	if ($difference < 0)
		echo "<tr id=\"difference\"><td colspan=2>DIFFERENCE</td><td id=\"dr-diff\"></td><td id=\"cr-diff\">" . $cur_voucher->cr_total . "</td></tr>";
	else
		echo "<tr id=\"difference\"><td colspan=2>DIFFERENCE</td><td id=\"dr-diff\">" .  $cur_voucher->dr_total .  "</td><td id=\"cr-diff\"></td></tr>";
}
?>
</table>
<p>Narration :<br />
<span class="bold"><?php echo $cur_voucher->narration; ?></span>
</p>
<p>
Status : <span class="bold"><?php echo ($cur_voucher->draft == 0) ? "Active" : "Draft"; ?></span>
<br /><br />
</p>
<?php 
	echo anchor('voucher/show/' . $voucher_type, 'Back', array('title' => 'Back to ' . ucfirst($voucher_type) . ' Vouchers'));
	echo " | ";
	echo anchor('voucher/edit/' . $voucher_type . "/" . $cur_voucher->id, 'Edit', array('title' => 'Edit ' . ucfirst($voucher_type) . ' Voucher'));
	echo " | ";
	echo anchor('voucher/delete/' . $voucher_type . "/" . $cur_voucher->id, 'Delete', array('class' => "confirmClick", 'title' => "Delete voucher", 'title' => 'Delete this ' . ucfirst($voucher_type) . ' Voucher'));
	echo " | ";
	echo anchor_popup('voucher/printhtml/' . $voucher_type . "/" . $cur_voucher->id, 'Print', array('title' => 'Print  this ' . ucfirst($voucher_type) . ' Voucher'));
	echo " | ";
	echo anchor_popup('voucher/email/' . $voucher_type . "/" . $cur_voucher->id, 'Email', array('title' => 'Email this ' . ucfirst($voucher_type) . ' Voucher', 'width' => '400', 'height' => '200'))
?>