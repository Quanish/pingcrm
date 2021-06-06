<template>
  <div class="flex flex-col h-full">
   

    <div class="flex flex-auto">
      <div class="w-3/12 flex flex-col">
        <h1 class="mb-8 font-bold text-2xl">Календарь</h1>
        <div class="bg-white rounded-2xl shadow-sm w-full h-full pr-3 overflow-y-auto py-4 px-4">
          test
        </div>
      </div>  
      <div class="w-9/12 pl-3">
        <Fullcalendar :options="calendarOptions" />
      </div>  
    </div>
    


  </div>
</template>



<script>

import Layout from '@/Shared/Layout'
import Fullcalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import ListPlugin from '@fullcalendar/list'
import ruLocale from '@fullcalendar/core/locales/ru';

export default {
props:{
    event: Array, 
},
data() {
    return {
       calendarOptions: {
          plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin, ListPlugin],
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prevYear,prev,next,nextYear today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek'
          },
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          selectable:true,
          height: window.innerHeight - 100,
          locale:ruLocale,
          dayMaxEvents: true,
          events: this.event,
          select: (event) => {
            this.handleSelect()
          },
          eventClick: (event) => {
            console.log(event)
          },
          windowResize: function(arg) {
            console.log(arg)
            this.calendarOptions.height = window.innerHeight - 100
          },
          // eventMouseEnter: (event) => {
            
          // }
        },
      }
  },
  metaInfo: { title: 'Календарь' },
  layout: Layout,
  components:{
    Fullcalendar
  },
  methods:{
    handleSelect(){
      alert('test');
    }
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
