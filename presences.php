<?php
require('database.php');

$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id_groupe"])) {
    $url = "ajax/get_presences_by_day.php?id_groupe=".$_GET["id_groupe"];
} else {
    $url = "ajax/get_presences_by_day.php";
}

$title = "Gestionnaire de danse - Présences";
include('header_technique.php');
?>
<body>
<?php
		$h1 = "Liste des profiles";
		include('header.php');
	?>
<main>

    <?php
		include('nav.php');
	?>
    <div class="col-10 item ">
        <div class="cours_search">
            <form id="cours_search" action="presences.php" method="GET">
                <label for="id_groupe">Cours du groupe :</label>
                <select id="id_groupe" name="id_groupe" class=''>
                    <option value="">---------------</option>
                    <?php
                    if ($groupes) {
                        foreach ($groupes as $grpe) {
                            echo '<option value="'.$grpe['id'].'" ';
                            if (isset($_GET["id_groupe"]) && $_GET["id_groupe"] == $grpe["id"]) {
                                echo "selected='selected'";
                            }
                            echo '>'.$grpe['nom'].'</option>';
                        }
                    }
                    ?>
                </select>
                <input type="submit" name="search_presences" value="Filtrer">
            </form>
        </div>
        <div id="chart"></div>

    </div>
</main>
<script src='js/d3.v3.min.js'></script>
<script language="JavaScript">
    var margin = {
            top: 20,
            right: 30,
            bottom: 30,
            left: 40
        },
        width = jQuery("#chart").width() - margin.left - margin.right,
        height = jQuery("#chart").height() - margin.top - margin.bottom;

    // scale to ordinal because x axis is not numerical
    var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);

    //scale to numerical value by height
    var y = d3.scale.linear().range([height, 0]);

    var chart = d3.select("#chart")
        .append("svg") //append svg element inside #chart
        .attr("width", width + (2 * margin.left) + margin.right) //set width
        .attr("height", height + margin.top + margin.bottom); //set height
    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom"); //orient bottom because x-axis will appear below the bars

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

    d3.json("<?= $url ?>", function(error, data) {
        x.domain(data.map(function(d) {
            return d.cours_date
        }));
        y.domain([0, d3.max(data, function(d) {
            return d.presences
        })]);

        var bar = chart.selectAll("g")
            .data(data)
            .enter()
            .append("g")
            .attr("transform", function(d, i) {
                return "translate(" + x(d.cours_date) + ", 0)";
            });

        bar.append("rect")
            .attr("y", function(d) {
                return y(d.presences);
            })
            .attr("x", function(d, i) {
                return x.rangeBand() / 2 + margin.left/2 + margin.right/2;
            })
            .attr("height", function(d) {
                return height - y(d.presences);
            })
            .attr("width", 10); //set width base on range on ordinal data

        bar.append("text")
            .attr("x", x.rangeBand() / 2 + margin.left + margin.right/2)
            .attr("y", function(d) {
                return y(d.presences);
            })
            .attr("dy", ".75em")
            .text(function(d) {
                return d.presences;
            });

        chart.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(" + margin.left + "," + height + ")")
            .call(xAxis)
            .append("text")
            .attr("transform", "rotate(0)")
            .attr("x", width - margin.left/2)
            .attr("y", 10)
            .attr("dx", ".71em")
            .style("text-anchor", "end")
            .text("cours");


        chart.append("g")
            .attr("class", "y axis")
            .attr("transform", "translate(" + margin.left  + ",0)")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("presences");
        jQuery(".y .tick text").attr('y',6);
        //jQuery(".y .tick line").attr('y2',6);
    });

    function type(d) {
        d.cours_date = +d.cours_date; // coerce to number
        return d;
    }
</script>
</body>
</html>