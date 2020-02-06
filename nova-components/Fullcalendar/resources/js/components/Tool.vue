<template>
  <div>
    <FullCalendar
      @dateClick="handleDateClick"
      @eventClick="handleEventClick"
      @eventMouseEnter="handleMouseEnter"
      @eventMouseLeave="handleMouseLeave"
      ref="fullCalendar"
      :plugins="calendarPlugins"
      :weekends="calendarWeekends"
      :events="calendarEvents"
      :displayEventTime="false"
      :header="{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            }"
    />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
  components: {
    FullCalendar
  },
  methods: {
    handleDateClick(info) {
      console.log(info);
    },
    handleEventClick(info) {
      console.log(info);
    },
    handleMouseEnter(info) {
      console.log(info);
    },
    handleMouseLeave(info) {
      console.log(info);
    }
  },
  data() {
    return {
      calendarPlugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
      calendarWeekends: true,
      calendarEvents: [{ title: "Today", start: new Date() }]
    };
  },
  mounted() {
    axios.get("/nova-vendor/fullcalendar/events").then(response => {
      this.events = response.data;
      if (this.events) {
        this.calendarEvents = [];
        this.events.forEach(event => {
          this.calendarEvents.push({
            title: `#${event.project_id} ${event.project.title} \n ${event.tasktype.name} \n ${event.assigned.name} \n Start`,
            start: event.due_date,
            color: `#${
              event.status_id !== 3 ? event.tasktype.color : "32CD32"
            }`,
            allDay: true,
            url: `/resources/projects/${event.project_id}`
          });
          if (event.end_date) {
            this.calendarEvents.push({
              title: `#${event.project_id} ${event.project.title} \n ${event.tasktype.name} \n ${event.assigned.name} \n End`,
              start: event.end_date,
              color: `#${
                event.end_status_id !== 3 ? event.tasktype.color : "32CD32"
              }`,
              allDay: true,
              url: `/resources/projects/${event.project_id}`
            });
          }
        });
      }
    });
  }
};
</script>

<style>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/timegrid/main.css";
</style>