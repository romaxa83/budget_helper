<template>

  <div class="pt-10 pb-16">
    <div class="px-4 sm:px-6 md:px-0">
      <h1 class="text-3xl font-extrabold text-gray-900">Dashboard</h1>
    </div>
    <div class="px-4 sm:px-6 md:px-0">
      <div id="chart"></div>
    </div>
  </div>

</template>

<script lang="ts">

import {onMounted, ref} from "vue";
import axios from "axios";


export default {
  name: "Dashboard",
  setup() {
    // onMounted(async () => {
    //   const chart = c3.generate({
    //     bindto: '#chart',
    //     data: {
    //       x: 'x',
    //       columns: [
    //         ['x', 2],
    //         ['Sales', 28]
    //       ],
    //       types: {
    //         Sales: 'bar'
    //       }
    //     },
    //     axis: {
    //       x: {
    //         type: 'timeseries',
    //         tick: {
    //           format: '%Y-%m-%d'
    //         }
    //       }
    //     }
    //   });

      // const res = await axios.get('chart');
      // const records = res.data.data;
      //
      // chart.load({
      //   columns: [
      //     ['x', ...records.map(r => r.date)],
      //     ['Sales', ...records.map(r => r.sum)]
      //   ]
      // });
    // });
  }
}
</script>