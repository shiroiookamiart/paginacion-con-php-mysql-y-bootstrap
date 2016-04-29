<?php

class paginator 

{
	var $records;
	var $pages;
	var $recordsperpage;
	var $actual_page=1;
	var $url_page="";
	var $start_record;
	
	function paginator($records, $recordsperpage, $url_page = "") {
		$this->url_page = ($url_page)? $url_page : $this->make_request() ;
		$this->records=$records;
		$this->recordsperpage=$recordsperpage;
		
		if (isset($_REQUEST['pg'])){
			if ($_REQUEST['pg']) {
				$this->actual_page=$_REQUEST['pg'];
			}
		}
		
		if (isset($_GET['pg'])){
			if ($_GET['pg']) {
				$this->start_record=($_GET['pg'] * $recordsperpage) - $recordsperpage;
			}else {
				$this->start_record=0;
			}
		}
		$this->get_total_pages();
	}
	
	function make_request() {
        $output = "";
        foreach($_GET as $k => $v){
            if( $k != 'pg' ) {
				$sep = ($output)? '&' : '?';
				$output.= $sep.$this->urlToString($k, $v);
				
            }
        }
        return $output;
    }
    
    function urlToString($name,$val){
    	$arrReturn=array();
    	if(!is_array($val)){
    		$arrReturn[]="$name=$val";
    	}else{
    		$arrReturn=array();
    		foreach($val as $key=>$value){
    			$arrReturn[]=$name."[$key]=".$value;
    		}
    	}
    	return implode("&",$arrReturn);
    }
	
	function get_total_pages() {
		$total=(($this->records%$this->recordsperpage==0)? $this->records/$this->recordsperpage : floor($this->records/$this->recordsperpage) +1);
		$this->pages=$total;
		return $total;
	}
	
	function print_paginator($type="", $fisrtpage="&laquo;", $back_page="&lsaquo;", $next_page="&rsaquo;", $last_page="&raquo;" ) {
		
		$cad='<ul class="pagination">';

		$sep=((substr_count($this->url_page,"?")==0)? "?" : "&");
		if ($type=="") {
			$cad.=(($this->actual_page!=1)? "<li><a class=''  href='".$this->url_page.$sep."pg=1'>".$fisrtpage."</a></li> ": "");
			if ($this->url_page=="") {
				$cad.=(($this->actual_page!=1)? "<li><a class=''  href='?pg=".(($this->actual_page)-1)."'>".$back_page."</a> </li>": ""); 
				$linkc=$sep;
			}else {
				$cad.=(($this->actual_page!=1)? "<li><a class='' href='".$this->url_page.$sep."pg=".(($this->actual_page)-1)."'>".$back_page."</a> </li>": ""); 
				$linkc= $this->url_page.$sep;
			}
			if ($this->pages>5) {
				if ($this->actual_page<=2) {
					$inicio=1;
					$fin=5;
				} else {
					$inicio=$this->actual_page-2;
					if (($this->actual_page+2)<$this->pages) {
						$fin=$this->actual_page+2;
					}else {
						$fin=$this->pages;
					}
				}
			} else {
				$inicio=1;
				$fin=$this->pages;
			}
			for($i=$inicio;$i<=$fin; $i++) {
				$link= $linkc . "pg=" . $i ;
				if ($i==$this->actual_page) {
					$cad.="<li><a href='#' class='active'>". $i ."</a></li>";
				} else {
					$cad.= "<li><a href='$link' class=''>" . $i . "</a></li> ";
				}
			}
			if ($this->url_page=="") {
				$cad.=(($this->actual_page!=$this->pages)? "<li><a class=''  href='".$sep."pg=".(($this->actual_page)+1)."'>".$next_page."</a> </li>": "");
			}else {
				$cad.=(($this->actual_page!=$this->pages)? "<li><a class=''href='".$this->url_page.$sep."pg=".(($this->actual_page)+1)."'>".$next_page."</a> </li>": ""); 
			}
			$cad.=(($this->actual_page!=$this->pages)? "<li><a class='' href='".$this->url_page.$sep."pg=".($this->pages)."'>".$last_page."</a> </li>": "");
			if ($this->pages>1) {
				echo $cad;
			}
		}elseif($type="pulldown"){
			$inicio=1;
			$fin=$this->pages;
			if ($this->pages>1){
				echo "	<script>
							function nextpage(page){
								location.href='".$this->url_page.$sep."pg='+page;
							}
						</script>";
				echo "<select name='pg' onchange='nextpage(this[this.selectedIndex].value)'>";
				for($i=$inicio;$i<=$fin; $i++) {
					$s=($i==$this->actual_page)?"Selected":"";
					echo "<option value='".$i."'".$s.">".$i."</option>";
				}	
				echo "</select>";	
			}
		}

		$cad.='</ul>';
	}
	
	function print_page_counter($labelpage="Page", $labelof="of") {
		if ($this->pages>1) {
			echo "<span class='paginator_counter'>".$labelpage. " " . $this->actual_page . " ". $labelof. " " . $this->pages."</span>";
		}
	}
}

?>
