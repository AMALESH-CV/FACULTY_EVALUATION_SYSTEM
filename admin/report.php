
<?php $faculty_id = isset($_GET['fid']) ? $_GET['fid'] : '' ; ?>
<?php 
function ordinal_suffix($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}
?>
<div class="col-lg-12">
	<div class="callout callout-info">
		<div class="d-flex w-100 justify-content-center align-items-center">
			<label for="faculty">Select Faculty</label>
			<div class=" mx-2 col-md-4">
			<select name="" id="faculty_id" class="form-control form-control-sm select2">
				<option value=""></option>
				<?php 
				$faculty = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM faculty_list order by concat(firstname,' ',lastname) asc");
				$f_arr = array();
				$fname = array();
				while($row=$faculty->fetch_assoc()):
					$f_arr[$row['id']]= $row;
					$fname[$row['id']]= ucwords($row['name']);
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($faculty_id) && $faculty_id == $row['id'] ? "selected" : "" ?>><?php echo ucwords($row['name']) ?></option>
				<?php endwhile; ?>
			</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mb-1">
			<div class="d-flex justify-content-end w-100">
				<button class="btn btn-sm btn-success bg-gradient-success" style="display:none" id="print-btn"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="callout callout-info">
				<div class="list-group" id="class-list">
					
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="callout callout-info" id="printable">
			<div>
			<h3 class="text-center">Evaluation Report</h3>
			<hr>
			<table width="100%">
					<tr>
						<td width="50%"><p><b>Faculty: <span id="fname"></span></b></p></td>
						<td width="50%"><p><b>Academic Year: <span id="ay"><?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix($_SESSION['academic']['semester'])) ?> Semester</span></b></p></td>
					</tr>
					<tr>
						<td width="50%"><p><b>Class: <span id="classField"></span></b></p></td>
						<td width="50%"><p><b>Subject: <span id="subjectField"></span></b></p></td>
					</tr>
			</table>
				
			</div>





<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "evaluation_db");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get tables from database
$tables_query = "SHOW TABLES WHERE Tables_in_evaluation_db IN ('teaching_hours', 'add_on_teaching', 'innovative_teaching', 'syllabus_enrichment')";

// Execute query
$tables_result = $conn->query($tables_query);

// Check if query was successful
if ($tables_result) {
  // Loop through tables and display them
  while ($table_row = $tables_result->fetch_array()) {
    $table_name = $table_row[0];
    // Query to get table columns
    $columns_query = "SHOW COLUMNS FROM $table_name";
    $columns_result = $conn->query($columns_query);
    // Build table HTML
    $table_html = '<table>';
    $table_html .= '<tr><th colspan="' . $columns_result->num_rows . '">' . $table_name . '</th></tr>';
    $table_html .= '<tr>';
    while ($column_row = $columns_result->fetch_array()) {
      $table_html .= '<th>' . $column_row[0] . '</th>';
    }
    $table_html .= '</tr>';
    // Query to get table data
    $data_query = "SELECT * FROM $table_name";
    $data_result = $conn->query($data_query);
    while ($data_row = $data_result->fetch_array()) {
      $table_html .= '<tr>';
      for ($i = 0; $i < $data_result->field_count; $i++) {
        $table_html .= '<td>' . $data_row[$i] . '</td>';
      }
      $table_html .= '</tr>';
    }
    $table_html .= '</table>';
    // Display table HTML
    echo '<div class="col-md-12">';
    echo '<div class="callout callout-info">';
    echo $table_html;
    echo '</div>';
    echo '</div>';
  }
} else {
  // Display error message if query failed
  echo 'Error getting tables from database: ' . $conn->error;
}

// Close database connection
$conn->close();
?>



			
					
			</div>
		</div>
	</div>
</div>
<style>
	.list-group-item:hover{
		color: black !important;
		font-weight: 700 !important;
	}
</style>
<noscript>
	<style>
		table{
			width:100%;
			border-collapse: collapse;
		}
		table.wborder tr,table.wborder td,table.wborder th{
			border:1px solid gray;
			padding: 3px
		}
		table.wborder thead tr{
			background: #6c757d linear-gradient(180deg,#828a91,#6c757d) repeat-x!important;
    		color: #fff;
		}
		.text-center{
			text-align:center;
		} 
		.text-right{
			text-align:right;
		} 
		.text-left{
			text-align:left;
		} 
	</style>
</noscript>
<script>
	$(document).ready(function(){
		$('#faculty_id').change(function(){
			if($(this).val() > 0)
			window.history.pushState({}, null, './index.php?page=report&fid='+$(this).val());
			load_class()
		})
		if($('#faculty_id').val() > 0)
			load_class()
	})
	function load_class(){
		start_load()
		var fname = <?php echo json_encode($fname) ?>;
		$('#fname').text(fname[$('#faculty_id').val()])
		$.ajax({
			url:"ajax.php?action=get_class",
			method:'POST',
			data:{fid:$('#faculty_id').val()},
			error:function(err){
				console.log(err)
				alert_toast("An error occured",'error')
				end_load()
			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(Object.keys(resp).length <= 0 ){
						$('#class-list').html('<a href="javascript:void(0)" class="list-group-item list-group-item-action disabled">No data to be display.</a>')
					}else{
						$('#class-list').html('')
						Object.keys(resp).map(k=>{
						$('#class-list').append('<a href="javascript:void(0)" data-json=\''+JSON.stringify(resp[k])+'\' data-id="'+resp[k].id+'" class="list-group-item list-group-item-action show-result">'+resp[k].class+' - '+resp[k].subj+'</a>')
						})

					}
				}
			},
			complete:function(){
				end_load()
				anchor_func()
				if('<?php echo isset($_GET['rid']) ?>' == 1){
					$('.show-result[data-id="<?php echo isset($_GET['rid']) ? $_GET['rid'] : '' ?>"]').trigger('click')
				}else{
					$('.show-result').first().trigger('click')
				}
			}
		})
	}
	function anchor_func(){
		$('.show-result').click(function(){
			var vars = [], hash;
			var data = $(this).attr('data-json')
				data = JSON.parse(data)
			var _href = location.href.slice(window.location.href.indexOf('?') + 1).split('&');
			for(var i = 0; i < _href.length; i++)
				{
					hash = _href[i].split('=');
					vars[hash[0]] = hash[1];
				}
			window.history.pushState({}, null, './index.php?page=report&fid='+vars.fid+'&rid='+data.id);
			load_report(vars.fid,data.sid,data.id);
			$('#subjectField').text(data.subj)
			$('#classField').text(data.class)
			$('.show-result.active').removeClass('active')
			$(this).addClass('active')
		})
	}
	function load_report($faculty_id, $subject_id,$class_id){
		if($('#preloader2').length <= 0)
		start_load()
		$.ajax({
			url:'ajax.php?action=get_report',
			method:"POST",
			data:{faculty_id: $faculty_id,subject_id:$subject_id,class_id:$class_id},
			error:function(err){
				console.log(err)
				alert_toast("An Error Occured.","error");
				end_load()
			},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					if(Object.keys(resp).length <= 0){
						$('.rates').text('')
						$('#tse').text('')
						$('#print-btn').hide()
					}else{
						$('#print-btn').show()
						$('#tse').text(resp.tse)
						$('.rates').text('-')
						var data = resp.data
						Object.keys(data).map(q=>{
							Object.keys(data[q]).map(r=>{
								console.log($('.rate_'+r+'_'+q),data[q][r])
								$('.rate_'+r+'_'+q).text(data[q][r]+'%')
							})
						})
					}
					
				}
			},
			complete:function(){
				end_load()
			}
		})
	}
	$('#print-btn').click(function(){
		start_load()
		var ns =$('noscript').clone()
		var content = $('#printable').html()
		ns.append(content)
		var nw = window.open("Report","_blank","width=900,height=700")
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)
	})
</script>