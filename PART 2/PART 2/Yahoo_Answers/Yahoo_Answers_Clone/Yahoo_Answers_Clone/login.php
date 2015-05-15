<?PHP
	session_start();
?>
<?php include("includes/top.php");?>
<?php include("includes/search.php");?>

<DIV class=home id=y-body-green-knowledge-search>
  <DIV id=content>
    <?php include("includes/left.php");?>
    <DIV id=middle>
      <DIV id=ks-homepage-heading>Login Required </DIV>
      <DIV class=silk_hp_open id=ks-homepage-questions>
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td height="13px"></td>
          </tr>
          <form name="frmaddans" id="frmaddans" method="post" action="answerthisquestion.php">
            <input type="hidden" name="questionid" id="questionid" value="<?php echo $HTTP_POST_VARS['questionid'];?>"  />
            <tr>
              <td><table width="100%" cellpadding="2" cellspacing="0" border="0">
                  <tr>
                    <td width="48%" valign="top"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>You need to login before accessing member section. Please use left side box for login.</td>
                        </tr>
                      </table></td>
                    <td width="4%">&nbsp;</td>
                    <td width="48%"><table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>If you are not registered user of You-Ask-It than please register <a href="createaccount.php">here</a> to access enriched member section.</td>
                        </tr>
                      </table></td>
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
