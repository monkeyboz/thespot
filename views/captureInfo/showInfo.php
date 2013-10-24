<?php $i = $this->info[0]; ?>
<script>
	$.jqplot.config.enablePlugins = true;
</script>
<style>
	.dataHolder{
		padding: 10px;
		border-bottom: 1px solid #efefef;
	}
	.dataHolder .label{
		float: left; 
		width: 200px;
		font-weight: bold;
	}
	.bottom{
		clear: both;
	}
	.graph{
		height: 100px;
		float: right;
	}
</style>
<h1>Report for <?php echo ucfirst($i['county']).' County '.ucfirst($i['state']); ?> | <?php echo $i['city']; ?></h1>
<div style="width: 500px; float: left;">
	<div class="dataHolder">
		<div class="label">Mortality Rate:</div><?php echo $i['mortality']; ?>
		<div class="bottom"></div>
	</div>
	<div class="dataHolder">
		<div class="label">Confidence Interval:</div><?php echo $i['intervals']; ?>
		<div class="bottom"></div>
	</div>
	<div class="dataHolder">
		<div class="label">Number of Deaths:</div><?php echo $i['deaths']; ?>
		<div class="bottom"></div>
	</div>
	<div class="bottom"></div>
</div>
<div style="float: left; width: 450px;">
	<div id="graph"></div>
</div>
<div class="bottom"></div>
<script>
	line1=[<?php echo $this->dates; ?>]
	plot9 = $.jqplot('graph', [line1], {
	    axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer}},
	    series: [
	     	    {label:'Death Rates'},
		],
	    seriesDefaults: {
			marks: true,
			showMarker: true,
			showLine: true,
			shadow: false,
			lineWidth: 4,
			markerOptions: {shadow:false}
	    },
	    cursor: {
	        showVerticalLine: true,
	        showHorizontalLine: false,
	        showCursorLegend: true,
	        showTooltip: true,
	        zoom: true,
	        dblClickReset: true,
	        intersectionThreshold: 6
	      },
	});
</script>