<?php
include "header-main.php";

 $auth=$_SESSION['auth_no'];

if($auth==0)
{
    echo "<h1>you are not authorised </h1>";
    die;
}

$req_no = $_GET['req_no'];

$sqlcmt="select count(*) as cnt from trans_master where req_no=".$req_no;
		$viewcmt = mysql_query($sqlcmt);
		
		$cnt;
		while ($viewcmts = mysql_fetch_array($viewcmt))
		{
			$cnt=$viewcmts['cnt'];
		}

//echo "Request No is ".$req_no;
//echo "<br/><br/>";

?>
<script type="text/javascript">


function checkform(form)
{
    if(form.name.value.length==0)
	{
	  	alert("Please enter the Theme Name");
	  	form.name.value="";
	  	form.name.focus();
	  	return false;
	}
	if(form.descp.value.length==0)
	{
	  	alert("Please enter the Theme Description");
	  	form.descp.value="";
	  	form.descp.focus();
	  	return false;
	}
	if(form.category.value=='0')
  	{
  		alert("Please select the Category");
  		form.category.value="";
  		form.category.focus();
  		return false;
  	}
  	if(form.exp_date.value.length==0)
	{
	  	alert("Please enter the Expiry Date in the format (yyyy-mm-dd)");
	  	form.exp_date.value="";
	  	form.exp_date.focus();
	  	return false;
	}



}

function populatedata()
{

alert ('We are in Populate data');
//document.getElementById('cscprbusponsor').value="OCTO";
myForm.cscprreqtheme.selectedIndex=2;
myForm.cscprbusponsor.value="OCTO";
//myForm.cscprfund.selectedIndex=1;
myForm.cscprfund.value="No";
myForm.cscproverview.value="Project Overview in few words";
myForm.cscprprobstat.value="Problem Statement in few words";
myForm.cscprcustseg.selectedIndex=1;
myForm.cscpruvp.value="Unique Value prop of our project/expt";
myForm.cscprsolndesc.value="Solution desc of our project";
myForm.cscprsolnfeatures.value="Solution features of our project";
myForm.cscprmetric1.value="KM1";
myForm.cscprmetric2.value="KM2";
myForm.cscprmetric3.value="KM3";
myForm.cscprmetric1measure.value="KM1M";
myForm.cscprmetric2measure.value="KM2M";
myForm.cscprmetric3measure.value="KM3M";
myForm.cscprkeymetric.selectedIndex=2;
myForm.cscprkeycharacteristics.selectedIndex=4;
myForm.cscprexptname.value="Demo Project Data";
//myForm.cscprchannel[1].checked=true;
//myForm.cscprunfairadv[0].checked=true;
myForm.cscprchannel.value="Paid";
myForm.cscprunfairadv.value="Yes";
myForm.cscprcoststruct[1].checked=true;
//myForm.cscprcoststruct[3].checked=checked;
//myForm.cscprcoststruct[5].checked=true;
myForm.cscprrevstream[2].checked=true;
//myForm.cscprrevstream[4].checked=true;
myForm.cscprrevstreamass[1].checked=true;
//myForm.cscprrevstreamass[3].checked=true;
return true
}

</script>
<style>
.hide{
display:none;
}
.show{
display:block;
}
</style>

<?php
		$sql="select * from csc_lr_experiment_req where request_num=".$req_no;
		$expt_detail=mysql_query($sql);
?>

<form id="myForm" action="intimateusertoupload.php?req_no=<?php echo $req_no;?>" method="POST">

		<table border="0" width="90%" height="60%">
	<tr>
		<td width="100%">
			<table border="0" width="100%" cellpadding="2" cellspacing="2" >
			<tr><th class="theme-details-l">View Selected Idea</th></tr>
			<tr>
				<td width="100%">
					<div class="laasasidediv">
					<?php
				while($row = mysql_fetch_array($expt_detail))
				{
						
					$sql="select meta_text,meta_desc from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'experiment_snapshot' and meta_code = ".$row['experiment_current_snapshot'];
					//echo "Busines Funding ".$row['funding_by_business'];
					//echo "<br/>";
	//echo $sql;
					$expt_snapshot=mysql_query($sql);
					while($expt_snapshots = mysql_fetch_array($expt_snapshot))
					{
						$expt_snapshots_text = $expt_snapshots['meta_text'];
						$expt_snapshots_name = $expt_snapshots['meta_desc'];
					
					
		?>
					<!--<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td colspan="6"><h3>Challenge Request</h3> <hr></td>
						</tr>
						<tr>
							<td >Challenge Type: </td>
							<td ><select name="cscprchallengetype" id="cscprchallengetype" >
							<option value="-1">--Select the Challenge Type--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'challenge_type' ";
								$challenge_types=mysql_query($sql);
								while($challenge_type = mysql_fetch_array($challenge_types))
								{
							?>
									<option value="<?php echo $challenge_type['meta_code'];?>" ><?php echo $challenge_type['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							<td colspan="4">&nbsp;</td>
						</tr>
						</table>-->
						<?php
							$empname;
							if (stripos($row['mentor_email_id'],";")=="0")
							{
							$sqlemp="select name from emp_master where short_id = '".$row['mentor_email_id']."'";
							$empmast=mysql_query($sqlemp);
							
							while($empmaster = mysql_fetch_array($empmast))
								{	
									$empname=$empmaster['name'];
								}
							}
							else
							{
								$tempname1=strstr($row['mentor_email_id'],";",TRUE);
								$tempname=strstr($row['mentor_email_id'],";");
								$tempname2=str_replace(";","",$tempname);
								//echo "Temp Name 1: ".$tempname1;
								//echo "<br/>Temp Name 2: ".$tempname2;
								$sqlemp1="select name from emp_master where short_id = '".$tempname1."'";
								$empmast1=mysql_query($sqlemp1);
							
								while($empmaster1 = mysql_fetch_array($empmast1))
								{	
									$empname=$empmaster1['name'];
								}
								$sqlemp2="select name from emp_master where short_id = '".$tempname2."'";
								$empmast2=mysql_query($sqlemp2);
							
								while($empmaster2 = mysql_fetch_array($empmast2))
								{	
									$empname=$empname." / ".$empmaster2['name'];
								}
							}
						?>
						<input type="hidden" name="cscprchallengetype" value="ideachallenge">
						<div class="show" id="ongoing">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td colspan="5">&nbsp;</td>
							<td ><span class="cscprstatus">Status :</span><span class="cscprstatustext" > <?php echo $expt_snapshots_name;?></span><br/>
							<?php 
							if ($row['experiment_current_snapshot'] >= "700")
							{
							?>
							<span class="cscprstatus">ATD Mentor :</span><span class="cscprstatustext" > <?php if ($empname<>"") echo $empname;?></span><br/>
							<?php 
							}
							?>
							<?php 
							if (($row['experiment_current_snapshot'] >= "711") && ($row['AoD_reference'] <> ""))
							{
							?>
							<span class="cscprstatus">AoD Reference :</span><span class="cscprstatustext" > <a href="<?php echo $row['AoD_reference'];?>" target="_blank">AoD</a></span><br/>
							<?php 
							}
							elseif ($row['experiment_current_snapshot'] >= "711")
							{
							?>
							<span class="cscprstatus">AoD Reference :</span><span class="cscprstatustext" > AoD</span><br/>
							<?php 
							}
							?>
							</td>
						</tr>
						<tr>
							<td colspan="6"><hr width="100%"></td>
						</tr>
						<tr>
							<td>Idea Theme: </td>
							
							<td ><select name="cscprreqtheme" class="controltext" disabled>
							<option value="-1">--Select the Request Theme--</option>
							<?php 
								$themesql="select * from csc_lr_metadata where meta_name = 'CTO' and meta_type='request_theme' and meta_code=".$row['request_theme'];
								$request_themes=mysql_query($themesql);
							
								//$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'request_theme' ";
								//$request_themes=mysql_query($sql);
								while($request_theme = mysql_fetch_array($request_themes))
								{
							?>
									<option value="<?php echo $request_theme['meta_code'];?>" selected ><?php echo $request_theme['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Experiment/Project Name: </td><td ><input type="text" name="cscprexptname" class="controltext" value="<?php echo $row['expt_shortname'];?>" readonly /></td>

							<td>BU Sponsor: </td><td ><input type="text" name="cscprbusponsor" class="controltext" value="<?php echo $row['bu_sponsor'];?>" readonly /></td>
						</tr>
						<tr>
							<td>Overview: </td><td ><textarea name="cscproverview" rows="3" class="controltext" readonly><?php echo $row['overview'];?></textarea></td>

							<td>Problem Statement: </td><td ><textarea name="cscprprobstat" class="controltext" rows="3" readonly><?php echo $row['problem_statement'];?></textarea></td>

							<td>Region: </td><td><select name="cscprregion" id="cscprregion" class="viewcontroltext" disabled >
							<option value="-1">--Select Region--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'region' and meta_code=".$row['region_id'];
								$regions1=mysql_query($sql);
								while($region1 = mysql_fetch_array($regions1))
								{
							?>
									<option value="<?php echo $region1['meta_code'];?>" selected ><?php echo $region1['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>
						</tr>
						<tr>
							<td>Unique Value Proposition (UVP): </td><td><textarea name="cscpruvp" class="controltext" rows="3" readonly><?php echo $row['unique_value_proposition'];?></textarea></td>

							<td>Solution Description: </td><td><textarea name="cscprsolndesc" class="controltext" rows="3" readonly><?php echo $row['solution_brief'];?></textarea></td>

							<td>Solution Features: </td><td><textarea name="cscprsolnfeatures" class="controltext" rows="3" readonly><?php echo $row['solution_features'];?></textarea></td>
						</tr>
						<tr>
							<td>Key Metric1: </td><td><select name="cscprmetric1" class="controltext" disabled>
							<option value="-1">--Select the Key Metric1--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_1'];
								$key_metrics1=mysql_query($sql);
								while($key_metric1 = mysql_fetch_array($key_metrics1))
								{
							?>
									<option value="<?php echo $key_metric1['meta_code'];?>" selected><?php echo $key_metric1['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric2: </td><td><select name="cscprmetric2" class="controltext" disabled>
							<option value="-1">--Select the Key Metric2--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_2'];
								$key_metrics2=mysql_query($sql);
								while($key_metric2 = mysql_fetch_array($key_metrics2))
								{
							?>
									<option value="<?php echo $key_metric2['meta_code'];?>" selected><?php echo $key_metric2['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>

							<td>Key Metric3: </td><td><select name="cscprmetric3" class="controltext" disabled>
							<option value="-1">--Select the Key Metric3--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_metric' and meta_code=".$row['key_metric_3'];
								$key_metrics3=mysql_query($sql);
								while($key_metric3 = mysql_fetch_array($key_metrics3))
								{
							?>
									<option value="<?php echo $key_metric3['meta_code'];?>" selected><?php echo $key_metric3['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
						</tr>
						<tr>
							<td>Key Metric1 Measure: </td><td><input type="text" name="cscprmetric1measure" class="controltext" value="<?php echo $row['key_metric_1_measure'];?>" readonly /></td>

							<td>Key Metric2 Measure: </td><td><input type="text" name="cscprmetric2measure" class="controltext" value="<?php echo $row['key_metric_2_measure'];?>" readonly /></td>

							<td>Key Metric3 Measure: </td><td><input type="text" name="cscprmetric3measure" class="controltext" value="<?php echo $row['key_metric_3_measure'];?>" readonly /></td>
						</tr>
						<tr>
							<td>Primary Metrics that matters: </td><td><select name="cscprkeymetric" class="controltext" disabled>
							<option value="-1">--Select the Primary Metrics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'primary_metric' and meta_code=".$row['primary_metrics_matters'];
								$primary_metrics=mysql_query($sql);
								while($primary_metric = mysql_fetch_array($primary_metrics))
								{
							?>
									<option value="<?php echo $primary_metric['meta_code'];?>" selected><?php echo $primary_metric['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
							<td>Key Characteristics: </td><td><select name="cscprkeycharacteristics" class="controltext" disabled>
							<option value="-1">--Select the Key Characteristics--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'key_characteristics' and meta_code=".$row['key_characteristics'];
								$key_characteristics=mysql_query($sql);
								while($key_characteristic = mysql_fetch_array($key_characteristics))
								{
							?>
									<option value="<?php echo $key_characteristic['meta_code'];?>" selected><?php echo $key_characteristic['meta_text']; ?></option>
							<?php
								}
							?>					
							</select></td>

							<td>Customer Segment: </td><td ><select name="cscprcustseg" class="controltext" disabled>
							<option value="-1">--Select the Customer Segment--</option>
							<?php 
								$sql="select meta_code, meta_text from csc_lr_metadata where meta_name = 'CTO' and meta_type = 'customer_segment' and meta_code=".$row['customer_segment'];
								$customer_segments=mysql_query($sql);
								while($customer_segment = mysql_fetch_array($customer_segments))
								{
							?>
									<option value="<?php echo $customer_segment['meta_code'];?>" selected><?php echo $customer_segment['meta_text']; ?></option>
							<?php
								}
							?>
							</select></td>
							
						</tr>
						<tr>							
							<td>Cost Structure: </td><td><textarea name="cscprcoststruct" class="controltext" rows="3" readonly><?php echo $row['cost_structure'];?></textarea></td>

							<td>Revenue Stream: </td><td><textarea name="cscprrevstream" class="controltext" rows="3" readonly><?php echo $row['revenue_stream'];?></textarea></td>
					
							<td>Revenue Stream Assumptions: </td><td><textarea name="cscprrevstreamass" class="controltext" rows="3" readonly><?php echo $row['revenue_stream_assumptions'];?></textarea></td>
						</tr>
						<tr>						
							<td>Unfair Advantage: </td><td><!--<input type="text" name="cscprunfairadv" class="controltext" value="<?php echo $row['unfair_advantage'];?>" readonly />-->
							<input type="radio" name="cscprunfairadv" class="controltext" disabled value="Yes" <?php if ($row['unfair_advantage']=='Yes') {?> checked <?php }?> > Yes
							<input type="radio" name="cscprunfairadv" class="controltext" disabled value="No" <?php if ($row['unfair_advantage']=='No') {?> checked <?php }?> > No
							</td>
							
							<td>Funding Provided by Business: </td><td><!--<input type="text" name="cscprfund" class="controltext" value="<?php echo $row['funding_by_business'];?>" readonly />-->
							<input type="radio" name="cscprfund" class="controltext" disabled value="Yes" <?php if ($row['funding_by_business']=='Yes') {?> checked <?php }?> > Yes
							<input type="radio" name="cscprfund" class="controltext" disabled value="No" <?php if ($row['funding_by_business']=='No') {?> checked <?php }?> > No
							
							</td>							

							<td>Channels: </td><td><!--<input type="text" name="cscprchannel" class="controltext" value="<?php echo $row['channels'];?>" readonly />-->
							<input type="radio" name="cscprchannel" class="controltext" disabled value="Yes" <?php if ($row['channels']=='Free') {?> checked <?php }?> > Free
							<input type="radio" name="cscprchannel" class="controltext" disabled value="No" <?php if ($row['channels']=='Paid') {?> checked <?php }?> > Paid

							</td>
							
							<!--<td colspan="2" align="right"><input type="button" name="populatedemodata" value="Populate Demo Data" onclick="populatedata();">&nbsp;&nbsp;&nbsp;<input type="submit" name="prsubmit" Value="Submit" > &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='index.php'"></td>-->
						</tr>
						<!--<tr>
							<td colspan="6"><hr width="100%"></td>
						</tr>-->
						<tr>
							<td>Document Link: </td><td><?php if ($row['document_link']<>'') { ?><a href="<?php echo $row['document_link'];?>" border="0">View Document</a><?php } ?></td>
							<td colspan="2">Comments: &nbsp;&nbsp;&nbsp;<textarea name="cscprcomments" class="controltext" rows="3" cols="50"><?php echo $row['Comments'];?></textarea></td>
							<td colspan="2" align="right"><input type="hidden" name="cscprreqno" class="controltext" value="<?php echo $row['request_num'];?>" /><input type="button" name="prcommentdetails" class="controltext" value="View All Comments" <?php if ($cnt==0) {?> disabled <?php } ?> onclick="window.open('ViewAllComments.php?req_no='+<?php echo $req_no;?>,'_blank','toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=700, height=300');">
							<?php
							if ($_SESSION['role']!='4')
							{
							?>
							<!--<input type="submit" name="prapproved" value="Approved" >&nbsp;&nbsp;&nbsp;<input type="submit" name="prrejected" Value="Rejected" > &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="pronhold" Value="On Hold" >-->
							<?php 
							}
							?>
							<br/><br/><input type="submit" name="irbnotify" class="controltext" value="Notify Winner to Upload IRB Template"><br/><br/><input type="button" name="prcancel" Value="Cancel" class="controltext" onclick="javascript:history.back();"></td>
						</tr>
						</table>
						</div>
						<div class="hide" id="agenda">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>						
							<td>Question 1: </td><td><input type="text" name="cscpragendaans1" /></td>
						</tr>
						<tr>						
							<td>Question 2: </td><td><input type="text" name="cscpragendaans2" /></td>
						</tr>
						<tr>						
							<td>Question 3: </td><td><input type="text" name="cscpragendaans3" /></td>
						</tr>
						<tr>						
							<td>Question 4: </td><td><input type="text" name="cscpragendaans4" /></td>
						</tr>
						<tr>						
							<td>Question 5: </td><td><input type="text" name="cscpragendaans5" /></td>
						</tr>
						<tr>						
							<td colspan="2" align="right"><input type="button" name="prsubmit" Value="Submit" onclick="self.location='?load=index/summary'"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='?load=index/home'"></td>
						</tr>
						</table>
						</div>
						<div class="hide" id="paper">
						<table border="0" width="100%" cellpadding="2" cellspacing="2">
						<tr>
							<td>Paper theme: </td>
							<td><select name="papertheme">
								<option value="-1">--Select Paper Theme--</option>
								<option value="1">Paper Theme 1</option>
								<option value="2">Paper Theme 2 </option>
								</select></td>
						</tr>
						<tr>
							<td>Upload Paper: </td>
							<td><input type="file" name="fileToUpload" id="fileToUpload">
								<input type="submit" value="Upload Paper" name="submit"></td>
						</tr>
						<tr>						
							<td colspan="2" align="right"><input type="button" name="prsubmit" Value="Submit" onclick="self.location='?load=index/summary'"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="prcancel" Value="Cancel" onclick="self.location='?load=index/home'"></td>
						</tr>
						</table>
						</div>
					</table>
					<?php
						}
					}					
					?>
					</div>
					<br/>
				</td>&nbsp;&nbsp;&nbsp;
				</tr>
			</table>
		</td>
	</tr>
	</table>
	</form>

<?php
//}
include "footer.php";
?>