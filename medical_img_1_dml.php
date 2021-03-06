<?php

// Data functions (insert, update, delete, form) for table medical_img_1

// This script and data application were generated by AppGini 5.82
// Download AppGini for free from https://bigprof.com/appgini/download/

function medical_img_1_insert() {
	global $Translation;

	// mm: can member insert record?
	$arrPerm = getTablePermissions('medical_img_1');
	if(!$arrPerm[1]) return false;

	$data = array();
	$data['description'] = br2nl($_REQUEST['description']);
	$data['image'] = PrepareUploadedFile('image', 102400,'jpg|jpeg|gif|png', false, '');
	if($data['image']) createThumbnail($data['image'], getThumbnailSpecs('medical_img_1', 'image', 'tv'));
	if($data['image']) createThumbnail($data['image'], getThumbnailSpecs('medical_img_1', 'image', 'dv'));

	/* for empty upload fields, when saving a copy of an existing record, copy the original upload field */
	if($_REQUEST['SelectedID']) {
		$res = sql("select * from medical_img_1 where id='" . makeSafe($_REQUEST['SelectedID']) . "'", $eo);
		if($row = db_fetch_assoc($res)) {
			if(!$data['image']) $data['image'] = $row['image'];
		}
	}

	// hook: medical_img_1_before_insert
	if(function_exists('medical_img_1_before_insert')) {
		$args = array();
		if(!medical_img_1_before_insert($data, getMemberInfo(), $args)) { return false; }
	}

	$error = '';
	// set empty fields to NULL
	$data = array_map(function($v) { return ($v === '' ? NULL : $v); }, $data);
	insert('medical_img_1', backtick_keys_once($data), $error);
	if($error)
		die("{$error}<br><a href=\"#\" onclick=\"history.go(-1);\">{$Translation['< back']}</a>");

	$recID = db_insert_id(db_link());

	// automatic patient if passed as filterer
	if($_REQUEST['filterer_patient']) {
		sql("update `medical_img_1` set `patient`='" . makeSafe($_REQUEST['filterer_patient']) . "' where `id`='" . makeSafe($recID, false) . "'", $eo);
	}

	// hook: medical_img_1_after_insert
	if(function_exists('medical_img_1_after_insert')) {
		$res = sql("select * from `medical_img_1` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!medical_img_1_after_insert($data, getMemberInfo(), $args)) { return $recID; }
	}

	// mm: save ownership data
	set_record_owner('medical_img_1', $recID, getLoggedMemberID());

	// if this record is a copy of another record, copy children if applicable
	if(!empty($_REQUEST['SelectedID'])) medical_img_1_copy_children($recID, $_REQUEST['SelectedID']);

	return $recID;
}

function medical_img_1_copy_children($destination_id, $source_id) {
	global $Translation;
	$requests = array(); // array of curl handlers for launching insert requests
	$eo = array('silentErrors' => true);
	$uploads_dir = realpath(dirname(__FILE__) . '/../' . $Translation['ImageFolder']);
	$safe_sid = makeSafe($source_id);

	// launch requests, asynchronously
	curl_batch($requests);
}

function medical_img_1_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false) {
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('medical_img_1');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='medical_img_1' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='medical_img_1' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: medical_img_1_before_delete
	if(function_exists('medical_img_1_before_delete')) {
		$args=array();
		if(!medical_img_1_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `medical_img_1` where `id`='$selected_id'", $eo);

	// hook: medical_img_1_after_delete
	if(function_exists('medical_img_1_after_delete')) {
		$args=array();
		medical_img_1_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='medical_img_1' and pkValue='$selected_id'", $eo);
}

function medical_img_1_update($selected_id) {
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('medical_img_1');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='medical_img_1' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='medical_img_1' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) { // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['description'] = br2nl(makeSafe($_REQUEST['description']));
	$data['selectedID'] = makeSafe($selected_id);
	if($_REQUEST['image_remove'] == 1) {
		$data['image'] = '';
	} else {
		$data['image'] = PrepareUploadedFile('image', 102400, 'jpg|jpeg|gif|png', false, "");
		if($data['image']) createThumbnail($data['image'], getThumbnailSpecs('medical_img_1', 'image', 'tv'));
		if($data['image']) createThumbnail($data['image'], getThumbnailSpecs('medical_img_1', 'image', 'dv'));
	}

	// hook: medical_img_1_before_update
	if(function_exists('medical_img_1_before_update')) {
		$args = array();
		if(!medical_img_1_before_update($data, getMemberInfo(), $args)) { return false; }
	}

	$o = array('silentErrors' => true);
	sql('update `medical_img_1` set       ' . ($data['image']!='' ? "`image`='{$data['image']}'" : ($_REQUEST['image_remove'] != 1 ? '`image`=`image`' : '`image`=NULL')) . ', `description`=' . (($data['description'] !== '' && $data['description'] !== NULL) ? "'{$data['description']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!='') {
		echo $o['error'];
		echo '<a href="medical_img_1_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: medical_img_1_after_update
	if(function_exists('medical_img_1_after_update')) {
		$res = sql("SELECT * FROM `medical_img_1` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)) {
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!medical_img_1_after_update($data, getMemberInfo(), $args)) { return; }
	}

	// mm: update ownership data
	sql("update `membership_userrecords` set `dateUpdated`='" . time() . "' where `tableName`='medical_img_1' and `pkValue`='" . makeSafe($selected_id) . "'", $eo);

}

function medical_img_1_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = '') {
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('medical_img_1');
	if(!$arrPerm[1] && $selected_id=='') { return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != '') {
		$dvprint = true;
	}

	$filterer_patient = thisOr(undo_magic_quotes($_REQUEST['filterer_patient']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: patient
	$combo_patient = new DataCombo;

	if($selected_id) {
		// mm: check member permissions
		if(!$arrPerm[2]) {
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='medical_img_1' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='medical_img_1' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID) {
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID) {
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3) {
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("SELECT * FROM `medical_img_1` WHERE `id`='" . makeSafe($selected_id) . "'", $eo);
		if(!($row = db_fetch_array($res))) {
			return error_message($Translation['No records found'], 'medical_img_1_view.php', false);
		}
		$combo_patient->SelectedData = $row['patient'];
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	} else {
		$combo_patient->SelectedData = $filterer_patient;
	}
	$combo_patient->HTML = '<span id="patient-container' . $rnd1 . '"></span><input type="hidden" name="patient" id="patient' . $rnd1 . '" value="' . html_attr($combo_patient->SelectedData) . '">';
	$combo_patient->MatchText = '<span id="patient-container-readonly' . $rnd1 . '"></span><input type="hidden" name="patient" id="patient' . $rnd1 . '" value="' . html_attr($combo_patient->SelectedData) . '">';

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_patient__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['patient'] : $filterer_patient); ?>"};

		jQuery(function() {
			setTimeout(function() {
				if(typeof(patient_reload__RAND__) == 'function') patient_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function patient_reload__RAND__() {
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint) { ?>

			$j("#patient-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c) {
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_patient__RAND__.value, t: 'medical_img_1', f: 'patient' },
						success: function(resp) {
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="patient"]').val(resp.results[0].id);
							$j('[id=patient-container-readonly__RAND__]').html('<span id="patient-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=patients_view_parent]').hide(); }else{ $j('.btn[id=patients_view_parent]').show(); }


							if(typeof(patient_update_autofills__RAND__) == 'function') patient_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term) { /* */ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 5,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page) { /* */ return { s: term, p: page, t: 'medical_img_1', f: 'patient' }; },
					results: function(resp, page) { /* */ return resp; }
				},
				escapeMarkup: function(str) { /* */ return str; }
			}).on('change', function(e) {
				AppGini.current_patient__RAND__.value = e.added.id;
				AppGini.current_patient__RAND__.text = e.added.text;
				$j('[name="patient"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=patients_view_parent]').hide(); }else{ $j('.btn[id=patients_view_parent]').show(); }


				if(typeof(patient_update_autofills__RAND__) == 'function') patient_update_autofills__RAND__();
			});

			if(!$j("#patient-container__RAND__").length) {
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_patient__RAND__.value, t: 'medical_img_1', f: 'patient' },
					success: function(resp) {
						$j('[name="patient"]').val(resp.results[0].id);
						$j('[id=patient-container-readonly__RAND__]').html('<span id="patient-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=patients_view_parent]').hide(); }else{ $j('.btn[id=patients_view_parent]').show(); }

						if(typeof(patient_update_autofills__RAND__) == 'function') patient_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_patient__RAND__.value, t: 'medical_img_1', f: 'patient' },
				success: function(resp) {
					$j('[id=patient-container__RAND__], [id=patient-container-readonly__RAND__]').html('<span id="patient-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>') { $j('.btn[id=patients_view_parent]').hide(); }else{ $j('.btn[id=patients_view_parent]').show(); }

					if(typeof(patient_update_autofills__RAND__) == 'function') patient_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint) {
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/medical_img_1_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/medical_img_1_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Patient document details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert) {
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return medical_img_1_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return medical_img_1_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']) {
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id) {
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$j(\'form\').eq(0).prop(\'novalidate\', true); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate) {
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return medical_img_1_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3) { // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)) {
		$jsReadOnly .= "\tjQuery('#image').replaceWith('<div class=\"form-control-static\" id=\"image\">' + (jQuery('#image').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#description').replaceWith('<div class=\"form-control-static\" id=\"description\">' + (jQuery('#description').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert) {
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(patient)%%>', $combo_patient->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(patient)%%>', $combo_patient->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(patient)%%>', urlencode($combo_patient->MatchText), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array('patient' => array('patients', 'Patient'), );
	foreach($lookup_fields as $luf => $ptfc) {
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']) {
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']) {
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(patient)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(image)%%>', ($noUploads ? '' : "<div>{$Translation['upload image']}</div>" . '<i class="glyphicon glyphicon-remove text-danger clear-upload hidden"></i> <input type="file" name="image" id="image" data-filetypes="jpg|jpeg|gif|png" data-maxsize="102400">'), $templateCode);
	if($AllowUpdate && $row['image'] != '') {
		$templateCode = str_replace('<%%REMOVEFILE(image)%%>', '<br><input type="checkbox" name="image_remove" id="image_remove" value="1"> <label for="image_remove" style="color: red; font-weight: bold;">'.$Translation['remove image'].'</label>', $templateCode);
	}else{
		$templateCode = str_replace('<%%REMOVEFILE(image)%%>', '', $templateCode);
	}
	$templateCode = str_replace('<%%UPLOADFILE(description)%%>', '', $templateCode);

	// process values
	if($selected_id) {
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode = str_replace('<%%VALUE(patient)%%>', safe_html($urow['patient']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(patient)%%>', urlencode($urow['patient']), $templateCode);
		$row['image'] = ($row['image'] != '' ? $row['image'] : 'blank.gif');
		if( $dvprint) $templateCode = str_replace('<%%VALUE(image)%%>', safe_html($urow['image']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(image)%%>', html_attr($row['image']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(image)%%>', urlencode($urow['image']), $templateCode);
		if($dvprint || (!$AllowUpdate && !$AllowInsert)) {
			$templateCode = str_replace('<%%VALUE(description)%%>', safe_html($urow['description']), $templateCode);
		}else{
			$templateCode = str_replace('<%%VALUE(description)%%>', html_attr($row['description']), $templateCode);
		}
		$templateCode = str_replace('<%%URLVALUE(description)%%>', urlencode($urow['description']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(patient)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(patient)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(image)%%>', 'blank.gif', $templateCode);
		$templateCode = str_replace('<%%VALUE(description)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(description)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans) {
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == '') {
		$templateCode .= "\n\n<script>\$j(function() {\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption) {
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id) {
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields
	if( $_REQUEST['FilterField'][1]=='2' && $_REQUEST['FilterOperator'][1]=='<=>') {
		$templateCode.="\n<input type=hidden name=patient value=\"" . html_attr((get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]))."\">\n";
	}

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('medical_img_1');
	if($selected_id) {
		$jdata = get_joined_record('medical_img_1', $selected_id);
		if($jdata === false) $jdata = get_defaults('medical_img_1');
		$rdata = $row;
	}
	$templateCode .= loadView('medical_img_1-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: medical_img_1_dv
	if(function_exists('medical_img_1_dv')) {
		$args=array();
		medical_img_1_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>