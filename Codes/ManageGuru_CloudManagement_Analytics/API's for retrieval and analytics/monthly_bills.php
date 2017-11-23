<html>
<head>
<title>monthly bills bargraphs</title>
<meta charset="utf-8">
<style>

    .bar {
      fill: steelblue;
    }

    .bar:hover {
      fill: brown;
    }

    .axis--x path {
      display: none;
    }

</style>

<script src="https://d3js.org/d3.v4.min.js"></script>
</head>

<body>

	<svg width="960" height="500"></svg>

<script>
        
<?php
extract( $_POST );

$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT extract(day from bill_time),count(*) from billing where extract(month from bill_time)=".$select." group by extract(day from bill_time)";

$result = $con->query($sql);

$names=array();
$vals=array();
$count=0;
$in1=0;
$in2=0;

if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 //echo $value." ";
             if($count++%2==1)
                 $vals[$in1++]=$value;
             else
                 $names[$in2++]=$value;
			}
    }
} 
else {
    echo "0 results";
}
$con->close();
?>
 
		var arr2 = <?php echo json_encode($vals); ?>;
        var arr1=<?php echo json_encode($names); ?>;
        
        
		var data = [];
        for(i=0;i<arr1.length;i++)
        {
            data.push({name:arr1[i],value:arr2[i]});
        }
        /*
        for(i=0;i<data.length;i++)
        document.writeln(data[i].name+" "+data[i].value)*/
    
        var svg = d3.select("svg"),
        margin = {top: 20, right: 20, bottom: 50, left: 50},
        width = +svg.attr("width") - margin.left - margin.right,
        height = +svg.attr("height") - margin.top - margin.bottom;
        
        var animateDuration = 700;
            var animateDelay = 30;
 
        var tooltip = d3.select('body').append('div')
                    .style('position', 'absolute')
                    .style('background', '#f4f4f4')
                    .style('padding', '5 15px')
                    .style('border', '1px #333 solid')
                    .style('border-radius', '5px')
                    .style('opacity', '0');


        var x = d3.scaleBand().rangeRound([0, width]).padding(0.1),
            y = d3.scaleLinear().rangeRound([height, 0]);

        var g = svg.append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


          x.domain(data.map(function(d) { return d.name; }));
          y.domain([0, d3.max(data, function(d) { return d.value; })]);

          g.append("g")
              .attr("class", "axis axis--x")
              .attr("transform", "translate(0," + height + ")")
              .call(d3.axisBottom(x));

           svg.append("text")
            .attr("transform", "translate(" + (width / 2) + " ," + (height + margin.bottom) + ")")
            .style("text-anchor", "middle")
            .text("Day");

          g.append("g")
              .attr("class", "axis axis--y")
              .call(d3.axisLeft(y).ticks(10));
            
            g.append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 0 - margin.left)
                .attr("x",0 - (height / 2))
                .attr("dy", "1em")
                .style("text-anchor", "middle")
                .text("Bills generated");

              g.selectAll(".bar")
                .data(data)
                .enter().append("rect")
                  .attr("class", "bar")
                  .attr("x", function(d) { return x(d.name); })
                  .attr("y", function(d) { return y(d.value); })
                  .attr("width", x.bandwidth())
                  .attr("height",0)
                  .transition()
                  .duration(700)
                  .delay(function (d,i){ return i * 30;})
                  .attr("height", function(d) { return height - y(d.value); });
      

				g.selectAll('rect')	
				.on('mouseover', function(d){
					tooltip.transition()
						.style('opacity', 1)

					tooltip.html(d.value)
						.style('left', (d3.event.pageX)+'px')
						.style('top', (d3.event.pageY+'px'))
				

				})
				.on('mouseout', function(d){
					tooltip.transition()
						.style('opacity', 0)
					
				})

	</script>
    
<div id='goback'><a href='monthly_bills.html'>back to query</a></div>
</body>
</html>