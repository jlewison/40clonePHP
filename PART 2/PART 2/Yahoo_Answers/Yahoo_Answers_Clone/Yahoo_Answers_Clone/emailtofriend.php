<?php
	session_start();
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once "includes/classes/mailer.class.php";

	$objMail= new mailer();

	if($HTTP_POST_VARS['cmdMail']){
		$fname=$HTTP_POST_VARS['txtfirstname'];
		$lname=$HTTP_POST_VARS['txtlastname'];
		$to=$HTTP_POST_VARS['txtemail'];
		$subject="You Ask It";
		$message = "<br><br>Hello<p>Your friend ".$fname." ".$lname." has sent this question link to you.<br><br>For more detail click on link <a href='http://www.you-ask-it.com/questiondetail.php?questionid=".$HTTP_POST_VARS['questionid']."'>http://www.you-ask-it.com/questiondetail.php?questionid=".$HTTP_POST_VARS['questionid']."<p>http://you-ask-it.com</a>";

		$flag=$objMail->send_mail($to,$HTTP_POST_VARS['txtfremail'],$subject,$message);
			//$flag=$objMail->Send();
		if($flag==false){
			$msg="Mail Sent Fail.";
		}
		else{
			$msg="Link sent successfully to : ".$HTTP_POST_VARS['txtfremail'];
		}
	}

?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>

<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>Email To Friend </DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <form name="frmaddans" id="frmaddans" method="post" action="emailtofriend.php">
            <input type="hidden" name="questionid" id="questionid" value="<?php echo $HTTP_POST_VARS['questionid'];?>"  />
            <tr>
              <td><table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <tr bgcolor="#EFEFEF">
                  <tr>
					<td colspan="3"><strong><?=$msg;?></strong></td>
					</tr>
<tr>
	<td>&nbsp;</td>
</tr>
					<tr>

						<?php include('includes/google_468x60'); ?>

                    <td align="right" width="30%"> Enter your first name</td>
                    <td align="center" width="5%"> :</td>
                    <td align="left" width="65%"><input type="text" name="txtfirstname" id="txtfirstname" value=""  /></td>
                  </tr>
                  <tr>
                    <td align="right" width="30%"> Enter your Last name</td>
                    <td align="center" width="5%"> :</td>
                    <td align="left" width="65%"><input type="text" name="txtlastname" id="txtlastname" value=""  /></td>
                  </tr>
                  <tr>
                    <td align="right" width="30%"> Enter your email address</td>
                    <td align="center" width="5%"> :</td>
                    <td align="left" width="65%"><input type="text" name="txtemail" id="txtemail" value=""  /></td>
                  </tr>
                  <tr>
                    <td align="right" width="30%"> Enter your friend's email address</td>
                    <td align="center" width="5%"> :</td>
                    <td align="left" width="65%"><input type="text" name="txtfremail" id="txtfremail" value=""  /></td>
                  </tr>
                  <tr>
                    <td align="center" colspan="3"><input type="submit" name="cmdMail" id="cmdMail" value="Send" />
                  </tr>
                </table></td>
            </tr>
          </form>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
      </DIV>
      <DIV class=dotted-line></DIV>
      <!--        <P class=more-link id=ks-more-link>
        <FORM action=#><INPUT class=button type=submit value="More Open Questions >"></FORM>
        </P> -->
    </DIV>
  </DIV>
</DIV>
<?php include("includes/bottom.php");?>
