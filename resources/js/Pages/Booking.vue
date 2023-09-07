<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        AuthenticatedLayout,
        Head

    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                initialView: 'timeGridWeek',
                //dateClick: this.handleDateClick,
                selectable: true,
                select: this.handleDateSelect,

                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // user can switch between the two
                },
                events: [{
                    'title': 'jujj nap',
                    'start': '2023-09-06 23:00:00',
                    'end': '2023-09-06 23:55:00',

                }
                ]
            }
        }
    },
    methods: {
        handleDateSelect(info) {
            alert(JSON.stringify((info)));
        }
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
