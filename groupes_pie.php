<?php
require('database.php');

$queryGrpe = $pdo->prepare('SELECT * FROM groupes');
$queryGrpe->execute();
$groupes = $queryGrpe->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["id_groupe"])) {
    $url = "http://danses_admin.dev/ajax/get_presences_by_day.php?id_groupe=".$_GET["id_groupe"];
} else {
    $url = "http://danses_admin.dev/ajax/get_presences_by_day.php";
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
        <svg width="960" height="500"></svg>
    </div>
</main>
<script src="js/d3.v4.min.js"></script>
<script>

    var svg = d3.select("svg"),
        width = +svg.attr("width"),
        height = +svg.attr("height"),
        radius = Math.min(width, height) / 2,
        g = svg.append("g").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var color = d3.scaleOrdinal(["#98abc5", "#8a89a6", "#7b6888", "#6b486b"]);

    var pie = d3.pie()
        .sort(null)
        .value(function(d) { return d.danseurs; });

    var path = d3.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);

    var label = d3.arc()
        .outerRadius(radius - 40)
        .innerRadius(radius - 40);

    d3.csv("http://danses_admin.dev/ajax/get_groupes_attendance.php", function(d) {
        d.danseurs = +d.danseurs;
        return d;
    }, function(error, data) {
        if (error) throw error;

        var arc = g.selectAll(".arc")
            .data(pie(data))
            .enter().append("g")
            .attr("class", "arc");

        arc.append("path")
            .attr("d", path)
            .attr("fill", function(d) { return color(d.data.groupe); });

        arc.append("text")
            .attr("transform", function(d) { return "translate(" + label.centroid(d) + ")"; })
            .attr("dy", "0.35em")
            .text(function(d) { return d.data.groupe; });
    });

</script>
</body>
</html>