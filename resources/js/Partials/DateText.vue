<template>
    <div
        class="flex items-center space-x-2"
        :class="{
            'text-red-600': task_date.isBefore(today, 'day') && withColors,
            'text-blue-600': task_date.isSameOrAfter(today,'day') && withColors,
        }"
    >
        <ion-icon
            name="calendar-outline"
            :class="{'text-gray-600': !withColors}"
            v-if="withIcon"
        ></ion-icon>
        <h1 class="capitalize select-none">
            <span v-if="task_date.isSame(today, 'day')" v-text="'Today'"></span>
            <span
                v-else-if="task_date.isSame(tomorrow, 'day')"
                v-text="'Tomorrow'"
            ></span>
            <span v-else-if="task_date.isBefore(today, 'day')">
                Overdue, {{ task_date.format("ddd") }},
                {{ task_date.format("D") }} {{ task_date.format("MMMM") }}
            </span>
            <span v-if="task_date.isAfter(tomorrow, 'day')">
                Completion date, {{ task_date.format("ddd") }},
                {{ task_date.format("D") }} {{ task_date.format("MMMM") }}
            </span>
        </h1>
    </div>
</template>

<script>
import moment from "moment";
export default {
    props: ["date", "withIcon", "withColors"],
    data() {
        return {
            task_date: moment(this.date),
            today: moment(),
            tomorrow: moment().add(1, "day"),
        };
    },
    watch: {
        date(date) {
            this.task_date = moment(date);
        },
    },
};
</script>

<style>
</style>
