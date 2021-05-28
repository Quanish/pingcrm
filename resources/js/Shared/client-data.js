export const planetChartData = {
  type: "line",
  data: {
    labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август"],
    datasets: [
      {
        label: "Новые",
        data: [79, 82, 1, 2, 3, 0, 27, 14],
        backgroundColor: "rgba(54,73,93,0)",
        borderColor: "#36495d",
        borderWidth: 3
      },
      {
        label: "Постоянные",
        data: [1, 2, 33, 3, 6, 3, 3, 7],
        backgroundColor: "rgba(71, 183,132,0)",
        borderColor: "#47b784",
        borderWidth: 3
      }
    ]
  },
  options: {
    responsive: true,
    lineTension: 1,
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true,
            padding: 25
          }
        }
      ]
    }
  }
};

export default planetChartData;