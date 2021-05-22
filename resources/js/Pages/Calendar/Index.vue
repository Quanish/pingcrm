<template>
  <div id="app">
    <h1 class="mb-8 font-bold text-3xl">Календарь</h1>
    <Fullcalendar :options="calendarOptions" :header="{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'

          }" />


  </div>
</template>



<script>

import Layout from '@/Shared/Layout'
import Fullcalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import TimeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import ListPlugin from '@fullcalendar/list'

export default {
props:{
    event: Array, 
},
data() {
    return {
       calendarOptions: {
          plugins: [ dayGridPlugin, interactionPlugin ],
          initialView: 'dayGridMonth',
          selectable:true,
          events: this.event
        },
      }
  },
  metaInfo: { title: 'Календарь' },
  layout: Layout,
  components:{
    Fullcalendar
  },
  created() {
    let arr = []
    console.log(this.event);
    /*this.event.forEach((item, index) => {
         console.log(this.event);
        this.calendarOptions.events.push({
          title: this.event.title,
          start: this.event.start,
          end: this.event.end,
          extendedProps: {
            department: this.event.department
          },
          description: this.event.description
       
        })
    });*/
  }
}
</script>
