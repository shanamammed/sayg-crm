! function(s) {
    "use strict";
    var r = function() {};
    r.prototype.respChart = function(r, o, e, a) {
        var t = r.get(0).getContext("2d"),
            n = s(r).parent();

        function i() {
            r.attr("width", s(n).width());
            switch (o) {
                case "Line":
                    new Chart(t, {
                        type: "line",
                        data: e,
                        options: a
                    });
                    break;
                case "Doughnut":
                    new Chart(t, {
                        type: "doughnut",
                        data: e,
                        options: a
                    });
                    break;
                case "Pie":
                    new Chart(t, {
                        type: "pie",
                        data: e,
                        options: a
                    });
                    break;
                case "Bar":
                    new Chart(t, {
                        type: "bar",
                        data: e,
                        options: a
                    });
                    break;
                case "Radar":
                    new Chart(t, {
                        type: "radar",
                        data: e,
                        options: a
                    });
                    break;
                case "PolarArea":
                    new Chart(t, {
                        data: e,
                        type: "polarArea",
                        options: a
                    })
            }
        }
        s(window).resize(i), i()
    }, r.prototype.init = function() {
        this.respChart(s("#lineChart"), "Line", {
            labels1 : JSON.parse(document.currentScript.getAttribute('bar_labels')),
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September"],
            datasets: [{
                label: "Sales Analytics",
                fill: !1,
                lineTension: .05,
                backgroundColor: "#fff",
                borderColor: "#3ec396",
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0,
                borderJoinStyle: "miter",
                pointBorderColor: "#3ec396",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 8,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "#3ec396",
                pointHoverBorderWidth: 3,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
            }]
        }, {
            scales: {
                yAxes: [{
                    ticks: {
                        max: 100,
                        min: 20,
                        stepSize: 10
                    }
                }]
            }
        });
        
        this.respChart(s("#pie"), "Pie", {
            labels: ["Desktops", "Tablets", "Mobiles", "Mobiles", "Tablets"],
            datasets: [{
                data: [80, 50, 100, 121, 77],
                backgroundColor: ["#5d6dc3", "#3ec396", "#f9bc0b", "#4fbde9", "#313a46"],
                hoverBackgroundColor: ["#5d6dc3", "#3ec396", "#f9bc0b", "#4fbde9", "#313a46"],
                hoverBorderColor: "#fff"
            }]
        });
        this.respChart(s("#bar"), "Bar", {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "Sales Analytics",
                backgroundColor: "rgba(60, 134, 216, 0.3)",
                borderColor: "#3c86d8",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(60, 134, 216, 0.7)",
                hoverBorderColor: "#3c86d8",
                data: [65, 59, 80, 81, 56, 55, 40, 20]
            }]
        })
    }, s.ChartJs = new r, s.ChartJs.Constructor = r
}(window.jQuery),
function(r) {
    "use strict";
    window.jQuery.ChartJs.init()
}();