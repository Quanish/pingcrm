<template>
  <div>
   <canvas id="client-chart"></canvas>
  </div>
</template>

<script>

import Chart from 'chart.js'
import clientChartData from '@/Shared/client-data.js'

export default {
  name: 'ClientChart',
  data() {
    return {
      clientChartData: clientChartData
    }
  },
  mounted() {
    const ctx = document.getElementById('client-chart');
    new Chart(ctx, this.clientChartData);

  }
}
</script>