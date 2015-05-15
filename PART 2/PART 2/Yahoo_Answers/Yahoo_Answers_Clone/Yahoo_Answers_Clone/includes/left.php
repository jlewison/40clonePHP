<?PHP
	session_start();

	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.category.php");

	$objCategory = new category();

	if($_GET['catid'] != '') {
		$rsSubCategory = $objCategory->GetList(array(array('path','=',$_GET['catid']),array('level','=','1'),array('langid','=',$language_id)),'',true);
	}
	$rsCategory = $objCategory->GetList(array(array('categoryid','!=',''),array('level','=','0'),array('langid','=',$language_id)),'',true);

?>
<div id=left>
        <div>
          <div id=y-ks-profile-widget>
            <div id=y-ks-profile-widget-container>
              <div class=corner-top>
                <div class=corner-left></div>
              </div>
              <div class=hide id=y-ks-header-user-profile-widget-msg-2 style="Z-INDEX: 1001"></div>
              <div class=show id=y-ks-header-user-profile-widget-msg-1 style="Z-INDEX: 1002">
                <TABLE cellSpacing=0 cellPadding=0 border=0>
                  <TBODY>
                    <TR>
                      <TD style="WIDTH: 60px"><IMG alt="Answers User" src="images//ptwidget_default_icon.gif"></TD>
                      <TD style="FONT-SIZE: 105%; HEIGHT: 50px; TEXT-ALIGN: center" vAlign=absmiddle align=middle>Ready to Participate?<BR>
                        <A style="FONT-WEIGHT: bold" href="createaccount.php">Get Started!</A> </TD>
                    </TR>
                  </TBODY>
                </TABLE>
              </div>
            </div>
            <div class=corner-bottom>
              <div class=corner-left></div>
            </div>
          </div>
        </div>
        <div>
          <div id=y-ks-profile-widget>
            <div id=y-ks-profile-widget-container-login>
              <div class=corner-top>
                <div class=corner-left></div>
              </div>
              <div class=hide id=y-ks-header-user-profile-widget-msg-2 style="Z-INDEX: 1001"></div>
              <div class=show id=y-ks-header-user-profile-widget-msg-1 style="Z-INDEX: 1002">
                <form name="frmLogin" id="frmLogin" action="index.php" method="post">
			<table cellpadding="3" cellspacing="0" border="0" width="80%" align="center">
					<tr>
					<td align="center"><strong></strong></td>
				</tr>
				<?php if($_SESSION['Username']=='' &&$_SESSION['Password']==''){?>

				<tr>
					<td align="left"><strong>Username : </strong><input type="text" name="txtUsername" /></td>
				</tr>
				<tr>
					<td align="left"><strong>Password : </strong><input type="password" name="txtPassword" /></td>
				</tr>
				<tr>
					<td align="center"><input type="submit" name="cmdSend" value="Submit" />&nbsp;&nbsp;</td>
				</tr>
				<tr>
				<td align="center"> <a href="createaccount.php"> Create an Account	</a>
				</td>
				</tr>
				<tr>
				<td align="center"> <a href="forgetpassword.php"> Forgot a Password? </a>
				</td>
				</tr>
				<tr><td align="center"><a href="http://www.<? echo $configuration['URL'] ?>/recommend.htm" target="page" onClick="window.open('','page','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=550,height=410,left=50,top=50,titlebar=yes')">Recommend this site</a>
				<?php }else{?>
				<tr>
				<td align="left"><a href="logout.php">Logoff</a></td>
				</tr>
				<tr>
				<td align="left"><a href="myaccount.php?userid=<?php echo $_SESSION['userid'];?>">My Account</a></td>
				</tr>
				<tr>
				<td align="left"><a href="watchlist.php?userid=<?php echo $_SESSION['userid'];?>">Watchlist</a></td>
				</tr>
				<tr>
					<td align="left"><a href="questionlist.php?userid=<?php echo $_SESSION['userid'];?>">Posted Question List</a></td>
				</tr>
				<tr>
					<td align="left"><a href="postquestion.php">Post Your Question Here</a></td>
				</tr>
				<?php }?>
			</table>
			</form>
              </div>
            </div>
            <div class=corner-bottom>
              <div class=corner-left></div>
            </div>
          </div>
        </div>
		<?PHP
			if($_GET['catid'] != '' && sizeof($rsSubCategory) != 0) {
		?>
      <H2 class=header>Sub Categories</H2>
        <div id=categories>
          <div id=cat-undo>
            <UL>
			<?PHP
				for($i=0;$i<sizeof($rsSubCategory);$i++) {
			?>
				<li><a class=subtle href="categorydetail.php?catid=<?PHP echo $rsSubCategory[$i]->categoryId ?>"><?PHP echo $rsSubCategory[$i]->category_name ?></a></li>
			<?PHP
			}
			?>
            </UL>
			<?PHP
				if(count($rsSubCategory) == 0) {
			?>
				No Subcategories Found
			<?PHP
			}
			?>
          </div>
        </div>
        <IMG height=1 alt="" src="images/b.gif" width=1>
      </div> -->

		<?PHP
		}
		?>
        <H2 class=header>Categories</H2>
        <div id=categories>
          <div id=cat-undo>
            <UL>
			<?PHP
				for($i=0;$i<sizeof($rsCategory);$i++) {
			?>
				<li><a class=subtle href="categorydetail.php?catid=<?PHP echo $rsCategory[$i]->categoryId ?>"><?PHP echo $rsCategory[$i]->category_name ?></a></li>
			<?PHP
			}
			?>
            </UL>
			<?PHP
				if(count($rsCategory) == 0) {
			?>
				No Categories Found
			<?PHP
			}
			?>
          </div>
        </div>
        <IMG height=1 alt="" src="images/b.gif" width=1>
      </div>