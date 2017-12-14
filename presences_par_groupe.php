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
        <div id="chart_bar"></div>
        <div>
        <button onclick="render('deb')">Débutants</button>
        <button onclick="render('inter')">Intermédiaires</button>
        <button onclick="render('conf')">Confirmés</button>
        <button onclick="render('chant')">Chant</button>
        </div>
    </div>
</main>
<script src="js/d3.v4.min.js"></script>
<script>
    var data = [/*
  { name: 'Alice', goals: 93, assists: 84 },
  { name: 'Bobby', goals: 81, assists: 97 },
  { name: 'Carol', goals: 74, assists: 88 },
  { name: 'David', goals: 64, assists: 76 },
  { name: 'Emily', goals: 80, assists: 94 },
  { name: 'Kosta', goals: 21, assists: 99 }*/
    ]

    // reserve space for the axes and subtract that space
    // from the width and height properties so their values
    // accurately reflect the space available to the chart itself
    const margin = { top: 10, right: 10, bottom: 20, left: 50 }
    const width = jQuery("#chart_bar").width() - margin.left - margin.right
    const height = jQuery("#chart_bar").height() - margin.top - margin.bottom

    // create a scale to map scores to widths
    var xScale = d3.scaleLinear()

    // create a scale to calculate bar height
    var yScale = d3.scaleBand()
    /*.domain(data.map(function(d) { return d.name }))
    .range([0, height])*/
    // this is just a condensed version of render()
    // from the previous example at http://bit.ly/2t2RJ0S
    // the commented lines are the only substantive changes
    function render(subject) {
        const bars = d3.select('#chart_bar')
            .selectAll('div')
            .data(data, function(d) {
                return d.name
            })

        bars.enter()
            .append('div')
            .attr('class', 'bar')
            .style('width', 0)
            .style('height', function(d) {
                // use the height calculated by the band scale
                return yScale.bandwidth() - 2 + 'px'
            })
            .merge(bars)
            .transition()
            .style('width', function(d) {
                // pass the score through the linear scale function
                return xScale(d[subject]) + 'px'
            })
    }
    d3.csv("ajax/get_presences_by_day_and_groupe.php", function(d) {
        return {
            name : d.date,
            deb : d.deb,
            inter : d.inter,
            conf : d.conf,
            chant : d.chant
        };
    }, function(dataset) {
        data = dataset;
        yScale = d3.scaleBand()
            .domain(data.map(function(d) { return d.name; }))
            .range([0, height])

        xScale = d3.scaleLinear()
            .domain([0, 30])
            .range([0, width])


        render('deb')
        const svg = d3.select('#chart_bar')
            .append('svg')
            .attr('width', width + margin.left + margin.right)
            .attr('height', height + margin.top + margin.bottom)
            .style('position', 'absolute')
            .style('top', 0)
            .style('left', 0)

        // create a group container and position it according to the margins
        // so subsequent commands are run from the correct coordinates
        const axisContainer = svg.append('g')
            .attr('transform', `translate(${margin.left}, ${margin.top})`)

        axisContainer.append('g')
            .attr('transform', `translate(0, ${height})`)
            .call(d3.axisBottom(xScale))

        axisContainer.append('g')
            .call(d3.axisLeft(yScale))
    });


</script>
<style>



</style>
</body>
</html>