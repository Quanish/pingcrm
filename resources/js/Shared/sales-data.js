export const planetChartData = {
    type: "bar",
    height: 300,
    data: {
        labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь"],
        datasets: [{
                label: "Выполнено",
                data: [17, 16, 10, 28, 32, 30],
                backgroundColor: "rgba(54,73,93,.5)",
                borderColor: "#36495d",
                borderWidth: 3
            },
            {
                label: "План",
                data: [25, 25, 30, 40, 40, 40],
                backgroundColor: "rgba(71, 183,132,.5)",
                borderColor: "#47b784",
                borderWidth: 3
            }
        ]
    },
    options: {
        responsive: true,
        lineTension: 1,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    padding: 25
                }
            }]
        }
    }
};

export default planetChartData;