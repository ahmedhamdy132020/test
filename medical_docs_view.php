<?php
// This script and data application were generated by AppGini 5.82
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/medical_docs.php");
	include("$currDir/medical_docs_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('medical_docs');
	if(!$perm[0]) {
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "medical_docs";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(
		"`medical_docs`.`id`" => "id",
		"IF(    CHAR_LENGTH(`patients1`.`last_name`) || CHAR_LENGTH(`patients1`.`first_name`), CONCAT_WS('',   `patients1`.`last_name`, ', ', `patients1`.`first_name`), '') /* Patient */" => "patient",
		"`medical_docs`.`doc`" => "doc",
		"`medical_docs`.`description`" => "description",
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(
		1 => '`medical_docs`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(
		"`medical_docs`.`id`" => "id",
		"IF(    CHAR_LENGTH(`patients1`.`last_name`) || CHAR_LENGTH(`patients1`.`first_name`), CONCAT_WS('',   `patients1`.`last_name`, ', ', `patients1`.`first_name`), '') /* Patient */" => "patient",
		"`medical_docs`.`doc`" => "doc",
		"`medical_docs`.`description`" => "description",
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(
		"`medical_docs`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`patients1`.`last_name`) || CHAR_LENGTH(`patients1`.`first_name`), CONCAT_WS('',   `patients1`.`last_name`, ', ', `patients1`.`first_name`), '') /* Patient */" => "Patient",
		"`medical_docs`.`doc`" => "Doc",
		"`medical_docs`.`description`" => "Description",
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(
		"`medical_docs`.`id`" => "id",
		"IF(    CHAR_LENGTH(`patients1`.`last_name`) || CHAR_LENGTH(`patients1`.`first_name`), CONCAT_WS('',   `patients1`.`last_name`, ', ', `patients1`.`first_name`), '') /* Patient */" => "patient",
		"`medical_docs`.`doc`" => "doc",
		"`medical_docs`.`description`" => "description",
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array('patient' => 'Patient', );

	$x->QueryFrom = "`medical_docs` LEFT JOIN `patients` as patients1 ON `patients1`.`id`=`medical_docs`.`patient` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 0;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "medical_docs_view.php";
	$x->RedirectAfterInsert = "medical_docs_view.php?SelectedID=#ID#";
	$x->TableTitle = "Medical docs";
	$x->TableIcon = "resources/table_icons/active_sessions.png";
	$x->PrimaryKey = "`medical_docs`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth   = array(  150, 150, 150);
	$x->ColCaption = array("Patient", "Doc", "Description");
	$x->ColFieldName = array('patient', 'doc', 'description');
	$x->ColNumber  = array(2, 3, 4);

	// template paths below are based on the app main directory
	$x->Template = 'templates/medical_docs_templateTV.html';
	$x->SelectedTemplate = 'templates/medical_docs_templateTVS.html';
	$x->TemplateDV = 'templates/medical_docs_templateDV.html';
	$x->TemplateDVP = 'templates/medical_docs_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';
	$x->HasCalculatedFields = false;

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))) { $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])) { // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `medical_docs`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='medical_docs' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])) { // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `medical_docs`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='medical_docs' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3) { // view all
		// no further action
	}elseif($perm[2]==0) { // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`medical_docs`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: medical_docs_init
	$render=TRUE;
	if(function_exists('medical_docs_init')) {
		$args=array();
		$render=medical_docs_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: medical_docs_header
	$headerCode='';
	if(function_exists('medical_docs_header')) {
		$args=array();
		$headerCode=medical_docs_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode) {
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: medical_docs_footer
	$footerCode='';
	if(function_exists('medical_docs_footer')) {
		$args=array();
		$footerCode=medical_docs_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode) {
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>