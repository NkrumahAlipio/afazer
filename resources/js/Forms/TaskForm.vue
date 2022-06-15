<template>
    <div class="p-4 mt-4 text-black bg-gray-100 border-b rounded">
        <div
            class="flex items-center space-x-8 cursor-pointer text-primary"
            @click="adding = true"
            v-show="!adding"
        >
            <ion-icon name="add-outline" style="font-size: 2rem"></ion-icon>
            <h1 class="text-xl">Add a task</h1>
        </div>

        <form
            @submit.prevent="createTask"
            v-show="adding"
            class="flex flex-col text-black"
        >
            <button hidden></button>
            <div class="flex items-center space-x-8">
                <input disabled class="w-6 h-6 rounded-full" type="checkbox" />
                <input
                    v-model="form.title"
                    class="w-full rounded-sm h-9"
                    type="text"
                    placeholder="Add Task"
                />
            </div>
            <div class="flex mt-4 space-x-2 ml-14">
                <DateDropdown :form="form">
                    <div
                        class="flex items-center px-2 space-x-2 rounded-sm"
                        :class="{ 'bg-white': form.date }"
                    >
                        <ion-icon
                            name="calendar-outline"
                            style="font-size: 1.2rem"
                            class="p-1 text-gray-400 rounded cursor-pointer  w-7 hover:text-gray-600 hover:bg-gray-200"
                        ></ion-icon>
                        <template v-if="form.date">
                            <DateText
                                :date="form.date"
                                :withIcon="false"
                                :withColors="false"
                            ></DateText>
                        </template>
                    </div>
                </DateDropdown>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import DateText from "../Partials/DateText.vue";
import DateDropdown from "../Partials/DateDropdown.vue";

export default {
    data() {
        return {
            adding: false,
            form: useForm({
                title: null,
                date: null,
            }),
        };
    },
    methods: {
        createTask() {
            this.form.post("/tasks", {
                preserveScroll: true,
                onSuccess: () => {
                    window.dispatchEvent(new CustomEvent("taskCreated"));
                    this.form.reset();
                },
            });
        },
    },
    components: {
        DateDropdown,
        DateText,
    },
};
</script>

<style>
</style>
