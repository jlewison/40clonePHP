<?php
	function pagging_fun ($page, $total_record, $page_size,$str_search)//exactly same as google
	{
         $st="";
         $fn="";
/*        if(count($str_search)>0)
        {
           foreach($str_search as $v)
           {
            foreach($v as $k=>$p)
            {
              if($k=='cat_id')
                     $st.=$p;
              else if($k=='fun_type')
                    $fn.=$p;
              else if($k=='psearch')
                    $st.=$p;
			  else if($k=='vsearch')
			  		$st.=$p;
			  else if($k=='msearch')
			  		$st.=$p;
			  else if($k=='vosearch')
			  		$st.=$p;
             }

           }
         }
		*/

        $page_no = "";
		$next_page = "";
		if ($total_record > $page_size)//MAIN IF
			{
				$record_for_paging = ($total_record / $page_size);
			  if ($record_for_paging > floor($record_for_paging))
			  {
				 $record_page = (floor($record_for_paging)) + 1;
			  }
			  else
			  {
				 $record_page = $record_for_paging;
			  }

			if ($record_page <= $page_size) $v = $record_page; else $v =5;//$page_size;
			//if ($page != 1) $prev_page = "<a href=javascript:next_prev_page(".($page - 1).");>&lt;&lt;Previous</a>";
			//if ($page != $record_page) $next_page = "<a href=javascript:next_prev_page(".($page + 1).");>Next&gt;&gt; </a>";
			if ($page != 1)
            {
               //  $prev_page = "<div class='pages'><a href=javascript:next_prev_page(".($page - 1).",'$st','$fn');><img src='images/btn_prv1.gif' width='16' height='16' /></a></div>";
               //  $first_page = "<div class='pages'><a href=javascript:next_prev_page(".(1).",'$st','$fn');><img src='images/btn_prvfirst.gif' width='16' height='16' /></a></div>";
            }
			else $prev_page="";
			if ($page != $record_page)
            {
               //  $next_page = "<div class='pages'><a href=javascript:next_prev_page(".($page + 1).",'$st','$fn');><img src='images/btn_nxt1.gif' width='16' height='16' /></a></div>";
                //  $last_page = "<div class='pages'><a href=javascript:next_prev_page(".($v).",'$st','$fn');><img src='images/btn_lst1.gif' width='16' height='16' /></a></div>";
            }
				$print="";
			if ($page == 1)
				{
				for ($page_no = 1;$page_no <= $v;$page_no++)
					{
					if($record_page >=$page_no )
						{
						if ($page_no == $page){ $print.= "<a>".$page_no."</a>";}
						else  $print.="  <b><a href=javascript:next_prev_page($page_no,'$st','$fn');>$page_no</a></b>";
						}
					}
				}
			elseif ($page <= $record_page)
				{
				if ($page_no <= $record_page)	$new_no = 2;else $new_no = $page - 4;

				if ($page_no <= $record_page)	//$new_no = 1;else
				 $new_no = $page - 4;
								// for ($page_no = $new_no;$page_no <= $page+10;$page_no++)
				 for ($page_no = $new_no;$page_no <= $page+4;$page_no++)
					{if($page_no > 0){
					if ($page_no == $page ) $print.= " <a>".$page_no."</a>";
					else { if ($page_no <= $record_page)$print.= "  <b><a href=javascript:next_prev_page($page_no,'$st','$fn');>$page_no</a></b>";}
					}
					}
				}
//
			$start  = ($page - 1) * $page_size;
			$start_range = $start+1;
			$end_range = $start+$page_size;
            if ($end_range >= $total_record)
                	$end_range = $total_record;		//end display
			$range = $start_range."-".$end_range." of ".$total_record;
			$pager="<table width='100%'><tr><td style='padding:3px 5px'>
                        <table width='100%' border='0' cellspacing='0' cellpadding='0' style='font-family:Verdana; font-size:11px'>
							<tr>
							<td><p>Displaying <strong>".$start_range."</strong> to <strong>".$end_range."</strong> of <strong>".$total_record."</strong></p></td>
								<td><table border='0' cellpadding='2' cellspacing='2' align='right'>
							<tr>
						    <td>".$first_page."</td>
        					<td>".$prev_page."</td>
							<td>".$print."</td>
		    				<td>".$next_page."</td>
			    			<td>".$last_page."</td>
				        	</tr>
						</table></td>
						</tr>
						</table></td>
						</tr></table>";
				return $pager;
			}//if MAIN
	}//function end

?>