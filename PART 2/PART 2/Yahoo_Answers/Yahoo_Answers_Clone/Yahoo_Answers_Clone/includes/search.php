<?PHP
	session_start();
	
	require_once("includes/configuration.php");
	require_once("includes/classes/class.database.php");
	require_once("includes/classes/class.langauge.php");

	$objLanguage=new language();
	
	$rsLanguage = $objLanguage->GetList(array(array('languageid','!=',"")),'language',true);

	if($_SESSION['languageid'] == '' || $_SESSION['languageid'] == 0) {
		for($i=0;$i<count($rsLanguage);$i++) {
			if($rsLanguage[$i]->language_name == "English") {
				$language_id = $rsLanguage[$i]->languageId;
			}
		}
	}
	else {
		$language_id = $_SESSION['languageid'];
	}
?>
<DIV id=header-user-profile>
    <DIV class=global-search-bar>
		<form action="showsearch.php" name="frmSearch" method="post">
        <TABLE cellSpacing=0 cellPadding=0 border=0>
          <TBODY>
            <TR>
              <TD vAlign=bottom><LABEL for=psearch><STRONG><font size="4">Have a question? Ask it! Know an answer? Share 

it!</font></STRONG></LABEL><font size="4"></TD></font>
              <TD>&nbsp;</TD>
              <TD>&nbsp;</TD>
<!--              <TD vAlign=bottom><A id=ks-mantle-search-advanced-link href=#>Advanced</A></TD> -->
            </TR>
          </TBODY>
        </TABLE>
      </FORM>
		<DIV class=side-link><a href="index.php">Home</a></A></DIV>

    </DIV>
  </DIV>
