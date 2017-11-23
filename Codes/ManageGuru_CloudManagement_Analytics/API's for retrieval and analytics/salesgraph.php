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

$sql = "SELECT date(bill_time),sum(amount) from billing  group by date(bill_time)";

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
        
var parseTime = d3.timeParse("%Y-%m-%d");
        
		var data = [];
        for(i=0;i<arr1.length;i++)
        {
            data.push({name:parseTime(arr1[i]),value:arr2[i]});
        }
        
        for(i=0;i<data.length;i++)
        document.writeln(data[i].name+" "+data[i].value)
    
var svg = d3.select("svg"),
    margin = {top: 20, right: 20, bottom: 30, left: 50},
    width = +svg.attr("width") - margin.left - margin.right,
    height = +svg.attr("height") - margin.top - margin.bottom,
    g = svg.append("g").attr("transform", "translate(" + margin.left + "," + margin.top + ")");



var x = d3.scaleTime()
    .rangeRound([0, width]);

var y = d3.scaleLinear()
    .rangeRound([height, 0]);

var line = d3.line()
    .x(function(d) { return x(d.name); })
    .y(function(d) { return y(d.value); });



  x.domain(d3.extent(data, function(d) { return d.name; }));
  y.domain(d3.extent(data, function(d) { return d.value; }));

  g.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x))
    .select(".domain")
      .remove();

  g.append("g")
      .call(d3.axisLeft(y))
    .append("text")
      .attr("fill", "#000")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", "0.71em")
      .attr("text-anchor", "end")
      .text("Price (Rs)");

  g.append("path")
      .datum(data)
      .attr("fill", "none")
      .attr("stroke", "steelblue")
      .attr("stroke-linejoin", "round")
      .attr("stroke-linecap", "round")
      .attr("stroke-width", 1.5)
      .attr("d", line);


	</script>
    

</body>
</html>