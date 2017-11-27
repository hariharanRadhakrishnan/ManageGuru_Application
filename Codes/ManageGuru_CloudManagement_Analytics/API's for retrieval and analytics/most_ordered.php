<html>
<head>
<meta charset="utf-8">
<style>


.arc text {
  font: 10px sans-serif;
  text-anchor: middle;
}

.arc path {
  stroke: #fff;
}
#tooltip {
    position: absolute;
    width: 50px;
    height: auto;
    padding: 10px;
    background-color: white;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.4);
    -mox-box-shadow: 4px 4px 4px 10px rgba(0, 0, 0, 0.4);
    box-shadow: 4px 4px 10px rbga(0, 0, 0, 0.4) pointer-events: none;
}
#tooltip.hidden {
    opacity: 0;
}
#tooltip p {
    margin: 0;
    font-family: sans-serif;
    font-size: 16px;
    line-height: 20px;
}
</style>
<script src="https://d3js.org/d3.v4.min.js"></script>
</head>
<body>

	<svg width="960" height="500"></svg>
    
    <div id="tooltip" class="hidden">
    <p><span id="value"></span></p>
    <p><span id="percent"></span>%</p>
</div>

<script>

<?php
 header("Access-Control-Allow-Origin: *");
$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql = "SELECT m.dish_name,count(*) FROM menu as m,orders as o WHERE m.dish_id=o.dish_id group by m.dish_name order by count(*) DESC";
$result = $con->query($sql);

$names=array();
$vals=array();
$count=0;
$in1=0;
$in2=0;


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 //echo $value." ";
             if($count++%2==1)
                 $vals[$in1++]=$value;
             else
                 $names[$in2++]=$value;
			}
 }
} else {
    echo "0 results";
}
/*
foreach($names as $value){
    echo $value . "<br>";
}
foreach($vals as $value){
    echo $value . "<br>";
}*/
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
        document.writeln(data[i].name+" "+data[i].value)
    */
        
        var svg = d3.select("svg"),
        width = +svg.attr("width"),
        height = +svg.attr("height"),
        radius = Math.min(width, height) / 2,
        g = svg.append("g").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

        //var color = d3.scaleOrdinal(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00","#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00","#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);
        var color = d3.scaleOrdinal(d3.schemeCategory20);
        
        var pie = d3.pie()
        .sort(null)
        .value(function(d) { return d.value; });
        
     

        
        var path = d3.arc()
            .outerRadius(radius - 10)
            .innerRadius(0);

        var label = d3.arc()
            .outerRadius(radius - 40)
            .innerRadius(radius - 40);


        var arc = g.selectAll(".arc")
        .data(pie(data))
        .enter().
        append("g")
          .attr("class", "arc")
         .on("mouseover", function (d) {
             
             var total = d3.sum(data.map(function(d) {                
              return d.value;                                           
            }));                                                        
            var percent = Math.round(1000 * d.value / total) / 10;
        var tooltip=d3.select("#tooltip")
        .style("left", d3.event.pageX + "px")
        .style("top", d3.event.pageY + "px")
        .style("opacity", 1);
        
        tooltip.select("#value")
        .text(d.value);
        
        
        tooltip.select("#percent")
        .text(percent);
        })
            .on("mouseout", function () {
            // Hide the tooltip
            d3.select("#tooltip")
                .style("opacity", 0);;
        });


          arc.append("path")
              .attr("d", path)
              .attr("fill", function(d,i) { return color(i); });
          
          
          arc.append("text")
              .attr("transform", function(d) { return "translate(" + label.centroid(d) + ")"; })
              .attr("dy", "0.35em")
              .text(function(d) { return d.data.name; });

       
	</script>
</body>
</html>