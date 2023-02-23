

// Begin date date picker
var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
$('#cpd-daterange').datepicker({
    uiLibrary: 'bootstrap4',
    iconsLibrary: 'fontawesome',
    minDate: today,
    format: 'dd / mm / yyyy',
});// End date date picker


! function(o) {
    "use strict";

    function e() {
        this.$body = o("body"), this.charts = []
    }
    e.prototype.initCharts = function() {
        window.Apex = {
            chart: {
                parentHeightOffset: 0,
                toolbar: {
                    show: !1
                }
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0
                }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00", "#174EA6"]
        };
        var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00", "#174EA6"],
            t = o("#revenue-chart").data("colors");
        t && (e = t.split(","));
        var r = {
            chart: {
                height: 364,
                type: "line",
                dropShadow: {
                    enabled: !0,
                    opacity: .2,
                    blur: 7,
                    left: -7,
                    top: 7
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                curve: "smooth",
                width: 4
            },
            series: [{
                name: "This month",
                data: [10, 20, 15, 25, 20, 30, 20, 25, 27, 30, 35, 40]
            }, {
                name: "Last month",
                data: [0, 15, 10, 30, 15, 35, 25, 22, 26, 29, 25, 35]
            }],
            colors: e,
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            xaxis: {
                type: "string",
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                tooltip: {
                    enabled: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e + "k"
                    },
                    offsetX: -15
                }
            }
        };
        new ApexCharts(document.querySelector("#revenue-chart"), r).render();
        e = ["#727cf5", "#e3eaef"];
        (t = o("#one-off-vs-monthly-chart").data("colors")) && (e = t.split(","));
        r = {
            chart: {
                height: 257,
                type: "bar",
                stacked: !0
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "20%"
                }
            },
            dataLabels: {
                enabled: !1
            },
            stroke: {
                show: !0,
                width: 2,
                colors: ["transparent"]
            },
            series: [{
                name: "One-off",
                data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81]
            }, {
                name: "Monthly",
                data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59]
            }],
            zoom: {
                enabled: !1
            },
            legend: {
                show: !1
            },
            colors: e,
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
                labels: {
                    formatter: function(e) {
                        return e + "k"
                    },
                    offsetX: -15
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(e) {
                        return "£" + e + "k"
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#one-off-vs-monthly-chart"), r).render();
        e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00", "#174EA6"];
        (t = o("#top-campaigns-donut").data("colors")) && (e = t.split(","));
        r = {
            chart: {
                height: 208,
                type: "donut"
            },
            legend: {
                show: !1
            },
            stroke: {
                colors: ["transparent"]
            },
            series: [45, 43, 37, 17, 15 ],
            labels: ["Clean Water for Gaza", "Emergency Covid-19 Appeal", "Orphans & widows", "Rohingya Camp Fire Emergency Appeal", "Most in Need"],
            colors: e,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }]
        };
        new ApexCharts(document.querySelector("#top-campaigns-donut"), r).render()
    }, e.prototype.initMaps = function() {
        0 < o("#world-map-markers").length && o("#world-map-markers").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: !1,
            regionStyle: {
                initial: {
                    fill: "#e3eaef"
                }
            },
            markerStyle: {
                initial: {
                    r: 9,
                    fill: "#727cf5",
                    "fill-opacity": .9,
                    stroke: "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": .4
                },
                hover: {
                    stroke: "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            backgroundColor: "transparent",
            markers: [{
                latLng: [51.528308, -0.3817765],
                name: "London"
            }, {
                latLng: [37.77, -122.41],
                name: "San Francisco"
            }, {
                latLng: [-33.86, 151.2],
                name: "Sydney"
            }, {
                latLng: [1.3, 103.8],
                name: "Singapore"
            }],
            zoomOnScroll: !1
        })
    }, e.prototype.init = function() {
        this.initCharts(), this.initMaps()
    }, o.Dashboard = new e, o.Dashboard.Constructor = e
}(window.jQuery),
function(t) {
    "use strict";
    t(document).ready(function(e) {
        t.Dashboard.init()
    })
}(window.jQuery);
































