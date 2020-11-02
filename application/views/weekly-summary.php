<h3>Your Weekly Summary</h3>
<?php
echo "For ".$date_show;
?>
<!-- <span>For Monday, January 6, 2020</span> -->
<h3>For Your Attention</h3>
<div style="border:1px solid #000000; width:50%; margin: 10px 10px;">
	<h4 style=" margin: 10px 10px;">Upcoming Expiring Leases</h4>

	<table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>Due Date</th>
			<th>Weekly Rent</th>
		</tr>
		<?php
		if(!empty($leaseduedata)){
	        foreach ($leaseduedata as $key => $value) {
	        	//print_r($value);
			?>
			<tr>
				<td><?php echo  $value['end_date']; ?></td>
				<td><?php echo  $value['monthly_rent']; ?></td>
			</tr>
			<?php
			}
		}else{
			?>
			<td colspan="3">All clear</td>
			<?php
		}
		  //print_r($leaseduedata);
		?>
	</table>
</div>
<div style="border:1px solid #000000; width:50%; margin: 10px 10px;">
	<h4 style=" margin: 10px 10px;">Late Payments</h4>
	<h4 style=" margin: 10px 10px;">Money owed to you</h4>
	<div style=" margin: 10px 10px;">
	<span style=" margin: 10px 10px;">Below is a subset of the oustanding past-due payments. Please log into your account to view all payments.</span>
    </div>
    <table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>Money Type</th>
			<th>ADDRESS</th>
			<th>Due Amount</th>
		</tr>
		<?php
		if(!empty($leaseduedata)){
		        foreach ($leaseduedata as $key => $value) {
		        	if($value['money_type'] == 'credit'){
					?>
					<tr>
						<td><?php echo  $value['money_type']; ?></td>
						<td><?php echo  $value['property_address']; ?></td>
						<td><?php echo  $value['due_amount']; ?></td>
					</tr>
				    <?php
				    }
				    else{
				    	?>
				    	<td colspan="3">All clear</td>
				    	<?php
				    }
			    }
		}else{
		?>
			<td colspan="3">All clear</td>
	    <?php
		}
		?>
	    </table>
    
	<h4 style=" margin: 10px 10px;">Money you owe</h4>
	  <table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>Money Type</th>
			<th>ADDRESS</th>
			<th>Due Amount</th>
		</tr>
		<?php
		if(!empty($leaseduedata)){
	        foreach ($leaseduedata as $key => $value) {
		        if($value['money_type'] == 'debit'){
				?>
				<tr>
					<td><?php echo  $value['money_type']; ?></td>
					<td><?php echo  $value['property_address']; ?></td>
					<td><?php echo  $value['due_amount']; ?></td>
				</tr>
			    <?php
			    }
			    else{
			    	?>
			    	<td colspan="3">All clear</td>
			    	<?php
			    }
		    }
	    }else{
		?>
		  <td colspan="3">All clear</td>
		<?php
	    }
		?>
	</table>
</div>
<div style="border:1px solid #000000; width:50%; margin: 10px 10px;">
	<h4 style=" margin: 10px 10px;">Recurring Payments Ending Soon</h4>
		<table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>Recurring</th>
			<th>ADDRESS</th>
			<th>Due Amount</th>
			<th>Due Date</th>
		</tr>
		<?php
		if(!empty($leaseduedata)){
	        foreach ($leaseduedata as $key => $value) {
		        if($value['recurring_frequency'] == 'weekly'){
				?>
				<tr>
					<td><?php echo  $value['recurring_frequency']; ?></td>
					<td><?php echo  $value['property_address']; ?></td>
					<td><?php echo  $value['due_amount']; ?></td>
					<td><?php echo  $value['recurring_date']; ?></td>
				</tr>
			    <?php
			    }
			    else{
			    	?>
			    	<td colspan="3">All clear</td>
			    	<?php
			    }
		    }
	    }else{
		?>
		<td colspan="3">All clear</td>
		<?php
	    }
		?>
	</table>
</div>

<div style="border:1px solid #000000; width:50%; margin: 10px 10px;">
	<h4 style=" margin: 10px 10px;">Vacant Properties</h4>
	<table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>PACKAGE</th>
			<th>ADDRESS</th>
			<th>ADVERTISING</th>
		</tr>
		<?php
		if(!empty($vacantproperties)){
	        foreach ($vacantproperties as $key => $value) {
	        	//print_r($value);
			?>
			<tr>
				<td>Smart</td>
				<td><?php echo $value['address']; ?></td>
				<td>OFF</td>
			</tr>
		    <?php
		    }
	    }else{
		?>
		<td colspan="3">All clear</td>
		<?php
	    }
		?>
	</table>
</div>

<!-- <h3>Recent Activity</h3>
<div style="border:1px solid #000000; width:50%; margin: 10px 10px;">
	<h4 style=" margin: 10px 10px;">Payments Summary</h4>
	<table border="1" style=" margin: 10px 10px;">
		<tr>
			<th>WEEK</th>
			<th>12/15</th>
			<th>12/22</th>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td>$0.00</td>
			<td>$0.00</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td>$0.00</td>
			<td>$0.00</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td>$0.00</td>
			<td>$0.00</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td>$0.00</td>
			<td>$0.00</td>
		</tr>
	</table>
</div> -->
