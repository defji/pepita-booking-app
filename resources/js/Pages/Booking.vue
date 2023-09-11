<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import rrulePlugin from '@fullcalendar/rrule'
import interactionPlugin from '@fullcalendar/interaction'
import axios from 'axios'

export default {
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        AuthenticatedLayout,
        Head

    },
    props: ['business_time'],
    data() {
        return {
            calendarOptions: {
                timeZone: 'Europe/Budapest',
                hour12: false,
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, rrulePlugin],
                initialView: 'timeGridWeek',
                //dateClick: this.handleDateClick,
                selectable: true,
                firstDay: 1,
                timeFormat: 'H(:mm)',
                select: this.handleDateSelect,
                businessHours: {
                    daysOfWeek: this.business_time.days, // Monday - Thursday
                    startTime: this.business_time.hours[0].toString().padStart(2, '0') + ':00',
                    endTime: this.business_time.hours[1].toString().padStart(2, '0') + ':00',
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
                        this.$swal({
                            icon: 'success',
                            title: 'Event successfully added.',
                            confirmButtonText: 'OK',
                            preConfirm: () => {
                                this.fetchEvents()
                            }
                        })
                    }).catch(error => {
                        console.log(error);
                        this.$swal({
                            title: error.response.data.message,
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
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
    <Head title="Booking"/>

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
