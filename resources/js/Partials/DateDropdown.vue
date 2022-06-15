<template>
    <JetDropdown width="w-56">
        <template #trigger>
            <slot />
        </template>
        <template #content>
            <div class="flex justify-center py-4">
                <h1 class="text-lg font-bold">Date</h1>
            </div>
            <div
                class="flex items-center justify-between px-3 text-gray-500 cursor-pointer hover:bg-gray-100"
                @click="form.date = today.format('YYYY-MM-DD')"
            >
                <div class="flex items-center py-3 space-x-3">
                    <ion-icon
                        name="calendar-number-outline"
                        style="font-size: 1rem"
                    ></ion-icon>
                    <h1>Today</h1>
                </div>
                <h1 v-text="today.format('ddd')"></h1>
            </div>
            <div
                class="flex items-center justify-between px-3 text-gray-500 cursor-pointer hover:bg-gray-100"
                @click="form.date = tomorrow.format('YYYY-MM-DD')"
            >
                <div class="flex items-center py-3 space-x-3">
                    <ion-icon
                        name="calendar-number-outline"
                        style="font-size: 1rem"
                    ></ion-icon>
                    <h1>Tomorrow</h1>
                </div>
                <h1 v-text="tomorrow.format('ddd')"></h1>
            </div>
            <div
                class="flex items-center justify-between px-3 text-gray-500 cursor-pointer hover:bg-gray-100"
                @click="form.date = next_week.format('YYYY-MM-DD')"
            >
                <div class="flex items-center py-3 space-x-3">
                    <ion-icon
                        name="calendar-number-outline"
                        style="font-size: 1rem"
                    ></ion-icon>
                    <h1>Next Week</h1>
                </div>
                <h1 v-text="tomorrow.format('ddd')"></h1>
            </div>
            <hr />
            <div
                @click.stop
                class="flex items-center justify-between px-3 py-1 text-gray-500 cursor-pointer hover:bg-gray-100"
            >
                <flat-pickr
                    placeholder="Choose A Date"
                    v-model="form.date"
                ></flat-pickr>
            </div>
        </template>
    </JetDropdown>
</template>

<script>
import "flatpickr/dist/flatpickr.css";
import JetDropdown from "../Jetstream/Dropdown.vue";
import JetDropdownLink from "../Jetstream/DropdownLink.vue";
import flatPickr from "vue-flatpickr-component";
import moment from "moment";
export default {
    props: ['form'],
    data() {
        return {
            today: moment(),
            tomorrow: moment().add(1, "days"),
            next_week: moment().add(1, "week").startOf("week"),
        }
    },
    components: {
        JetDropdown,
        JetDropdownLink,
        flatPickr,
    }
};
</script>

<style>
</style>
