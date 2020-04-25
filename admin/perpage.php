<?php
	function perpage($count, $per_page = '10',$href) {
		$output = '';
		$paging_id = "link_perpage_box";
		if(!isset($_POST["page"])) $_POST["page"] = 1;
		if($per_page != 0)
		$pages  = ceil($count/$per_page);
		if($pages>1) {
			
			if(($_POST["page"]-3)>0) {
				if($_POST["page"] == 1)
					$output = $output . '<li class="page-item active"><span id=1 class="current-page page-link">1</span></li>';
				else				
					$output = $output . '<li class="page-item"><input type="submit" name="page" class="perpage-link page-link" value="1"/></li>';
			}
			if(($_POST["page"]-3)>1) {
				$output = $output . '<li class="page-item"><span class="page-link">...</span></li>';
			}
			
			for($i=($_POST["page"]-2); $i<=($_POST["page"]+2); $i++)	{
				if($i<1) continue;
				if($i>$pages) break;
				if($_POST["page"] == $i)
					$output = $output . '<li class="page-item active"><span id='.$i.' class="current-page page-link">'.$i.'</span></li>';
				else				
					$output = $output . '<li class="page-item"><input type="submit" name="page" class="perpage-link page-link" value="'.$i.'"/></li>';
			}
			
			if(($pages-($_POST["page"]+2))>1) {
				$output = $output . '<li class="page-item"><span class="page-link">...</span></li>';
			}
			if(($pages-($_POST["page"]+2))>0) {
				if($_POST["page"] == $pages)
					$output = $output . '<li class="page-item active"><span id='.($pages).' class="current-page page-link">'.($pages).'</span></li>';
				else				
					$output = $output . '<li class="page-item"><input type="submit" name="page" class="perpage-link page-link" value="'.$pages.'"/></li>';
			}
			
		}
		return $output;
	}
	
	function showperpage($sql, $per_page = 10, $href) {
	    require_once("../database.php");
	    $db_handle = new Koneksi();
	    $count   = $db_handle->numRows($sql);
		$perpage = perpage($count, $per_page,$href);
		return $perpage;
	}
