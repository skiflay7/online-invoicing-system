<?php
// This script and data application were generated by AppGini 6.0
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include_once("{$currDir}/lib.php");
	@include_once("{$currDir}/hooks/items.php");
	include_once("{$currDir}/items_dml.php");

	// mm: can the current member access this page?
	$perm = getTablePermissions('items');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'items';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`items`.`id`" => "id",
		"`items`.`item_description`" => "item_description",
		"`items`.`unit_price`" => "unit_price",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`items`.`id`',
		2 => 2,
		3 => '`items`.`unit_price`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`items`.`id`" => "id",
		"`items`.`item_description`" => "item_description",
		"`items`.`unit_price`" => "unit_price",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`items`.`id`" => "ID",
		"`items`.`item_description`" => "Item Description",
		"`items`.`unit_price`" => "Unit price",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`items`.`id`" => "id",
		"`items`.`item_description`" => "item_description",
		"`items`.`unit_price`" => "unit_price",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`items` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'items_view.php';
	$x->RedirectAfterInsert = 'items_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Items';
	$x->TableIcon = 'resources/table_icons/installer_box.png';
	$x->PrimaryKey = '`items`.`id`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 80, ];
	$x->ColCaption = ['Item Description', 'Unit price', ];
	$x->ColFieldName = ['item_description', 'unit_price', ];
	$x->ColNumber  = [2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/items_templateTV.html';
	$x->SelectedTemplate = 'templates/items_templateTVS.html';
	$x->TemplateDV = 'templates/items_templateDV.html';
	$x->TemplateDVP = 'templates/items_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: items_init
	$render = true;
	if(function_exists('items_init')) {
		$args = [];
		$render = items_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: items_header
	$headerCode = '';
	if(function_exists('items_header')) {
		$args = [];
		$headerCode = items_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once("{$currDir}/header.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/header.php");
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: items_footer
	$footerCode = '';
	if(function_exists('items_footer')) {
		$args = [];
		$footerCode = items_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once("{$currDir}/footer.php"); 
	} else {
		ob_start();
		include_once("{$currDir}/footer.php");
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
