<?php $this->load->view("header");?>
<?php 
$decode_format = json_decode($response); 
$encode_format = json_encode($decode_format->prices);
?> 
<script>
$(document).ready(function () {
    $('#example').DataTable( {
    data: <?php print_r($encode_format); ?>,
    columns: [
        {   data: 'date',
            render: function (data, type, row) {//data
            return moment(row.updatedDate).format('YYYY/MM/DD hh:mm:ss');
    }},
        { data: 'open' },
        { data: 'high' },
        { data: 'low' },
        { data: 'close' },
        { data: 'volume' }

    ]
} );
});
</script>

<div class="container">
<?php if($this->session->flashdata('success')){ ?>
    <div class="alert alert-success">
    <?php echo $this->session->flashdata('success'); ?></div> 
<?php } ?>
 <a href="<?php echo $this->config->item('base_url'); ?>">Back</a>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>            
        </tbody>
    </table>
</div>


    <script type="text/javascript">
window.onload = function() {

var options = {
	animationEnabled: true,
	exportEnabled: true,
	title: {
		text: "Stock Price"
	},
	axisX: {
		valueFormatString: "DD MMM",
        title: "Date"
    //    xValueType: "dateTime"
	},
	axisY: {
		title: "Price",
		prefix: "$"
	},
	data: [{
		type: "ohlc",
      	xValueFormatString: "DD MMM",
		yValueFormatString: "$##0.00",
		dataPoints: [

          <?php  foreach( $decode_format->prices as $record) { 
            $recordDate = $record->date;
            $year = DateTime::createFromFormat('U', $recordDate)->format("Y");
            $date = DateTime::createFromFormat('U', $recordDate)->format("d");
            $month = DateTime::createFromFormat('U', $recordDate)->format("m");
            $hr = DateTime::createFromFormat('U', $recordDate)->format("H");
            $minute = DateTime::createFromFormat('U', $recordDate)->format("i");
            $sec = DateTime::createFromFormat('U', $recordDate)->format("s");
            $timeformat = $year.','.$date.','.$month.','.$hr.','.$minute.','.$sec;
            ?>
             { x: new Date (<?php $timeformat ?>), y: [<?php echo $record->open; ?>, <?php echo $record->high; ?>, <?php echo $record->low; ?>, <?php echo $record->close; ?>] },
<?php } ?>
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);

}
</script>
    <div id="chartContainer" style="height: 300px; width: 100%;"></div>