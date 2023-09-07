<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'

export default {
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        AuthenticatedLayout,
        Head

    },
    data() {
        return {
            calendarOptions: {
                timeZone: 'Europe/Budapest',
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                initialView: 'timeGridWeek',
                //dateClick: this.handleDateClick,
                selectable: true,
                select: this.handleDateSelect,
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5], // Monday - Thursday

                    startTime: '08:00',
                    endTime: '16:00',
                },
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: null
            }
        }
    },
    methods: {
        handleDateSelect(info) {

            this.$swal({
                title: 'Please enter the  event title or partner name',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'OK',
                showLoaderOnConfirm: true,
                preConfirm: (title) => {
                    let eventData = {
                        title: title,
                        start: info.start,
                        end: info.end,
                        allDay: info.allDay
                    }
                    axios.post('/event', eventData).then((result) => {
                        this.fetchEvents()
                        this.fetchEvents()
                    }).catch(error => {

                    });
                },
            }).then((result) => {
                this.fetchEvents();
            });

        },
        fetchEvents() {
            axios.get('/event').then(result => {
                this.calendarOptions.events = result.data;
            });
        }
    },
    mounted() {
        this.fetchEvents();
    }

}

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Booking</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
