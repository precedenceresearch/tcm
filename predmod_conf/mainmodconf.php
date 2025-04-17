<?php 
class prdcls {
	
    function GetPredReport($no=5)
	{		
		global $db,$dbprefix;
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT newsId, SUBSTRING(meta_title,1,60) as meta_title, SUBSTRING(newsLDesc,1,100) as shortd, newsDate,CatId FROM ".$dbprefix."reports WHERE popular=0 order by newsId DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		while($row = mysqli_fetch_array($result)){
			$op[$row['newsId']] = array(
				'meta_title' => $row['meta_title'],
				'shortd' => $row['shortd'],
				'CatId' => $row['CatId'],
				'newsDate' => $row['newsDate'],
				'newsId' => $row['newsId']
				);	
		}
		return $op;
	}
	
	function CatsReportsList($pagno,$catid)
	{		
		global $db,$dbprefix;
		$end = 15; $start = ($pagno*$end)-$end;
		mysqli_query($db,"SET NAMES utf8");
		$sqlqry = "SELECT newsId, newsSubject, SUBSTRING(newsLDesc,1,350) as newsLDescnew, newsDate, Price_SUL, No_Pages,CustomName FROM ".$dbprefix."reports WHERE CatId=$catid order by newsId DESC limit $start,$end";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		while($row = mysqli_fetch_array($result)){
			$op[$row['newsId']] = array(
				'newsSubject' => $row['newsSubject'],
				'newsLDescnew' => $row['newsLDescnew'],
				'newsDate' => $row['newsDate'],
				'Price_SUL' => $row['Price_SUL'],
				'No_Pages' => $row['No_Pages'],
				'CustomName' => $row['CustomName'],
				'newsId' => $row['newsId']
				);	
		}
		return $op;
	}
	
	function GetPopReports($no=4)
	{		
		global $db,$dbprefix;
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT newsId, newsSubject, SUBSTRING(newsLDesc,1,350) as newsLDescnew, newsDate, Price_SUL, No_Pages,CustomName FROM ".$dbprefix."reports WHERE popular=1 order by newsId DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['newsId']] = array(
				'newsSubject' => $row['newsSubject'],
				'newsLDescnew' => $row['newsLDescnew'],
				'newsDate' => $row['newsDate'],
				'Price_SUL' => $row['Price_SUL'],
				'No_Pages' => $row['No_Pages'],
				'CustomName' => $row['CustomName'],
				'newsId' => $row['newsId']
				);	
		}
		return $op;
	}
	
	function CatCounts($cid){
		global $db,$dbprefix;
		$sql = "select count(newsId) as ttl from ".$dbprefix."reports where IsActive=1 and CatId=$cid";
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['ttl'];
	}
	
	function LCounts(){
		global $db,$dbprefix;
		$sql = "select count(newsId) as ttl from ".$dbprefix."reports where IsActive=1";
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['ttl'];
	}
	
	function CatThumb($catid){
		global $db,$dbprefix;
		$sql = "select CatImg from ".$dbprefix."category where catId=$catid and IsActive=1";
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['CatImg'];
	}
	
	function GetPredLst($pagno)
	{		
		global $db,$dbprefix;
		$dates = date('Y-m-d');
		$end = 15; $start = ($pagno*$end)-$end;
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT newsId,CatId, newsSubject, SUBSTRING(newsLDesc,1,350) as newsLDescnew, newsDate, Price_SUL, No_Pages,CustomName FROM ".$dbprefix."reports WHERE 1 order by newsId DESC limit $start,$end";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['newsId']] = array(
				'newsSubject' => $row['newsSubject'],
				'newsLDescnew' => $row['newsLDescnew'],
				'newsDate' => $row['newsDate'],
				'Price_SUL' => $row['Price_SUL'],
				'No_Pages' => $row['No_Pages'],
				'CatId' => $row['CatId'],
				'CustomName' => $row['CustomName'],
				'newsId' => $row['newsId']
				);	
		}
		return $op;
	}
	
	function GetPopNews($no=4)
	{		
		global $db,$dbprefix;
		$dates = date('Y-m-d');
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT id,pub_date, SUBSTRING(view_desc,1,150) as descrip, title, CustomName FROM ".$dbprefix."news WHERE 1 order by id DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['id']] = array(
				'pub_date' => $row['pub_date'],
				'descrip' => $row['descrip'],
				'title' => $row['title'],
				'CustomName' => $row['CustomName'],
				'id' => $row['id']
				);	
		}
		return $op;
	}
	
	function GetCats()
	{		
		global $db,$dbprefix;
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT catId,catName,CatImg,SUBSTRING(catDesc,1,150) as catDesc,CustomName FROM ".$dbprefix."category WHERE IsActive=1 order by catId DESC";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['catId']] = array(
				'catName' => $row['catName'],
				'catDesc' => $row['catDesc'],
				'CustomName' => $row['CustomName'],
				'CatImg' => $row['CatImg'],
				'catId' => $row['catId']
				);	
		}
		return $op;
	}
	
	function GetCtryList()
	{		
		global $db,$dbprefix;
		$dates = date('Y-m-d');
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT id,name,ccode FROM ".$dbprefix."countries WHERE 1 order by name asc";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['id']] = array(
				'name' => $row['name'],
				'ccode' => $row['ccode'],
				'id' => $row['id']
				);	
		}
		return $op;
	}
	
	function GetPreNews($no=2)
	{		
		global $db,$dbprefix;
		$dates = date('Y-m-d');
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT id,pub_date, SUBSTRING(view_desc,1,150) as descrip, title, CustomName FROM ".$dbprefix."news WHERE 1 order by id DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['id']] = array(
				'pub_date' => $row['pub_date'],
				'descrip' => $row['descrip'],
				'title' => $row['title'],
				'CustomName' => $row['CustomName'],
				'id' => $row['id']
				);	
		}
		return $op;
	}
	
	function GetPRNews($no=25)
	{		
		global $db,$dbprefix;
		$dates = date('Y-m-d');
		mysqli_query($db,"SET NAMES utf8");	
		$sqlqry = "SELECT id,pub_date, SUBSTRING(view_desc,1,150) as descrip, title, CustomName FROM ".$dbprefix."news WHERE 1 and IsActive=1 order by id DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));
		 while($row = mysqli_fetch_array($result)){
			$op[$row['id']] = array(
				'pub_date' => $row['pub_date'],
				'descrip' => $row['descrip'],
				'title' => $row['title'],
				'CustomName' => $row['CustomName'],
				'id' => $row['id']
				);	
		}
		return $op;
	}
	
	function newsTotalCount() {
		global $db,$dbprefix;
		$sql = "select count(id) as totalnews from ".$dbprefix."news where IsActive=1";
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['totalnews'];
	}
     
    function GetPNews($newsid) { 
		global $db,$dbprefix;
		$newsArr = Array();
		if($newsid) {
			mysqli_query($db,"SET NAMES utf8");
			$sql = "SELECT id,title, DATE_FORMAT(pub_date ,'%b %y') as newdate,CustomName, view_desc,prmetatitle,prmetadesc,prmetakeywords FROM ".$dbprefix."news WHERE CustomName = '".$newsid."'";
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result);
			$newsArr = $row;
		}
		return $newsArr;		
     }
	 
	 function CatIdDetails($cslug) { 
		global $db,$dbprefix;
		$newsArr = Array();
		if($cslug){
			mysqli_query($db,"SET NAMES utf8");
			$sql = "SELECT catId,catName FROM ".$dbprefix."category WHERE CustomName = '".$cslug."'";
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result);
			$newsArr = $row;
		}
		return $newsArr;		
     }
	 
	function GetTotalReportsLatest(){  
		global $db,$dbprefix;
		$sql = "select count(*) as total from ".$dbprefix."reports where IsActive=1";
	    $result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['total'];
    }
	
    function getLatestPressRelease($no=4)
	{		
		global $db,$dbprefix;
		mysqli_query($db,"SET NAMES utf8");		 
		$sqlqry = "SELECT id, title, SUBSTRING(view_desc,1,350) as pressLDescnew, pub_date,CustomName FROM ".$dbprefix."news WHERE IsActive=1 order by pub_date DESC limit 0,$no";
		$result = mysqli_query($db,$sqlqry) or die(mysqli_error($db));		
		 while($row = mysqli_fetch_array($result)){			
			 $data[$row['id']] = array(
				'title' => $row['title'],
				'pressLDescnew' => $row['pressLDescnew'],
				'pub_date' => $row['pub_date'],
				'CustomName' => $row['CustomName'],
				'id' => $row['id']
				);				 
			 }
		return $data;
    }
	
    function getSearchedAllReportsCount($searchKey)
    {
		global $db,$dbprefix;
		$sql = "SELECT count(newsId) as totalSearchReport FROM ".$dbprefix."reports where IsActive=1 AND newsSubject like '%".$searchKey."%'";
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		return $row['totalSearchReport'];
	}
	
    function getSearchedAllReports($searchKey){		
		 global $db,$dbprefix;
		 mysqli_query($db,"SET NAMES utf8");
		 $sql = "select newsId,No_Pages, newsSubject, SUBSTRING(newsLDesc,1,350) as newsLDescnew, newsDate,CustomName,CatId from ".$dbprefix."reports where IsActive=1 AND newsSubject like '%".$searchKey."%' order by newsId desc";
		 $sql.=" limit 0,30";
		 
	     $result = mysqli_query($db,$sql) or die(mysqli_error($db));
			
		while($row = mysqli_fetch_array($result)){			
		 $data[$row['newsId']] = array(
			'newsSubject' => $row['newsSubject'],
			'newsLDescnew' => $row['newsLDescnew'],
			'newsDate' => $row['newsDate'],
			'No_Pages' => $row['No_Pages'],
			'CustomName' => $row['CustomName'],
			'newsId' => $row['newsId'] 
			);				 
		 }
		 return $data;
    }	
        
	function prdsnk($newsId){
		global $db,$dbprefix,$prdurl;
		$sql = "select customName,newsId from ".$dbprefix."reports where IsActive=1 and newsId=".$newsId;
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		if(!empty($row)){
			$link=$prdurl.$row['customName'];
		}
		return $link;
	}
	
	function predplink($newsId)
	{
		global $db,$dbprefix,$prdurl;
		$sql = "select CustomName,id from ".$dbprefix."news where IsActive=1 and id=".$newsId;
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		if(!empty($row)){
			$link=$prdurl.'press-release/'.$row['CustomName'];
		}
		return $link;
	}
	
	function PreReport($reportid="") { 
		global $db,$dbprefix;
		$reportData = Array();
		if($reportid){
			mysqli_query($db,"SET NAMES utf8");
			$sql = "SELECT newsId, CatId, newsSubject,udelivery, newsLDesc, newsDate, Price_SUL, Price_CUL, Price_Multi, toc,No_Pages, meta_title, meta_description, meta_keywords FROM ".$dbprefix."reports where IsActive=1 and CustomName='$reportid'";	
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$reportData = mysqli_fetch_array($result);
		}
		return $reportData;
     }
	 
	 function PreReportID($reportid="") { 
		global $db,$dbprefix;
		$reportData = Array();
		if($reportid){
			mysqli_query($db,"SET NAMES utf8");
			$sql = "SELECT newsId, CatId, newsSubject,udelivery, newsLDesc, newsDate, Price_SUL, Price_CUL, Price_Multi,CustomName, toc,No_Pages, meta_title, meta_description, meta_keywords FROM ".$dbprefix."reports where IsActive=1 and newsId='$reportid'";	
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$reportData = mysqli_fetch_array($result);
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$reportData = mysqli_fetch_array($result);
		}
		return $reportData;
     }
	 
	 function getCatInfoById($catId="") {  
		global $db,$dbprefix;
		$catData = Array();
		if($catId) {
			$sql = "select catId, catName,CustomName,CatImg,cat_icon from ".$dbprefix."category where IsActive=1 and catId = $catId";
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result);
			//$catData[] = array();
			//$catData['catName'] = $row['catName'];
		}
		return $row;
	}
	
	function TocByRid($newsid) 
	{  
		global $db,$dbprefix;
		$TOC = 0;
		if($newsid) {
			$sql = "select TOC from ".$dbprefix."toc where newsId =".$newsid;
			$result = mysqli_query($db,$sql) or die(mysqli_error($db));
			$row = mysqli_fetch_array($result);			
			$TOC = $row['TOC'];			 
		}
		return $TOC;
	}	
	
    function seoString($str, $replace=array(), $delimiter='-') {
  	    if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
    	    }
	    $clean=$str;
	    $clean=preg_replace('/[^A-Za-z0-9\-]/', ' ', $clean); // Removes special chars.
	    $clean = strtolower(trim($clean, '-'));
	    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);    
	    return $clean;
    }
	  
	function Getcountrylist(){  
	global $db,$dbprefix;
	$sql = "select id,name,ccode from ".$dbprefix."countries where IsActive=1 order by name ASC";
	$result = mysqli_query($db,$sql) or die(mysqli_error($db));
	 while($row = mysqli_fetch_array($result)) {
		 $op[$row['id']] = array (
			'name' => $row['name'],
			'ccode' => $row['ccode'],
			'id' => $row['id']
			);                
		 }
		return $op;
	}

	function GetFAQ($rid){
		global $db,$dbprefix;
		$emptarry = array();
		$sql = "SELECT q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10 FROM predr_mrfaq WHERE rid=".$rid;
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$cntr = mysqli_num_rows($result);
		if($cntr>0){
			$row = mysqli_fetch_array($result);
			return $row;
		}else{ return $emptarry; }
	}
	
	function GetoneFAQ($rid){
		global $db,$dbprefix;
		$sql = "SELECT count(*) as cnt FROM predr_mrfaq WHERE rid=".$rid;
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$cntr = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		return $row['cnt'];
	}

    public function Paginate($per_page = 15, $page = 1, $url = '', $total){	
		$adjacents = 2;		
        $page = ($page == 0 ? 1 : $page); 
        $start = ($page - 1) * $per_page;                              
         
        $prev = $page - 1;        $next = $page + 1;
        $lastpage = ceil($total/$per_page);
        $lpm1 = $lastpage - 1;
         
        $paginationHtml = "";
		if($lastpage > 1)
		{  
		$paginationHtml .= "<nav aria-label='Page navigation example'><ul class='pagination'>";
		if($page > 1) {
		$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$prev'>«</a></li>";	
		} else {
		$paginationHtml.= "<li class='disabled page-item'>«</li>";
		}

		if ($lastpage < 5 + ($adjacents * 2))
		{  
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
			if ($counter == $page)
				$paginationHtml.= "<li class='activeli page-item'><a class='activepage btn_pagging'>$counter</a></li>";
			else
				$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$counter'>$counter</a></li>";                   
		}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
		if($page < 1 + ($adjacents * 2))    
		{
			for ($counter = 1; $counter < 2 + ($adjacents * 2); $counter++)
			{
				if ($counter == $page)
					$paginationHtml.= "<li class='activeli page-item'><a class='activepage btn_pagging'>$counter</a></li>";
				else
					$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$counter'>$counter</a></li>";                   
			}
			$paginationHtml.= "<li class='morepages page-item'>...</li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$lpm1'>$lpm1</a></li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$lastpage'>$lastpage</a></li>";     
		}
		elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
		{
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/1'>1</a></li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/2'>2</a></li>";
			$paginationHtml.= "<li class='morepages page-item'>...</li>";
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
			{
				if ($counter == $page)
					$paginationHtml.= "<li class='activeli page-item'><a class='activepage btn_pagging'>$counter</a></li>";
				else
					$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$counter'>$counter</a></li>";                   
			}
			$paginationHtml.= "<li class='morepages page-item'>..</li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$lpm1'>$lpm1</a></li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$lastpage'>$lastpage</a></li>";     
		}
		else
		{
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/1'>1</a></li>";
			$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/2'>2</a></li>";
			$paginationHtml.= "<li class='morepages page-item'>..</li>";
			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$paginationHtml.= "<li class='activeli page-item'><a class='activepage btn_pagging'>$counter</a></li>";
				else
					$paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$counter'>$counter</a></li>";                   
			}
		}
		}
             
            if ($page < $counter - 1){
                $paginationHtml.= "<li class='page-item'><a class='btn_pagging' href='{$url}/$next'>»</a></li>";
            }else{
            	
            }
            $paginationHtml.= "</ul></nav>\n";
        }
        return $paginationHtml;
    }	
}